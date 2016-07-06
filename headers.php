<?php

$contact_email = "alumnioff@iitg.ernet.in";
$fb_link = "https://www.facebook.com/aer.iitg/";
$twitter_link ="https://twitter.com/IITGAER";
$yt_link = "https://youtu.be/2dXxLIZJvdk";

$vars = array(
		'{$contact_email}' => $contact_email,
		'{$fb_link}' => $fb_link,
		'{$twitter_link}' =>$twitter_link,
		'{$yt_link}' => $yt_link
	);



function headers_home($page) {

	
 	$headers = '<header id="page-header-top" class="headerbar">
                
                {$common_headers}
                
                <div class="container">
<section id="region-main" class="hero-unit" style="max-height: 700px; overflow: hidden;"> ';



$headers = strtr($headers, array('{$common_headers}' => common_headers()));

$xml=simplexml_load_file("content/home/images.xml") or die("Error: Cannot create object");

$i = 0;
foreach($xml->children() as $img) {
   $headers .= sprintf('<img class="slider-image slide-%d" style="width: 100%%; display: none;" src="./content/home/images/%s">', $i++, trim($img));
}


$headers.='
  
                    </section>
</div>
            </header>';

            return $headers;
}



function headers_page($page) {

	$headers = '<header id="page-header-top" class="headerbar">

				{$common_headers}
                
                <div class="container">
<section id="region-main" class="hero-unit">
                    <span id="user-notifications"></span>

    <div class="row">                        
    </div>

                </section>
  <div class="row-fluid" style="background-color: rgba(0, 0, 0, 0.88); clear: both;">
        
<div class="centered-parent span4" style="display: inline-block; padding-left: 3%; padding-top:1.5%; padding-bottom: 1.5%; font-size: 12px">
  
  <div><h3>{$page_name}</h3></div>
     <span style="border-radius: 6px; color: wheat; width: auto;" class="centered">';


    $headers = strtr($headers, array('{$common_headers}' => common_headers(), '{$page_name}' => ucfirst(str_replace('_', ' ', $page))));
    


# Add the about content from content file
$xml=simplexml_load_file("content/".$page."/about.xml") or die("Error: Cannot create object");

foreach($xml->children() as $para) {
    $headers .= sprintf("<p>%s</p>", $para);
    $headers .= "<br>";
}



$headers .= '</span>
  </div>
<div class="span8" style="display: inline-block;">
     <div style="display: inline-block; background-color: transparent;" class="feed news">
                                    <img style="max-width: 100%;" src="{$img}">
                                </div>
  
    </div>
    
        
    
       </div>
  
</div>
            </header>';

    $img = "content/".$page."/images/about_img.jpg";
 $headers = strtr($headers, array('{$img}' => $img));
 
 return $headers;
}





function common_headers() {
	global $vars;

	$common_headers = '<div class="navbar navbar-inverse sitebar navbar-fixed-top moodle-has-zindex">
                    <div id="moodlesitestopnavbar">
                        <nav class="navbar-container" role="navigation">
                            <a class="sitelogo" href="http://www.iitg.ernet.in/aa/pages/media/">
                            <img alt="AER, IITG" src="content/common/logo.png" height="25" width="96">
                            </a>
                            <ul>
                                <li class="home">
                                    
<a href="home_final.php" style="padding: 0px; width: auto; height: auto;"><img style="margin-left: auto; margin-right: auto; max-width: 40px;" src="content/common/home_ico.png"></a>
                                </li>
                                <li class="documentation">
                                    <a href="about.php"><span>About Us</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="alumni.php"><span>ALUMNI</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="foreign.php"><span>FOREIGN STUDENTS</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="mou.php"><span>MOUs</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="forms.php"><span>FORMS</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="conferences.php"><span>CONFERENCES</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="mobility.php"><span>MOBILITY</span><span class="placeholder"></span></a>
                                </li>
                                <li class="documentation">
                                    <a href="people_final.php"><span>PEOPLE</span><span class="placeholder"></span></a>
                                </li>
                                
                            </ul>
                        </nav>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <div class="info container" style="padding-top: 35px;">
                    <div style="padding-bottom: 15px;" class="row-fluid">
                        <div class="brand">
                            <a href="#">
                            <img src="home_final_files/log3.png" alt="AER, IITG">
                            </a>
                        </div>
<div style="float: right; padding-top: 20px;" class="brand">
  <span style="position: relative; float: right;">
                            <a style="width: 100px;" href="{$fb_link}}">
                            <img style="width: 45px;" src="home_final_files/social_fb.svg" alt="AER, IITG">

                            </a>
<a href="{$twitter_link}">
                            <img style="width: 45px;" src="home_final_files/social_twi.svg" alt="AER, IITG">

                            </a>
<a style="" href="{$yt_link}">
                            <img style="width: 45px;" src="home_final_files/social_yt.svg" alt="AER, IITG">

                            </a>
  </span>
<br>
<span style="position: relative; float: right; padding: 10px 0px; font-size: 17px; font-weight: 500;"> <img style="max-width: 30px;" src="home_final_files/email_icon.png"> : {$contact_email}</span>
                        </div>
                    </div>
                </div>';


	$common_headers = strtr($common_headers, $vars);

	return $common_headers;
}