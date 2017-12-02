<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
$this->layout = false;
?>
<!DOCTYPE html>
<html>

<head>
    <title>HuBhu – Humans Being Human</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
</head>

<body class="home_scroll">
    <div class="preloader">
        <div class="progress_container">
            <div class="progress_bar tip"></div>
        </div>
        <div class="text-container">
            <div class="text-content">
                <h2>"The only source of knowledge is experience."</h2>
                <span class="author">Albert Einstein</span>
            </div>
        </div>
    </div>
    <div class="main_wrapper">
		<div class="wrapper homepage">
			<header class="site_header">
				<nav class="navbar">
					<div class="container-fluid">
						<div class="navbar-header">
							<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="./"><img src="images/logo.png" alt="logo" /></a>
						</div>
						<div id="navbar" class="navbar-collapse collapse" aria-expanded="false">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="what-is-hubhu.html">What is huBhu</a></li>
								<li><a href="how-it-works.html">How it Works</a></li>
								<li><a href="about-us.html">About Us</a></li>
								<li class="donate-active"><a href="donate.html" >DONATE</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</header>
			<div class="wrapper_section">
				<section class="new_section no_padding full_vh_vertical video-blk" id="banner_hubhu" data-section-name="banner_hubhu">
					<video id="home_video" loop muted poster="images/hm-banner.jpg">
						<source src="video/first-section.mp4" type="video/mp4">
						<source src="video/first-section.webm" type="video/webm">
						<source src="video/first-section.ogv" type="video/ogg">
					</video>
					<div class="overlay"></div>
					<div class="vertical_center">
						<div class="layer">
							<div class="container">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="blk-1-content">
                                            <h4>Humans Being Human</h4>
											<h1>The Experience of the <br /> World is at Your Fingertips</h1>
											<p>Find solutions to your life's challenges <br />tailored especially for you.</p>
											<a class="join-hubhu green_underline" href="#join_hubhu">Join Hubhu</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="new_section no_padding full_vh_vertical" id="what_video" data-section-name="what_video">
					<div class="vertical_center">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
									<h4>Watch our video</h4>
									<strong>What is huBhu</strong>
									<div class="yt_player_cover">
										<div id="player" class="yt_player"></div>
										<div class="overlay yt_height_overlay"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="new_section full_vh_vertical" id="info_hubhu" data-section-name="info_hubhu">
					<video loop muted poster="images/third-banner.jpg">
						<source src="video/third-section.mp4" type="video/mp4">
						<source src="video/third-section.webm" type="video/webm">
						<source src="video/third-section.ogv" type="video/ogg">
					</video>
					<div class="overlay"></div>
					<div class="vertical_center">
						<div class="info_grid">
							<div class="container">
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="what-is-hubhu-blk info_box">
											<a href="what-is-hubhu.html">
												<span class="info_box_content">
													<strong>What is huBhu</strong>
													<p>A safe place to share your story while learning from the life experiences of other human beings. Learn more about the movement.</p>
													<span>Read more</span>
												</span>
											</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="how-it-works-blk info_box">
											<a href="how-it-works.html">
												<span class="info_box_content">
													<strong>How it Works</strong>
													<p>Share your genius to help others while harnessing the power of shared life experiences. Learn more about the platform.</p>
													<span>Read more</span>
												</span>
											</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="about-us-blk info_box last_info">
											<a href="about-us.html">
												<span class="info_box_content">
													<strong>About Us</strong>
													<p>Meet the people behind Humans Being Human.</p>
													<span>Read more</span>
												</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="new_section full_vh_vertical" id="join_hubhu" data-section-name="join_hubhu">
					<div class="vertical_center">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="join-us">
										<hr>
										<h2>Join Us</h2>
										<p>Subscribe to be the first to know when huBhu is up!</p>
										<div class="newsletter">
											<!-- Starting design and Mailchimp API Integration-->
											<form method="post" id="subscribe_list1">
												<div class="input_merge">					
													<input placeholder="Your E-mail" type="email" id="subscribe_list1_email" name="email">
													<input type="hidden"  id="list" name="list" value="1">
													<input value="Subscribe" type="submit" class="subscribe-button">
													<p class="message1 form-alert"></p>
												</div>
											</form>                                            
											<!-- Starting design and Mailchimp API Integration -->
										</div>
									</div>
									<div class="donate">
										<p>Help us in supporting huBhu community by donating!</p>
										<a href="donate.html" >DONATE</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<footer>
					<div class="footer_info">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<ul>
										<li><a href="https://www.facebook.com/realhubhu/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li><a href="https://www.youtube.com/channel/UCwC9uTTkZyMwUmRrxK03LXA" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
										<!-- <li><a href="" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li> -->
										<li><a href="https://twitter.com/@realhubhu" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										<!-- <li><a href="" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li> -->
									</ul>
									<p>Copyright &copy; 2017 huBhu</p>
								</div>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://www.youtube.com/iframe_api"></script>
		<script src="js/jquery.visible.min.js"></script>
		<script src="js/jquery.scrollify.js"></script>
		<script src="js/object-fit-videos.min.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/custom_home.js"></script>
		<script src="js/landing-script.js"></script>
    </div>
</body>

</html>
