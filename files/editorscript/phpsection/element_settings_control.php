<?php
	$style_property = array(
    array('background-repeat' => array('label' => 'BG repeat', 'type' => 'dropdown','options' => array( 'Repeat' => 'repeat','Repeat-x' => 'repeat-x','Repeat-y' => 'repeat-y','No-repeat' => 'no-repeat'))),
    array('background-position' => array('label' => 'BG position', 'type' => 'dropdown','options' => array( 'Top' => 'top','Bottom' => 'bottom','Right' => 'right','Left' => 'left','Left Top' => 'left top','Left Center' => 'left center','Left Bottom' => 'left bottom','Right Top' => 'right top','Right Center' => 'right center','Right Bottom' => 'right bottom','Center Top' => 'center top','Center Center' => 'center center','Center Bottom' => 'center bottom'))),
    array('background-attachment' => array('label' => 'BG attachment', 'type' => 'dropdown','options' => array( 'Scroll' => 'scroll','Fixed' => 'fixed','Local' => 'local'))),
    array('background-color'=> array('label'=> 'BG color','type'=>'colorpicker')),
    array('background-size' => array('label' => 'BG image size', 'type' => 'dropdown','options' => array( 'Auto' => 'auto','Length' => 'length','Cover' => 'cover','Contain' => 'contain'))),
    array('border' => array('label' => 'Border', 'type' => 'dropdown','options' => array('None' => 'none','1px' => '1px','2px' => '2px','3px' => '3px','4px' => '4px','5px' => '5px','6px' => '6px','7px' => '7px','8px' => '8px','9px'=> '9px','10px' => '10px'))),
    array('border-top' => array('label' => 'Border top','type' => 'dropdown','options' => array( 'None' => 'none','1px' => '1px','2px' => '2px','3px'=> '3px','4px' => '4px','5px' => '5px','6px' => '6px','7px' => '7px','8px' => '8px','9px' => '9px','10px' => '10px'))),
    array('border-bottom' => array('label' => 'Border bottom', 'type' => 'dropdown','options' => array( 'None' => 'none','1px'=> '1px','2px' => '2px','3px' => '3px','4px' => '4px','5px' => '5px','6px' => '6px','7px' => '7px','8px' => '8px','9px' => '9px','10px' => '10px'))),
    array('border-right' => array('label' => 'Border right', 'type' =>'dropdown','options' => array( 'None' => 'none','1px' => '1px','2px' => '2px','3px' => '3px','4px' => '4px','5px' => '5px','6px' => '6px','7px' => '7px','8px' => '8px','9px' => '9px','10px' => '10px'))),
    array('border-left' => array('label' => 'Border left', 'type' => 'dropdown','options' => array( 'None' => 'none','1px' => '1px','2px' => '2px','3px' => '3px','4px' => '4px','5px' => '5px','6px' =>'6px','7px' => '7px','8px' => '8px','9px' => '9px','10px' => '10px'))),
    array('border-style' => array('label' => 'Border style', 'type' => 'dropdown','options' =>array( 'None' => 'none','Solid' => 'solid','Dotted' => 'dotted','Double' => 'double','Dashed' =>'dashed','Groove'=>'groove','Ridge'=>'ridge','Inset'=>'inset','Outset'=>'outset'))),
    array('border-color' => array('label' => 'Border color', 'type' => 'colorpicker')),
    array('border-radius' =>array('label' => 'Border radius', 'type' => 'dropdown','options' => array( 'None' => '0px','Circle' => '50%','Roundcorners' => '4px'))),
    // array('box-shadow' => array('label' => 'Box shadow', 'type' => 'dropdown','options' => array( 'none' => 'none','5% Drop shadow ' => 'rgba(0,0,0,0.05) 0px 1px 5px','10% Drop shadow ' => 'rgba(0,0,0,0.1) 0px 1px 5px','20% Drop shadow ' => 'rgba(0,0,0,0.2) 0px 1px 5px','30% Drop shadow ' => 'rgba(0,0,0,0.3) 0px 1px 5px','40% Drop shadow ' => 'rgba(0,0,0,0.4) 0px 1px 5px','5% Inner shadow' => 'rgba(0,0,0,0.05) 0px 1px 5px inset','10% Inner shadow' => 'rgba(0,0,0,0.1) 0px 1px 5px inset','20% Inner shadow' => 'rgba(0,0,0,0.2) 0px 1px 5px inset','30% Inner shadow' => 'rgba(0,0,0,0.3) 0px 1px 5px inset','40% Inner shadow' => 'rgba(0,0,0,0.4) 0px 1px 5px inset')) ),
    array('color'=> array('label'=> 'Color','type'=> 'colorpicker')),
    array('font-family'=> array('label'=> 'Font family','type'=> 'dropdown','options'=>array('Arimo'=>'Arimo','Open Sans'=>'Open Sans','Lato'=>'Lato','Droid Serif'=>'Droid Serif','Neuton'=>'Neuton','Quattrocento'=>'Quattrocento','Architects Daughter'=>'Architects Daughter','Coming Soon'=>'Coming Soon','Cabin Sketch'=>'Cabin Sketch','Dancing Script'=>'Dancing Script','Permanent Marker'=>'Permanent Marker','Rochester'=>'Rochester'))),
    array('font-style' => array('label' => 'Font style', 'type' => 'dropdown','options' => array( 'Normal' => 'normal','Italic'=> 'italic','Oblique' => 'oblique'))),
    array('font-size' => array( 'label' => 'Font size','type'=> 'slider','max' => 100,'min' => 10,'suffix' => 'px' ) ),
    array('font-weight' => array('label' => 'Font weight', 'type' => 'dropdown','options' => array( 'Normal' => 'normal','Bold'=> 'bold'))),
    array('height' => array( 'label'=> 'Height','type' => 'slider','max' => 720,'min' => 10,'suffix' => 'px' ) ),
    array('line-height' =>array('label' => 'Line height', 'type' => 'dropdown','options' => array( 'Initial' => 'initial','9.8px' => '9.8px','14px' => '14px','18px' => '18.2px','23px' => '23px','28px' => '28px','31px' => '31px','35px' => '35px','40px' => '40px','45px' => '45px','50px' => '50px','55px' => '55px' )) ),
    array('letter-spacing' => array('label' => 'Letter spacing', 'type' => 'dropdown','options' => array( 'Normal' => 'normal','1px' => '1px','2px' => '2px','3px'=> '3px','-1px'=>'-1px' )) ),
    array('margin' => array( 'label' =>'Margin','type' => 'slider','max' => 100,'min' => -50,'suffix' => 'px' ) ),
    array('margin-top' => array( 'label' =>'Margin top','type' => 'slider','max' => 500,'min' => -500,'suffix' => 'px' ) ),
    array('margin-bottom' =>array( 'label' => 'Margin bottom','type' => 'slider','max' => 500,'min' => -500,'suffix' => 'px' ) ),
    array('margin-left' => array( 'label' => 'Margin left','type' => 'slider','max' => 500,'min' => -500,'suffix' => 'px' ) ),
    array('margin-right' => array( 'label' => 'Margin right','type' => 'slider','max' => 500,'min' => -500,'suffix' => 'px') ),         
    array('opacity'=> array('label'=> 'Opacity','type'=> 'dropdown','options' => array( 'None' => '1','Light fade' => '0.5','Extra-fade' => '0.2' ) ) ),           
    array('padding' => array( 'label'=> 'Padding','type' => 'slider','max' => 500,'min' => 0,'suffix' => 'px' ) ),
    array('padding-top' => array( 'label' =>'Padding top','type' => 'slider','max' => 500,'min' => 0,'suffix' => 'px' ) ),          
    array('padding-right' =>array( 'label' => 'Padding right','type' => 'slider','max' => 500,'min' => 0,'suffix' => 'px' ) ),          
    array('padding-bottom' => array( 'label' => 'Padding bottom','type' => 'slider','max' => 500,'min' => 0,'suffix' => 'px') ),          
    array('padding-left' => array( 'label' => 'Padding left','type' => 'slider','max' => 500,'min' => 0,'suffix' => 'px' ) ),
    array('text-transform' => array('label' => 'Text transform', 'type' => 'dropdown','options' => array( 'Normal' => 'none','Uppercase' => 'uppercase','Lowercase' => 'lowercase','Capitalize'=>'capitalize' ) ) ),
    array('text-shadow' => array('label' => 'Text shadow', 'type' => 'dropdown','options' => array( 'No shadow' => 'none','Subtle shadow' => '1px 1px 1px rgba(0,0,0,0.2)','Mid shadow' => '1px 1px 2px rgba(0,0,0,0.4)','Strong shadow'=> '1px 1px 3px rgba(0,0,0,0.5)')) ),
    array('text-align' => array('label' => 'Text align', 'type' => 'dropdown','options' => array( 'Center' => 'center','Left' => 'left','Right' => 'right','Justify' => 'justify')) ),
    array('text-decoration' => array('label' => 'Text decoration', 'type' => 'dropdown','options' => array( 'None' => 'none','Underline' => 'underline','Line through' => 'line-through'))),
    array('transition' => array( 'label' => 'Transition','type' => 'dropdown','options' => array( 'None' => 'all 0s ease 0s ','0.5sec' => 'all 0.5s ease 0.5s ','1sec' => 'all 1s ease 1s ','2sec' => 'all 2s ease 2s ')) ),
    array('width' => array( 'label' => 'Width','type' => 'slider','max' => 1280,'min' => 10,'suffix' => 'px' ) ),    
    array('placeholder' => array( 'label' => 'Placeholder','type' => 'placeholder') ),
    array('href' => array( 'label' => 'Href','type' => 'href') ),
    array('alt' => array( 'label' => 'Alt text','type' => 'alt') ),
    array('text_input' => array( 'label' => 'Change text','type' => 'text_input') ),
    array('href-target' => array('label' => 'Target', 'type' => 'dropdown','options' => array( 'Opens in this tab' => '_self','Opens in a new tab' => '_blank') ) ),
    array('add_class' => array('label' => 'Classes', 'type' => 'add_class' ) ),
    array('inline_css' => array('label' => 'Inline css', 'type' => 'inline_css' ) ),
    array('position' => array('label' => 'Position', 'type' => 'dropdown','options' => array( 'Left' => 'left','Center' => 'center','Right' => 'right') ) ),
    array('hide-on-mobile' => array('label' => 'Hide on mobile', 'type' => 'dropdown','options' => array( 'No' => 'no','Yes' => 'yes') ) ),
    array('hide-on-desktop' => array('label' => 'Hide on desktop', 'type' => 'dropdown','options' => array( 'No' => 'no','Yes' => 'yes') ) ),
    array('name' => array( 'label' => 'Set input name','type' => 'name') ),
    );
    
$tags = array("a","b","body","br","button","div","footer","h1","img","input","label","li","link","nav","p","span","strong","table","td","textarea","th","title","tr","ul");
$tags_css_attr = array(
        "a"=>array('settings'=>'text_input,height,width,font-style,font-weight,font-size,text-decoration,background-color,color,text-shadow,href,href-target','advanced'=>array('styles'=> 'padding,padding-top,padding-bottom,padding-left,padding-right,border-radius,border,border-style,border-color,text-transform,letter-spacing,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "article"=>array( 'settings'=>'text_input,text-align,font-family,font-size,font-style,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "area"=>array('settings'=>'height,width,border-radius,background-color,opacity','advanced'=> array ('styles'=>'margin-top,margin-bottom,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "aside"=>array( 'settings'=>'text-align,font-family,font-size,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "b"=>array('settings'=>'text_input,font-family,font-size,font-weight,color','advanced'=>array('styles'=> 'letter-spacing,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "bdi"=>array('settings'=>'text-align,font-family,font-size,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "bdo"=>array('settings'=>'text-align,font-family,font-size,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "blockquote"=>array( 'settings'=>'text-align,font-family,font-size,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "body"=>array('settings'=>'background-color','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-bottom,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "button"=>array('settings'=>'text_input,background-color,color,position,width,height,font-family,font-size,font-style,font-weight','advanced'=>array('styles'=> 'margin-top,margin-bottom,margin-left,padding,padding-top,padding-bottom,padding-left,padding-right,border-radius,border,border-style,border-color,text-transform,letter-spacing,text-align,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "caption"=>array( 'settings'=>'text-align,font-family,font-size,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "center"=>array('settings'=>'font-family,font-size,font-weight,color','advanced'=>array('styles'=> 'letter-spacing,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "cite"=>array( 'settings'=>'font-family,font-size,font-style,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "details"=>array( 'settings'=>'text-align,font-family,font-size,font-weight,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "div"=>array( 'settings'=>'text-align,background-color,color,position,font-family,font-size,font-style,font-weight,width,height,background-repeat,background-position,background-size,background-attachment,border-radius','advanced'=>array('styles'=> 'margin,margin-top,margin-bottom,margin-left,margin-right,padding,padding-top,padding-bottom,padding-left,padding-right,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "fieldset"=>array( 'settings'=>'background-color,color,border-radius,padding','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,padding-left,padding-right,border,border-color,border-style,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "figcaption"=>array( 'settings'=>'font-family,font-size,font-weight,text-align,background-color,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "footer"=>array( 'settings'=>'font-family,font-size,font-style,font-weight,text-align,background-color,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "h1"=>array( 'settings'=>'text_input,text-align,font-family,font-size,background-color,color,font-style,font-weight,text-transform,text-decoration,text-shadow,line-height,letter-spacing','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "h2"=>array( 'settings'=>'text_input,text-align,font-family,font-size,background-color,color,font-style,font-weight,text-transform,text-decoration,text-shadow,line-height,letter-spacing','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "h3"=>array( 'settings'=>'text_input,text-align,font-family,font-size,background-color,color,font-style,font-weight,text-transform,text-decoration,text-shadow,line-height,letter-spacing','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "h4"=>array( 'settings'=>'text_input,text-align,font-family,font-size,background-color,color,font-style,font-weight,text-transform,text-decoration,text-shadow,line-height,letter-spacing','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "h5"=>array( 'settings'=>'text_input,text-align,font-family,font-size,background-color,color,font-style,font-weight,text-transform,text-decoration,text-shadow,line-height,letter-spacing','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "h6"=>array( 'settings'=>'text_input,text-align,font-family,font-size,background-color,color,font-style,font-weight,text-transform,text-decoration,text-shadow,line-height,letter-spacing','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "hr"=>array('settings'=>'height,width,opacity','advanced'=> array ('styles'=>'margin-top,margin-bottom,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),


        "iframe"=>array( 'settings'=>'margin-top,width,height,position,padding-top,padding-bottom,padding-left,padding-right','advanced'=>array('styles'=> 'border-radius,border,border-style,border-color,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "img"=>array('settings'=>'alt,height,width,background-color,border-radius,opacity','advanced'=> array ('styles'=>'margin-top,margin-bottom,margin-left,margin-right,padding,border,border-color,border-style,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "input"=>array( 'settings'=>'name,placeholder,text-align,position,width,height,color,text-transform,letter-spacing','advanced'=>array('styles'=> 'margin-top,padding-top,padding-bottom,padding-left,padding-right,border-radius,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "label"=>array( 'settings'=>'text_input,font-family,font-size,font-style,font-weight,color,text-shadow','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "legend"=>array( 'settings'=>'text-align,font-family,font-size,font-style,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "li"=>array( 'settings'=>'text_input,text-align,font-family,font-size,font-style,font-weight,background-color,color,text-shadow','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "main"=>array( 'settings'=>'text-align,width,height,background-repeat,background-position,background-size,background-attachment,background-color,color,border-radius','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding,padding-top,padding-bottom,padding-left,padding-right,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "nav"=>array( 'settings'=>'text-align,font-family,font-size,font-style,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "p"=>array( 'settings'=>'text_input,background-color,text-align,font-family,font-size,font-style,font-weight,color,text-shadow','advanced'=>array('styles'=> 'margin,margin-top,margin-bottom,margin-left,margin-right,padding,padding-top,padding-bottom,padding-left,padding-right,text-transform,line-height,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "section"=>array( 'settings'=>'text-align,width,height,background-color,background-repeat,background-position,background-size,background-attachment,color,border-radius','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding,padding-top,padding-bottom,padding-left,padding-right,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "select"=>array( 'settings'=>'name,text-align,position,width,height,background-color,color','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding,padding-top,padding-bottom,padding-left,padding-right,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "span"=>array('settings'=>'text_input,text-align,font-family,font-size,font-style,font-weight,background-color,color,text-shadow','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "strong"=>array( 'settings'=>'font-size,font-style,font-weight,color','advanced'=>array('styles'=> 'letter-spacing,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "summary"=>array( 'settings'=>'text-align,font-family,font-size,font-style,font-weight,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "table"=>array( 'settings'=>'text-align,width,height,background-color,color,border-radius,padding','advanced'=>array('styles'=> 'margin-top,margin-bottom,padding-top,padding-bottom,padding-left,padding-right,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "td"=>array( 'settings'=>'text-align,background-color,color,position,font-family,font-size,font-style,font-weight,width,height,background-repeat,background-position,background-size,background-attachment,border-radius','advanced'=>array('styles'=> 'margin,margin-top,margin-bottom,margin-left,margin-right,padding,padding-top,padding-bottom,padding-left,padding-right,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "th"=>array( 'settings'=>'font-family,font-size,font-style,font-weight,text-align,width,height,background-color,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
        "textarea"=>array( 'settings'=>'name,width,height,placeholder,text-align,font-family,font-size,font-style,font-weight,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,background-color,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "title"=>array( 'settings'=>'text_input,font-family,font-size,font-style,font-weight,text-align,background-color,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "tr"=>array( 'settings'=>'width,height,background-color,color','advanced'=>array('styles'=> 'hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "ul"=>array( 'settings'=>'font-family,font-size,font-style,font-weight,background-color,color','advanced'=>array('styles'=> 'margin-top,padding-bottom,text-transform,letter-spacing,opacity,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),

        "video"=>array('settings'=>'height,width,border-radius,opacity','advanced'=> array ('styles'=>'margin-top,margin-bottom,border,border-style,border-color,hide-on-mobile,hide-on-desktop,add_class,inline_css','animation'=> '')),
    );
?>