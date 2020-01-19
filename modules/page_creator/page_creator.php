<?php
	function display_page( $page_id) {
		global $mysqli,$break,$start;
		$full_home_url= BASE;
		$res = $mysqli->query("SELECT id,user_id,title, html, status, type FROM pages WHERE id='$page_id'");
		if( $res->num_rows > 0 ) {
			$arr = $res->fetch_array( MYSQLI_ASSOC );
			if($arr['status'] == 0 || ( $arr['status'] == 1)){
				$page_type = $arr['type'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
			if($page_type == "page" || $page_type == "study"){
		?>
			<meta http-equiv="Content-Type" content=" charset=UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
			<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<link rel="stylesheet" href="<?php echo BASE; ?>/files/css/display.css">
			<link rel="stylesheet" href="<?php echo BASE; ?>/files/css/common_style.css">

			<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<script type="text/javascript">
				var base = '<?php echo BASE; ?>';
			</script>
			<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js'></script>
			<script src="<?php echo BASE; ?>/files/js/display.js"></script>
			<title><?php echo $arr['title']; ?></title>
			<?php
				if(get_page_meta( $page_id,'seo_page_title') != ""){
					echo '<meta name="title" content="'.get_page_meta( $page_id,'seo_page_title').'" />';
					echo '<meta name="twitter:title" content="'.get_page_meta( $page_id,'seo_page_title').'">';
					echo '<meta property="og:title" content="'.get_page_meta( $page_id,'seo_page_title').'" />';
				}
				if(get_page_meta( $page_id,'seo_page_description') != ""){
					echo '<meta name="description" content="'.get_page_meta( $page_id,'seo_page_description').'" />';
					echo '<meta name="twitter:description" content="'.get_page_meta( $page_id,'seo_page_description').'">';
					echo '<meta property="og:description" content="'.get_page_meta( $page_id,'seo_page_description').'" />';
				}
				if(get_page_meta( $page_id,'seo_page_image') != ""){
					echo '<meta name="twitter:card" content="photo" data-page-subject="true">';
					echo '<meta name="twitter:image:width" content="640" data-page-subject="true">';
					echo '<meta property="og:image" content="'.get_page_meta( $page_id,'seo_page_image').'" />';
					echo '<meta name="twitter:image" content="'.get_page_meta( $page_id,'seo_page_image').'" />';
				}
				$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			?>

			<meta property="og:url" content="<?php echo $current_link; ?>">
			<meta name="twitter:url" content="<?php echo $current_link; ?>" data-page-subject="true">
			<meta name="twitter:creator" content="@tlcright" data-page-subject="true">

		<?php 
				echo get_page_meta($page_id,"custom_script");
				echo get_page_meta($page_id,"custom_css");
			} else if($page_type=='email'){
		?>
				<meta http-equiv="Content-Type" content=" charset=UTF-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<style type="text/css"><?php include "files/css_lib_email.php" ?></style>
		<?php 
				
			} 
		?>

	</head>
	<body style="<?php echo get_page_meta( $page_id, 'body_css' ); ?>">
		<?php
			$html_data = json_decode($arr['html']);
			$html_text = '';
			echo generate_json_to_html($html_data, $html_text);
		?>
		<input type="hidden" id="page_id" value="<?php echo $arr['id']; ?>">
		<input type="hidden" id="user_id" value="<?php echo $arr['user_id']; ?>">
	</body>
</html>
<?php
			}else{
				echo display404();
			}
		}else{
			echo display404();
		}
	}
	function generate_json_to_html($html_data, $html_text=""){
		for($i=0;$i<count($html_data);$i++){
			if($html_data[$i]->endtag == 1){
				$html_text .= '<'.$html_data[$i]->tag.' ';
				foreach ($html_data[$i]->attributes as $key => $value) {
					$html_text .= $key.'="'.str_replace("padding-10px","",$value).'"';
				}
				$html_text .= '>';
				if(isset($html_data[$i]->content)&&$html_data[$i]->content != null){
					$html_text .= $html_data[$i]->content;
				}
				if(isset($html_data[$i]->nodes)&&count($html_data[$i]->nodes)>0){
					$html_text .= generate_json_to_html($html_data[$i]->nodes);
				}
				$html_text .= '</'.$html_data[$i]->tag.'>';
			}else{
				$html_text .= '<'.$html_data[$i]->tag.' ';
				foreach ($html_data[$i]->attributes as $key => $value) {
					$html_text .= $key.'="'.str_replace("padding-10px","",$value).'"';
				}
				$html_text .= '/>';
			}
		}

		return $html_text;
	}
?>
