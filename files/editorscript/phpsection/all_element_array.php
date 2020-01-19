<?php
$be_paragraph = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";


$container_fluid = '{"tag":"div","endtag":1,"attributes":{"class":"container-fluid","style":"text-align: center;margin: auto; width: 95%; padding: 10px;"},"nodes":[]}';
$container = '{"tag":"div","endtag":1,"attributes":{"class":"container","style":"text-align: center;margin: auto; padding: 10px;"},"nodes":[]}';
$div = '{"tag":"div","endtag":1,"attributes":{"class":"row","style":"text-align: center;"},"nodes":[]}';

$h1 = '{"tag":"h1","endtag":1,"attributes":{"style":"font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;display: block; font-size: 36px"},"content":"Lorem Ipsum"}';
$h2 = '{"tag":"h2","endtag":1,"attributes":{"style":"font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;display: block; font-size: 30px"},"content":"What is Lorem Ipsum?"}';
$h3 = '{"tag":"h3","endtag":1,"attributes":{"style":"font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;display: block;font-size: 24px"},"content":"This is H3 tag"}';
$h4 = '{"tag":"h4","endtag":1,"attributes":{"style":"font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;display: block;font-size: 18px"},"content":"This is H4 tag"}';
$h5 = '{"tag":"h5","endtag":1,"attributes":{"style":"font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;display: block;font-size: 14px"},"content":"This is H5 tag"}';
$h6 = '{"tag":"h6","endtag":1,"attributes":{"style":"font-family: inherit; font-weight: 500; line-height: 1.1; color: inherit;display: block;font-size: 12px"},"content":"This is H6 tag"}';
$p = '{"tag":"p","endtag":1,"attributes":{"style":"margin: 0 0 10px; display: block;"},"content":"'.$be_paragraph.'"}';
$img = '{"tag":"img","endtag":0,"attributes":{"style":"vertical-align: middle; max-width: 90%;","src":"'.BASE.'/files/editorscript/images/demo.png"}}';
$a = '{"tag":"a","endtag":1,"attributes":{"style":"display: block;","href":"#"},"content":"Your link here!!!"}';
$a_style_1 = '{"tag":"a","endtag":1,"attributes":{"style":"text-decoration: none !important; background-color: #007e9c; color: white; border-color: #2e6da4;padding: 6px 12px; margin: 0 auto; float: none; display: block; font-size: 14px; font-weight: 400; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; -ms-touch-action: manipulation; touch-action: manipulation; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-image: none; border: 1px solid transparent; border-radius: 4px;","href":"#"},"content":"Hyperlink"}';
$button = '{"tag":"button","endtag":1,"attributes":{"style":"background-color: #337ab7; color: white; border-color: #2e6da4;padding: 6px 12px; margin: 0 auto; float: none; display: block; font-size: 14px; font-weight: 400; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; -ms-touch-action: manipulation; touch-action: manipulation; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-image: none; border: 1px solid transparent; border-radius: 4px;","href":"#"},"content":"If you like click this >>"}';
$input = '{"tag":"input","endtag":0,"attributes":{"style":"display: block; width: 100%; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075); box-shadow: inset 0 1px 1px rgba(0,0,0,.075); -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s; -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;","placeholder":"Type here anything","type":"text"}}';


$col_1_div = '{"tag":"div","endtag":1,"attributes":{"class":"row"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"col-sm-12"},"nodes":['.$h2.','.$p.']}]}';
$col_2_div = '{"tag":"div","endtag":1,"attributes":{"class":"row"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"col-sm-6"},"nodes":['.$h2.','.$p.']},{"tag":"div","endtag":1,"attributes":{"class":"col-sm-6"},"nodes":['.$h2.','.$p.']}]}';

$col_3_div = '{"tag":"div","endtag":1,"attributes":{"class":"row"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"col-sm-4"},"nodes":['.$h2.','.$p.']},{"tag":"div","endtag":1,"attributes":{"class":"col-sm-4"},"nodes":['.$h2.','.$p.']},{"tag":"div","endtag":1,"attributes":{"class":"col-sm-4"},"nodes":['.$h2.','.$p.']}]}';

$video = '{"tag":"div","endtag":1,"attributes":{"class":"embed-responsive embed-responsive-16by9"},"nodes":[{"tag":"iframe","endtag":1,"attributes":{"class":"embed-responsive-item","src":"https://www.youtube.com/embed/zpOULjyy-n8?rel=0","allowfullscreen":""},"content":""}]}';

$navbar = '{"tag":"nav","endtag":1,"attributes":{"class":"navbar navbar-default"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"container-fluid"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"navbar-header"},"nodes":[{"tag":"a","endtag":1,"attributes":{"class":"navbar-brand","href":"#"},"content":"WebSiteName"}]},{"tag":"ul","endtag":1,"attributes":{"class":"nav navbar-nav"},"nodes":[{"tag":"li","endtag":1,"attributes":{"class":"active"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"Home"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"Page 1"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"Page 2"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"Page 3"}]}]}]}]}';

$pagination = '{"tag":"nav","endtag":1,"attributes":{"aria-label":"Page navigation"},"nodes":[{"tag":"ul","endtag":1,"attributes":{"class":"pagination pagination-lg"},"nodes":[{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","aria-label":"Previous"},"nodes":[{"tag":"span","endtag":1,"attributes":{"aria-hidden":"true"},"content":"«"}]}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"1"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"2"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"3"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"4"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"content":"5"}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","aria-label":"Next"},"nodes":[{"tag":"span","endtag":1,"attributes":{"aria-hidden":"true"},"content":"»"}]}]}]}]}';

$i_h1_p_b = '{"tag":"div","endtag":1,"attributes":{"class":"thumbnail"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/editorscript/images/demo.png"},"content":""},{"tag":"div","endtag":1,"attributes":{"class":"caption"},"nodes":[{"tag":"h3","endtag":1,"attributes":{"class":""},"content":"Thumbnail label"},{"tag":"p","endtag":1,"attributes":{"class":""},"content":"'.$be_paragraph.'"},{"tag":"p","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","class":"btn btn-primary","role":"button"},"content":"Button"},{"tag":"a","endtag":1,"attributes":{"href":"#","class":"btn btn-default","role":"button"},"content":"Button"}]}]}]}';

$col_3_div_with_i_h1_p_b = '{"tag":"div","endtag":1,"attributes":{"class":"row"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"col-sm-4"},"nodes":['.$i_h1_p_b.']},{"tag":"div","endtag":1,"attributes":{"class":"col-sm-4"},"nodes":['.$i_h1_p_b.']},{"tag":"div","endtag":1,"attributes":{"class":"col-sm-4"},"nodes":['.$i_h1_p_b.']}]}';

$footer = '{"tag":"div","endtag":1,"attributes":{"id":"single_div"},"nodes":[{"tag":"style","endtag":1,"attributes":{"type":"text/css"},"content":"footer{\n    background-color:rgba(44, 62, 80,1.0);\n    height:300px;\n    width:100%;\n    bottom:0;\n    font-weight:lighter;\n    color:white;\n}\n.footerHeader{\n    width:100%;\n    padding:1em;\n    background-color:rgba(52, 73, 94,1.0);\n    text-align:center;\n    color:white;\n}\nfooter h3{\n    font-weight:lighter;\n}\nfooter ul{\n    padding-left:5px;\n    list-style:none;\n}\nfooter p{\n    text-align : justify;\n    font-size : 12px;\n}\nfooter iframe {\n    width:100%;\n    position:relative;\n    height:170px;\n}\n.sm{\n    list-style:none;\n    overflow:auto;\n}\n.sm li {\n    display: inline;\n    padding:5px;\n    float:left;\n} \n.sm li a img {\n    width:32px;\n}"},{"tag":"footer","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"footerHeader do_not_add_empty_button"},"content":""},{"tag":"div","endtag":1,"attributes":{"class":"container"},"nodes":[{"tag":"div","endtag":1,"attributes":{"class":"col-md-4"},"nodes":[{"tag":"h3","endtag":1,"attributes":{"class":""},"content":"About us"},'.$p.']},{"tag":"div","endtag":1,"attributes":{"class":"col-md-4"},"nodes":[{"tag":"h3","endtag":1,"attributes":{"class":""},"content":"Our Location"},{"tag":"iframe","endtag":1,"attributes":{"src":"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d433868.0837064906!2d35.66744174160663!3d31.836036762053016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b5fb85d7981af%3A0x631c30c0f8dc65e8!2sAmman!5e0!3m2!1sen!2sjo!4v1499168051085","sytle":"","frameborder":"0","style":"border:0","allowfullscreen":""},"content":""}]},{"tag":"div","endtag":1,"attributes":{"class":"col-md-4"},"nodes":[{"tag":"h3","endtag":1,"attributes":{"class":""},"content":"Contact Us"},{"tag":"ul","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"li","endtag":1,"attributes":{"class":""},"content":"Phone : 123 - 456 - 789"},{"tag":"li","endtag":1,"attributes":{"class":""},"content":"E-mail : info@comapyn.com"},{"tag":"li","endtag":1,"attributes":{"class":""},"content":"Fax : 123 - 456 - 789"}]},{"tag":"p","endtag":1,"attributes":{"class":""},"content":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s"},{"tag":"ul","endtag":1,"attributes":{"class":"sm"},"nodes":[{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"https://www.facebook.com/images/fb_icon_325x325.png","class":"img-responsive"},"content":""}]}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"https://lh3.googleusercontent.com/00APBMVQh3yraN704gKCeM63KzeQ-zHUi5wK6E9TjRQ26McyqYBt-zy__4i8GXDAfeys=w300","class":"img-responsive"},"content":""}]}]},{"tag":"li","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"http://playbookathlete.com/wp-content/uploads/2016/10/twitter-logo-4.png","class":"img-responsive"},"content":""}]}]}]}]}]}]}]}';

$social_button = '{"tag":"div","endtag":1,"attributes":{"style":"margin: 0 auto;"},"nodes":[{"tag":"table","endtag":1,"attributes":{"border":"0","cellpadding":"0%","cellspacing":"0%","width":"60%","style":"max-width:100%;font-weight:normal!important; margin: 0 auto;"},"nodes":[{"tag":"tbody","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"tr","endtag":1,"attributes":{"class":""},"nodes":[{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/fb-40x40.png","width":"30","alt":"Facebook","title":"Facebook","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]},{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/twitter-40x40.png","width":"30","alt":"Twitter","title":"Twitter","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]},{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/google-plus-40x40.png","width":"30","alt":"Google +","title":"Google +","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]},{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/linkedin-40x40.png","width":"30","alt":"Linkedin","title":"Linkedin","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]},{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/youtube-40x40.png","width":"30","alt":"YouTube","title":"YouTube","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]},{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/forum-40x40.png","width":"30","alt":"Instant Mailr Forum","title":"Instant Mailr Forum","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]},{"tag":"td","endtag":1,"attributes":{"align":"center","style":"font-weight:normal!important;padding:5px"},"nodes":[{"tag":"a","endtag":1,"attributes":{"href":"#","target":"_blank"},"nodes":[{"tag":"img","endtag":0,"attributes":{"src":"'.BASE.'/files/images/blog-40x40.png","width":"30","alt":"Instant Mailr Blog","title":"Instant Mailr Blog","style":"border-width:0;height:auto;line-height:100%;display:block;outline-style:none;text-decoration:none","class":"CToWUd"},"content":""}]}]}]}]}]}]}';

$optin_form_1 = '{"tag":"form","endtag":1,"attributes":{"class":"i_mailr_optin_form"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"id":"contact-form","class":"form-container","data-form-container":""},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"form-title"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{},"content":"Sign Up for my Newsletter"}]}]},{"tag":"div","endtag":1,"attributes":{"class":"input-container"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"req-input"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"input-status","data-toggle":"tooltip","data-placement":"top","title":"Input Your First Name."},"content":""},{"tag":"input","endtag":0,"attributes":{"type":"text","data-min-length":"8","name":"first_name","placeholder":"First Name"},"content":""}]}]},{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"req-input"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"input-status","data-toggle":"tooltip","data-placement":"top","title":"Input Your Last Name."},"content":""},{"tag":"input","endtag":0,"attributes":{"type":"text","data-min-length":"8","name":"last_name","placeholder":"Last Name"},"content":""}]}]},{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"req-input"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"input-status","data-toggle":"tooltip","data-placement":"top","title":"Please Input Your Email."},"content":""},{"tag":"input","endtag":0,"attributes":{"type":"email","name":"email","placeholder":"Email"},"content":""}]}]},{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"req-input"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"input-status","data-toggle":"tooltip","data-placement":"top","title":"Please Input Your Phone Number."},"content":""},{"tag":"input","endtag":0,"attributes":{"type":"tel","name":"phone","placeholder":"Phone Number"},"content":""}]}]},{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"req-input message-box"},"content":"","nodes":[{"tag":"span","endtag":1,"attributes":{"class":"input-status","data-toggle":"tooltip","data-placement":"top","title":"Please Include a Message."},"content":""},{"tag":"textarea","endtag":1,"attributes":{"type":"textarea","data-min-length":"10","placeholder":"Message", "name":"comment"},"content":""}]}]},{"tag":"div","endtag":1,"attributes":{"class":"row submit-row"},"content":"","nodes":[{"tag":"button","endtag":1,"attributes":{"type":"submit","class":"btn btn-block submit-form"},"content":"Submit"}]}]}]}]}';


include "files/editorscript/phpsection/email_element_array.php";

$drag_and_drop_snippet = array (	
								array(
	                                'id'=>'container_fluid',
	                                'html'=> json_decode($container_fluid,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/container-full.png',
	                                'name'=> 'Full DIV',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'container',
	                                'html'=> json_decode($container,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/container.png',
	                                'name'=> 'Container',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'container',
	                                'html'=> json_decode($container_table,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/container.png',
	                                'name'=> 'Container',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('email')
	                            ),	
	                            array(
	                                'id'=>'col_1_div' ,
	                                'html'=> json_decode($col_1_div,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/1col.png',
	                                'name'=> 'One columns',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'col_2_div' ,
	                                'html'=> json_decode($col_2_div,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/2col.png',
	                                'name'=> 'Tow columns',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'col_3_div' ,
	                                'html'=> json_decode($col_3_div,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/3col.png',
	                                'name'=> 'Three columns',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'col_1_table' ,
	                                'html'=> json_decode($col_1_table,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/col_1_table.png',
	                                'name'=> 'One columns table',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('email')
	                            ),
	                            array(
	                                'id'=>'col_3_table' ,
	                                'html'=> json_decode($col_3_table,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/col_3_table.png',
	                                'name'=> 'Three columns table',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('email')
	                            ),
	                            array(
	                                'id'=>'div',
	                                'html'=> json_decode($div,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/div.png',
	                                'name'=> 'Empty div',
	                                'category'=> array('container_and_div'),
	                                'type'=>array('all')
	                            ),						
								array(
	                                'id'=>'h1' ,
	                                'html'=> json_decode($h1,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/h1.png',
	                                'name'=> 'Headline',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'h2' ,
	                                'html'=> json_decode($h2,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/h2.png',
	                                'name'=> 'Sub headline',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'h3' ,
	                                'html'=> json_decode($h3,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/h3.png',
	                                'name'=> 'H3 text',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'h4' ,
	                                'html'=> json_decode($h4,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/h4.png',
	                                'name'=> 'H4 text',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'h5' ,
	                                'html'=> json_decode($h5,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/h5.png',
	                                'name'=> 'H5 text',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'h6' ,
	                                'html'=> json_decode($h6,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/h6.png',
	                                'name'=> 'H6 text',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'p' ,
	                                'html'=> json_decode($p,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/p.png',
	                                'name'=> 'Paragraph',
	                                'category'=> array('all_element','all_text'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'img' ,
	                                'html'=> json_decode($img,true),
	                                'img'=> BASE.'/files/editorscript/images/demo.png',
	                                'name'=> 'Image',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'button' ,
	                                'html'=> json_decode($button,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/button.png',
	                                'name'=> 'Button',
	                                'category'=> array('all_element','all_form'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'a' ,
	                                'html'=> json_decode($a,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/a.png',
	                                'name'=> 'Hyperlink',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'a_style_1' ,
	                                'html'=> json_decode($a_style_1,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/a_style_1.png',
	                                'name'=> 'Hyperlink 2',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'input' ,
	                                'html'=> json_decode($input,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/input.png',
	                                'name'=> 'Input field',
	                                'category'=> array('all_element','all_form'),
	                                'type'=>array('all')
	                            ),
	                            array(
	                                'id'=>'video' ,
	                                'html'=> json_decode($video,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/video.png',
	                                'name'=> 'Video',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'navbar' ,
	                                'html'=> json_decode($navbar,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/navbar.png',
	                                'name'=> 'Top nav',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'pagination' ,
	                                'html'=> json_decode($pagination,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/pagination.png',
	                                'name'=> 'Pagination',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'col_3_div_with_i_h1_p_b' ,
	                                'html'=> json_decode($col_3_div_with_i_h1_p_b,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/col_3_div_with_i_h1_p_b.png',
	                                'name'=> 'Custom content',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'footer' ,
	                                'html'=> json_decode($footer,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/footer.png',
	                                'name'=> 'Footer',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page')
	                            ),
	                            array(
	                                'id'=>'social_button' ,
	                                'html'=> json_decode($social_button,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/social_button.png',
	                                'name'=> 'Social Button',
	                                'category'=> array('all_element','all_media'),
	                                'type'=>array('page','email')
	                            ),
	                            array(
	                                'id'=>'optin_form_1' ,
	                                'html'=> json_decode($optin_form_1,true),
	                                'img'=> BASE.'/files/editorscript/images/snippets/optin_form_1.png',
	                                'name'=> 'Optin Form 1',
	                                'category'=> array('all_element','all_form'),
	                                'type'=>array('page')
	                            )
                        );
	$drag_and_drop_elements = [];

	$container_and_div = [];
	$all_element = [];
	$all_text = [];
	$all_media = [];
	$all_form = [];
	$all_timer = [];

	foreach ($drag_and_drop_snippet as $key => $value) {
	    if(in_array($page_type, $value['type']) || in_array('all', $value['type'])){
	        $drag_and_drop_elements[] = $value;
	        if(in_array("container_and_div", $value['category'])){
	            $container_and_div[] = $value;
	        }
	        if(in_array("all_element", $value['category'])){
	            $all_element[] = $value;
	        }
	        if(in_array("all_text", $value['category'])){
	            $all_text[] = $value;
	        }
	        if(in_array("all_media", $value['category'])){
	            $all_media[] = $value;
	        }
	        if(in_array("all_form", $value['category'])){
	            $all_form[] = $value;
	        }
	        if(in_array("all_timer", $value['category'])){
	            $all_timer[] = $value;
	        }
	    }
	}

	foreach ($uploads_images_url as $key => $value) {
	    $drag_and_drop_elements[] = $value;
	}

	$drag_and_drop_element_library = [];
	$sql = "SELECT * from my_library WHERE user_id = $user_id ORDER BY id DESC";
	$pres = $mysqli->query($sql);
	while( $arr = $pres->fetch_array( MYSQLI_ASSOC ) ) {
		$lib = $arr['library'];
		$lib = json_decode($lib);
		$temp = array();
		$temp['id']= 'personal_lib_'.$arr['id'];
		$temp['html']= $lib->element;
		$drag_and_drop_element_library[] = $temp;
	}
	foreach ($drag_and_drop_element_library as $key => $value) {
	    $drag_and_drop_elements[] = $value;
	}

	include "files/editorscript/phpsection/element_settings_control.php";      
?>