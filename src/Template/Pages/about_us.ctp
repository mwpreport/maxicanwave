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
    <title>About Us</title>
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

<body>
	<div class="main_wrapper">
        <div id="sub_page" class="wrapper new_section">
			<header class="site_header">
				<nav class="navbar navbar-fixed-top navbar-inverse">
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
            <div class="wrapper_sub about-us-page">
				<!-- <div class="navigate_arrow">
					<a href="/" class="toggle-back"><i class="i-left-arrow i-icon"></i></a>
				</div> -->
				<div class="page_title">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<h1 class="page-title"><span>About Us</span></h1>
								<p class="title-description">Srini Pillay, Daron Shepard and Zachary Renner are the founders of huBhu.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<article class="about_grid">
								<div class="img-center"><img src="images/article1.jpg" class="img-responsive" alt="article1" /></div>
								<p>Srini is a physician who trained as a psychiatrist and brain-imaging researcher. He is also a musician and holds the IP for multiple technologies in development for health, wellness and leadership development. He leads several initiatives that bridge the arts, sciences and technology including a fund called CNT (creative neurotechnology).</p>
							</article>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<article class="about_grid">
								<div class="img-center"><img src="images/article2.jpg" class="img-responsive" alt="article2" /></div>
								<p>Daron is a business executive whose business ventures and professional career focus on leading organizations and individuals towards improving their performance. Trained as a psychotherapist and exercise physiologist, Daron co-founded and leads a cognitive behavioral based counseling and coaching provider (STEP UP) and a worksite health and fitness provider (Pro-Fitness Health Solutions); coaches high school football, facilitates C-Level peer advisory groups (Vistage International) and is a trusted executive coach for CEO's and business owners. </p>
							</article>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<article class="about_grid">
								<div class="img-center"><img src="images/article3.jpg" class="img-responsive" alt="article3" /></div>
								<p>Zachary is a technology strategist and futurist whose career is rooted in understanding the evolving relationship between human beings and technology. His passion lies in creating emotionally intelligent technology where AI and human beings work together to improve the quality of life for all. Currently, he helps clients create solutions and strategies for their most complex technical problems by asking the right questions at the right time and challenging the status quo. He also mentors and coaches young professionals and students as they navigate the transition from academia to the professional world.</p>
							</article>
						</div>
					</div>
					<div class="row">
						<p class="col-md-12 enquiry">For inquiries, you can reach us at <a href="mailto:info@hubhu.org">info@hubhu.org</a></p>
					</div>
				</div>
			</div>
		</div>
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
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.scrollify.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/custom_sub.js"></script>
		<script src="js/landing-script.js"></script>
	</div>
</body>

</html>
