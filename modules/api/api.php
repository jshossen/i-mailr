<?php
	form_processor();
	include "files/home/phpsection/header.php";
?>
	<div class="container" style="padding-top: 100px; background-color: #e9ecef;">
		<div class="row">
			<div class="col-md-12">
				<h1>Admin API reference</h1>
				<h3>Step 1: </h3>
				<p>Create a file name: <b>instant_mailr.php</b></p>
				<p>Copy and paste below code inside this file.</p>
				<code>
<pre style="max-height: 500px; background-color: #c5bbbbf2;">


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


</pre>
				</code>

				<h3>Step 2: </h3>
				<p>Make your first api call like this. Get single "$page['html']" template. Its simple!</b></p>
				<code>
<pre style="max-height: 500px; background-color: #c5bbbbf2;">

    include_once("instant_mailr.php");

    $user_id = {{YOUR_ID}};
    $page_id = {{YOUR_PAGE_ID}}};
    $api_key = "{{YOUR_API_KEY}}";

    $api_base_url = "https://i-mailr.com/wh";
    
    $im = new Instant_Mailr($user_id, $api_base_url, $api_key);
    $page = $im->call('GET', 'page/'.$page_id);
    echo $page['html'];

</pre>
</code>



</code>

				<h3>Manage subscribers: </h3>
				<p>Add new subscriber, manage custom variables, get all subscribers...</b></p>
				<code>
<pre style="max-height: 500px; background-color: #c5bbbbf2;">

    //Add new subscriber
    $params = array('email'=>'contact@jshossen.com','first_name'=>'Jakir','last_name'=>'Hossen','phone'=>'01717372528', 'age'=>28, 'fb'=>'www.facebook.com/sparkle');
    $new_subscriber = $im->call('POST', 'subscriber/add',$params);
    var_dump($new_subscriber);

    //Get single subscriber
    $params = array('fields'=>'email,first_name,phone');
    $subscriber = $im->call('GET', 'subscriber/{{subscriber_id}}',$params);
    var_dump($subscriber);

    //Get all subscribers
    $params = array('fields'=>'email,first_name');
    $all_subscriber = $im->call('GET', 'subscribers',$params);
    var_dump($all_subscriber);

</pre>
</code>


<h3>Manage subscriber's lists: </h3>
<p>Create new subscriber_group, add subscriber, update, delete.</b></p>
<code>
	<pre style="max-height: 500px; background-color: #c5bbbbf2;">

	//Get all subscriber list
	$params = array('fields'=>'subscriber_ids,info,id');
	$subscriber_groups = $im->call('GET', 'subscriber_groups',$params);
	var_dump($subscriber_groups);

	//Get single subscriber list
	$params = array('fields'=>'subscriber_ids,info');
	$subscriber_group = $im->call('GET', 'subscriber_group/{{subscriber_group_id}}',$params);
	var_dump($subscriber_group);

	//Add new subscriber list
	$params = array('title'=>'Laptop Group');
	$new_groups = $im->call('POST', 'subscriber_groups/new',$params);
	var_dump($new_groups);

	//Add subscriber's ids into a list
	$params = array('ids'=>array(45,46,47,68));//subscriber's id array.
	$add_subscriber = $im->call('POST', 'subscriber_group/{{subscriber_group_id}}/add',$params);
	var_dump($add_subscriber);

	//Delete subscriber's ids from a subscriber list
	$params = array('ids'=>array(47,46));//subscriber's id array.
	$remove_subscriber = $im->call('DELETE', 'subscriber_group/{{subscriber_group_id}}/subscriber',$params);
	var_dump($remove_subscriber);

	//Delete a subscriber list
	$params = array();
	$remove_subscriber = $im->call('DELETE', 'subscriber_group/{{subscriber_group_id}}',$params);
	var_dump($remove_subscriber);

	</pre>
</code>

<h3>Send email to a subscriber's list: </h3>
<p>Start your campaign. Send email with our powerfull api.</b></p>
<code>
	<pre style="max-height: 500px; background-color: #c5bbbbf2;">

	//Send email
	$params = array('source'=>'YOUR_EMAIL IF_MAILGUN_THEN_MAILGUN_DOMAIN','subject'=>'This is test subject','page_id'=>{{page_id}},'subscriber_group'=>{{subscriber_group_id}},'sending_time'=>date("Y-m-d H:i:s"));
	$send_mail = $im->call('POST', 'send_mail',$params);
	var_dump($send_mail);

	</pre>
</code>
			</div>
		</div>
	</div>
<?php
    include "files/home/phpsection/footer.php";
?>