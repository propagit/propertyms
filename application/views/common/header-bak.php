<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<!--font-awesome -->
<link rel="stylesheet" href="<?=base_url();?>assets/font-awesome/css/font-awesome.min.css">
<!--styles-->
<link rel="stylesheet" href="<?=base_url();?>assets/css/styles.css">

<!--jQuery -->
<script src="<?=base_url();?>assets/js/jquery.js"></script>
<title><?=$title;?> - Property Ms</title>
<meta name="description" content="<?=$desc;?>" />
<meta name="keyword" content="<?=$keywords;?>" />
</head>
<?php
	$cur_page = $this->uri->segment(1) ? $this->uri->segment(1) : 'home';
	if($cur_page == 'recent-projects'){
		$sub_page = 	$this->uri->segment(2);
	}else{
		$sub_page = "";	
	}
?>
<body <?=$cur_page ? 'class="'.$cur_page.'-bg"' : '';?>>
<header>
    <div id="head-wrap">
        <div id="logo">
            <a href="<?=base_url();?>"><img src="<?=base_url();?>assets/img/logo.png" alt="logo.png" title="PropertyMS Logo" /></a>
        </div>
        
        <div id="nav-wrap">
            <ul class="nav-alt">
                <li <?=$cur_page == 'home' ? 'class="active"' : '';?>><a href="<?=base_url();?>">Home</a></li>
                <li <?=$cur_page == 'about-us' ? 'class="active"' : '';?>><a href="<?=base_url();?>about-us">About Us</a></li>
                <li <?=$cur_page == 'services' ? 'class="active"' : '';?>><a href="<?=base_url();?>services">Services</a></li>
                <li class="nav-dd <?=$cur_page == 'recent-projects' ? 'active' : '';?>"><a href="#">Recent Projects</a></li>
                    <li class="sub-nav <?=$sub_page == "mandalay-at-beveridge"  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mandalay-at-beveridge">Mandalay at Beveridge</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == "mab-corporation"  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mab-corporation">MAB Corporation</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mandalay-at-beveridge">Mandalay at Beveridge</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mab-corporation">MAB Corporation</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mandalay-at-beveridge">Mandalay at Beveridge</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mab-corporation">MAB Corporation</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mandalay-at-beveridge">Mandalay at Beveridge</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mab-corporation">MAB Corporation</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mandalay-at-beveridge">Mandalay at Beveridge</a>
                    </li>
                    <li class="sub-nav <?=$sub_page == ""  ? 'sub-nav-active' : '';?>" <?=$cur_page == 'recent-projects' ? 'style="display:block;"' : '';?>>
                    	<a href="<?=base_url();?>recent-projects/mab-corporation">MAB Corporation</a>
                    </li>
                <li <?=$cur_page == 'testimonials' ? 'class="active"' : '';?>><a href="<?=base_url();?>testimonials">Testimonials</a></li>
                <li <?=$cur_page == 'contact-us' ? 'class="active"' : '';?>><a href="<?=base_url();?>contact-us">Contact Us</a></li>
            </ul>
        </div>
    </div>
	
</header>

<div id="body-wrap">
