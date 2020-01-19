<?php
class Instant_Mailr {
	public $user_id;
	private $apibaseurl;
	private $api_key;
	private $last_response_headers = null;

	public function __construct($user_id, $apibaseurl, $api_key) {
		$this->apibaseurl = $apibaseurl;
		$this->name = "Instant_Mailr";
		$this->user_id = $user_id;
		$this->api_key = $api_key;
	}

	// Get the URL required to request authorization
	public function getAuthorizeUrl($scope, $redirect_url='') {
		$url = "http://{$this->apibaseurl}/oauth/authorize?client_id={$this->api_key}&scope=" . urlencode($scope);
		if ($redirect_url != '')
		{
			$url .= "&redirect_uri=" . urlencode($redirect_url);
		}
		return $url;
	}

	// Once the User has authorized the app, call this with the code to get the access token
	public function getAccessToken($code) {
		// POST to  POST https://SHOP_NAME.myshopify.com/admin/oauth/access_token
		$url = "https://{$this->apibaseurl}/oauth/access_token";
		$payload = "client_id={$this->api_key}&code=$code";
		$response = $this->curlHttpApiRequest('POST', $url, '', $payload, array());
		$response = json_decode($response, true);
		if (isset($response['access_token']))
			return $response['access_token'];
		return '';
	}

	public function callsMade()
	{
		return $this->shopApiCallLimitParam(0);
	}

	public function callLimit()
	{
		return $this->shopApiCallLimitParam(1);
	}

	public function callsLeft($response_headers)
	{
		return $this->callLimit() - $this->callsMade();
	}

	public function call($method, $path, $params=array())
	{
		$url = $this->apibaseurl.'/'.$path.'/';
		$query = in_array($method, array('GET','DELETE')) ? $params : array();
		$payload = in_array($method, array('POST','PUT')) ? json_encode($params) : array();
		$request_headers = in_array($method, array('POST','PUT')) ? array("Content-Type: application/json; charset=utf-8", 'Expect:') : array();

		// add auth headers
		$request_headers[] = 'X-Instant_Mailr-user: ' . $this->user_id;
		$request_headers[] = 'X-Instant_Mailr-api-key: ' . $this->api_key;
		$request_headers[] = 'X-Instant_Mailr-Method-Called: ' . $method;

		$response = $this->curlHttpApiRequest($method, $url, $query, $payload, $request_headers);
		$response = json_decode($response, true);

		if (isset($response['errors']) or ($this->last_response_headers['http_status_code'] >= 400))
			throw new Instant_MailrApiException($method, $path, $params, $this->last_response_headers, $response);

		return (is_array($response) and (count($response) > 0)) ? array_shift($response) : $response;
	}

	public function validateSignature($query)
	{
		if(!is_array($query) || empty($query['signature']) || !is_string($query['signature']))
			return false;

		foreach($query as $k => $v) {
			if($k != 'shop' && $k != 'code' && $k != 'timestamp') continue;
			$signature[] = $k . '=' . $v;
		}

		sort($signature);
		$signature = md5($this->api_key . implode('', $signature));

		return $query['signature'] == $signature;
	}

	private function curlHttpApiRequest($method, $url, $query='', $payload='', $request_headers=array())
	{
		$url = $this->curlAppendQuery($url, $query);
		$ch = curl_init($url);
		$this->curlSetopts($ch, $method, $payload, $request_headers);
		$response = curl_exec($ch);
		$errno = curl_errno($ch);
		$error = curl_error($ch);
		curl_close($ch);

		if ($errno) throw new Instant_MailrCurlException($error, $errno);
		list($message_headers, $message_body) = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
		$this->last_response_headers = $this->curlParseHeaders($message_headers);
		return $message_body;
	}

	private function curlAppendQuery($url, $query)
	{
		if (empty($query)) return $url;
		if (is_array($query)) return "$url?".http_build_query($query);
		else return "$url?$query";
	}

	private function curlSetopts($ch, $method, $payload, $request_headers)
	{
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Instant_Mailr-php-api-client');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);

		curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, $method);
		if (!empty($request_headers)) curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		
		if ($method != 'GET' && !empty($payload))
		{
			if (is_array($payload)) $payload = http_build_query($payload);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $payload);
		}
	}

	private function curlParseHeaders($message_headers)
	{
		$header_lines = preg_split("/\r\n|\n|\r/", $message_headers);
		$headers = array();
		list(, $headers['http_status_code'], $headers['http_status_message']) = explode(' ', trim(array_shift($header_lines)), 3);
		foreach ($header_lines as $header_line)
		{
			list($name, $value) = explode(':', $header_line, 2);
			$name = strtolower($name);
			$headers[$name] = trim($value);
		}

		return $headers;
	}
	
	private function shopApiCallLimitParam($index)
	{
		if ($this->last_response_headers == null)
		{
			throw new Exception('Cannot be called before an API call.');
		}
		$params = explode('/', $this->last_response_headers['http_x_Instant_Mailr_shop_api_call_limit']);
		return (int) $params[$index];
	}	
}

class Instant_MailrCurlException extends Exception { }
class Instant_MailrApiException extends Exception
{
	protected $method;
	protected $path;
	protected $params;
	protected $response_headers;
	protected $response;
	
	function __construct($method, $path, $params, $response_headers, $response)
	{
		$this->method = $method;
		$this->path = $path;
		$this->params = $params;
		$this->response_headers = $response_headers;
		$this->response = $response;
		
		parent::__construct($response_headers['http_status_message'], $response_headers['http_status_code']);
	}

	function getMethod() { return $this->method; }
	function getPath() { return $this->path; }
	function getParams() { return $this->params; }
	function getResponseHeaders() { return $this->response_headers; }
	function getResponse() { return $this->response; }
}
?>