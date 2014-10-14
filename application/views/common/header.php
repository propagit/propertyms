<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<!--font-awesome -->
<link rel="stylesheet" href="<?=base_url();?>assets/font-awesome/css/font-awesome.min.css">
<!--styles-->
<link rel="stylesheet" href="<?=base_url();?>assets/css/styles.css">
<title>Property Ms</title>
</head>
<?php
	$cur_page = $this->uri->segment(1);
?>
<body>
<header>
    <div id="head-wrap">
        <div class="container">
        	<div id="logo">
        		<a href="<?=base_url();?>"><img src="<?=base_url();?>assets/img/logo.png" alt="logo.png" title="PropertyMS Logo" /></a>
            </div>
            
            <div id="nav-wrap">
            	<ul class="nav-alt">
                	<li <?=$cur_page ? '' : 'class="active"';?>><a href="<?=base_url();?>">Home</a></li>
                    <li <?=$cur_page == 'about-us' ? 'class="active"' : '';?>><a href="<?=base_url();?>about-us">About Us</a></li>
                    <li <?=$cur_page == 'service' ? 'class="active"' : '';?>><a href="<?=base_url();?>service">Service</a></li>
                    <li <?=$cur_page == 'case-studies' ? 'class="active"' : '';?>><a href="<?=base_url();?>">Case Studies</a></li>
                    <li <?=$cur_page == 'testimonials' ? 'class="active"' : '';?>><a href="<?=base_url();?>testimonials">Testimonials</a></li>
                    <li <?=$cur_page == 'contact-us' ? 'class="active"' : '';?>><a href="<?=base_url();?>contact-us">Contact Us</a></li>
                </ul>
            </div>
            
        </div>
    </div>
	
</header>

<div id="body-wrap">
