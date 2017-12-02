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
    <title>Donate to huBhu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.scrollbar.css" />
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
								<li class="donate-active"><a href="javascript:void(0)" onclick="$('#paypal_donate').click();">DONATE</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</header>
            <div class="wrapper_sub donate-page">
				<!-- <div class="navigate_arrow">
					<a href="/" class="toggle-back"><i class="i-left-arrow i-icon"></i></a>
				</div> -->
				<div class="page_title">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post" class="payPalForm" id="payPalForm">
								<h1 class="page-title"><span>Donate to huBhu</span></h1>
								<p class="title-description">Hubhu is a place where you come to tell your story. All of us have challenges. And we also have solutions. huBhu is a place where you can share both, help yourself, and help others too.</p>
								<input type="hidden" name="cmd" value="_donations" />
								<input type="hidden" name="item_name" value="Donation" />
								<!-- Your PayPal email: -->
								<input type="hidden" name="business" value="donatehubhu@us.com" />
								<!-- The return page to which the user is navigated after the donations is complete: -->
								<input type="hidden" name="return" value="http://192.168.1.218/projects/hubhu/development/return.php" /> 
								<!-- Signifies that the transaction data will be passed to the return page by POST -->
								<input type="hidden" name="rm" value="2" /> 
								<input type="hidden" name="no_note" value="1" />
								<input type="hidden" name="cbt" value="Go Back To The Site" />
								<input type="hidden" name="no_shipping" value="1" />
								<input type="hidden" name="lc" value="US" />
								<input type="hidden" name="currency_code" value="USD" />
								<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest" />
								<input type="hidden" name="amount" id="amount" value="0">
								<input type="hidden" name="src" value="0">
								<input type="hidden" name="cancel_return" value="http://192.168.1.218/projects/hubhu/development/return.php" /> 
								<div class="input-group input-donate">
								  <span class="input-group-addon">$</span>
									<input type="text" class="form-control" name="pre_amount" id="pre_amount"  placeholder="Amount"/>
								</div>
								<button class="green_btn" type="button" onsubmit="return false;" id="paypal_donate">DONATE</button>
								<p class="paypal_error form-alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Please enter a valid amount.</p>
								</form>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div id="sample_goalA"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="donors_list">
								<div class="scrollbar-inner">
									<ul id="donors_list">
									</ul>
								</div>
							</div>
						</div>
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
										<a href="javascript:void(0)" onclick="$('#paypal_donate').click();">DONATE</a>
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
				<div class="modal fade" id="donate_modal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="javascript:void(0)" method="post">
							<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><span id="resp_status"></span></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" id="donor_txn_id" value="">
								<p class="rank_holder">Congratulations <span id="donor_name"></span>, you are a <span id="donor_type"></span> Donor!</p>
							</div>
							<div class="modal-footer">
								<p class="rank_holder">Would you like your name to be listed on huBhu website?</p>
								<div class="modal-footer-btn">
									<button type="button" class="green_btn rank_holder" id="show_my_name">Show my name</button>
									<button type="button" class="green_btn btn-nobg rank_holder" data-dismiss="modal">No, Thanks</button>
									<button type="button" class="green_btn hide" data-dismiss="modal" id="modal_close">Close</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>

		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.scrollify.js"></script>
		<script src="js/jquery.scrollbar.min.js"></script>
		<script src="js/goalProgress.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/custom_sub.js"></script>
		<script src="js/landing-script.js"></script>
		<script>
			jQuery('.scrollbar-inner').scrollbar();
			$(window).on('load',function(){
				load_goal_donor();
				load_popup();
			});
			
			setInterval(function() {
				load_goal_donor();
			}, 10 * 60 * 1000);
			
			$('#paypal_donate').click(function () {
				var numbers = /^[1-9]\d*(\.\d+)?$/;
				var pre_amount=$("#pre_amount").val();
				if (!pre_amount.match(numbers)) {
					if ($(".paypal_error").hasClass("success")) {
						$(".paypal_error").removeClass("success");
					}
					$(".paypal_error").fadeIn(500);
					$('#pre_amount').focus();
				} 
				else
				{
					$(".paypal_error").fadeOut();
					var amount = (parseFloat(pre_amount)+parseFloat(0.3))/parseFloat(0.971);
					$('#amount').val(amount.toFixed(2));
					$('#payPalForm').submit();
					
				}
			});

		</script>
		
	</div>
</body>

</html>

