<!DOCTYPE HTML>
<html>
<head>
<title>Super Admin | Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="<?=base_url()?>extras/system/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="<?=base_url()?>extras/system/css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="<?=base_url()?>extras/system/css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <link href='<?=base_url()?>extras/system/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->

 <!-- js-->
<script src="<?=base_url()?>extras/system/js/jquery-1.11.1.min.js"></script>
<script src="<?=base_url()?>extras/system/js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->

<!-- Metis Menu -->
<script src="<?=base_url()?>extras/system/js/metisMenu.min.js"></script>
<script src="<?=base_url()?>extras/system/js/custom.js"></script>
<link href="<?=base_url()?>extras/system/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head>
<body>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Admin Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="<?=base_url()?>index.php/auth/login" method="post">
							<input type="email" class="user" name="email" placeholder="Enter Your Email" required="">
							<input type="password" name="password" class="lock" placeholder="Password" required="">
							<div class="forgot-grid">
								<div class="forgot">
									<a href="#">Forgot Password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Sign In" value="Sign In">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		<div class="modal fade" id="myModal" role="dialog">
	 <div class="modal-dialog">

		 <!-- Modal content-->
		 <div class="modal-content">
			 <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
				 <h4 class="modal-title">Forgot Password</h4>
			 </div>
			 <div class="modal-body">
				 <form action="<?=base_url()?>index.php/auth/login" method="post">
 					<input type="email" class="user" name="email" placeholder="Enter Your Email" required="">
 					<input type="password" name="password" class="lock" placeholder="Password" required="">
 					<div class="forgot-grid">
 						<div class="forgot">
 							<a  data-toggle="modal" data-target="#myModal">Forgot Password?</a>
 						</div>
 						<div class="clearfix"> </div>
 					</div>
 					<input type="submit" name="Sign In" value="Sign In">
 				</form>
			 </div>
			 <div class="modal-footer">
				 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			 </div>
		 </div>

	 </div>
 </div>
		<div class="footer">
		   <p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
     </div>
        <!--//footer-->


	<!-- side nav js -->
	<script src='<?=base_url()?>extras/system/js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->

	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="<?=base_url()?>extras/system/js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->

	<!--scrolling js-->
	<script src="<?=base_url()?>extras/system/js/jquery.nicescroll.js"></script>
	<script src="<?=base_url()?>extras/system/js/scripts.js"></script>
	<!--//scrolling js-->

	<!-- Bootstrap Core JavaScript -->
   <script src="<?=base_url()?>extras/system/js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->

</body>
</html>
