<div class="sidenav_container side_panel_settings_container">
	<div class="">
		<div class="element_panel_heading shadow"><span class="text_middle" id="element_tag_name">Element settings</span></div>
		<div class="settings_option_button">
			<div class="text_middle" id="settings_button"  onclick="show_settings()">Settings</div>
			<div class="text_middle" id="advanced_button"  onclick="show_advanced()">Advanced</div>
		</div>
		<div class="settings_elements">
			<div id="settings_div"></div>
			<div id="advanced_div" style="display: none;"> </div>
		</div>
		<div id="footer-buttons">footer_button</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
	    $('#settings_div').css("height", (body_height-200));
	    $('#advanced_div').css("height", (body_height-200));
	});
</script>

<style type="text/css">
	.sidenav_container{
		position: fixed;
		right: 0;
		max-width: 400px;
		width: 400px;
		max-height: 100%;
		min-height: 100%;
		border-left: 5px solid #09567c;
	}
	.element_panel_heading{
		height: 50px;
		background-color: #0b5a82;
		font-size: 20px;
		color: white;
		padding-top: 10px;
		text-align: center;
	}
	.settings_option_button{
		height: 50px;
		background-color: #007e9c;
	}

	.settings_elements{

	}
	#settings_div, #advanced_div{
	  	overflow-y: scroll;
	  	background-color: #196475;
	  	position: absolute;
	  	padding-bottom: 50px;
	}
	#footer-buttons{
		position: absolute;
	    height: 50px;
	    bottom: 50px;
	    width: 400px;
		background-color: #017e9b;
		text-align: center;
	}
	#settings_button, #advanced_button{
		float:left;
		width:50%;
		height: 50px;
		font-size: 18px;
		color: white;
		padding-top: 10px;
		cursor: pointer;
		text-align: center;
		border-bottom: 2px solid #3333336b;
	}
	#settings_button{
		border-right: 1px solid #3333336b;
	}
	#advanced_button{
		border-left: 1px solid #3333336b;
	}
	#settings_save, #settings_clone, #settings_remove{
		float:left;
		height: 50px;
		position: relative;
		font-size: 16px;
		color: white;
		padding-top: 10px;
		cursor: pointer;
		border-right: 2px solid #3333336b;
	}

	.settings_head_active_color{
		background-color: #196475;
	}
</style>