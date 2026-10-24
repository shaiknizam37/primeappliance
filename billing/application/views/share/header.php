<!DOCTYPE HTML>
<html>
<head>
<title><?=PROJECT_NAME?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="<?=base_url()?>extras/system/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="<?=base_url()?>extras/system/css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="<?=base_url()?>extras/system/css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='<?=base_url()?>extras/system/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->


 <!-- js-->
<script src="<?=base_url()?>extras/system/js/jquery-1.11.1.min.js"></script>
 <script src='<?=base_url()?>extras/system/js/SidebarNav.min.js' type='text/javascript'></script>

<script src="<?=base_url()?>extras/system/js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->

<!-- Metis Menu -->
<script src="<?=base_url()?>extras/system/js/metisMenu.min.js"></script>
<script src="<?=base_url()?>extras/system/js/custom.js"></script>
<link href="<?=base_url()?>extras/system/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<style>
.overlay {
    /*background: black;  
    display: block;        
    position: absolute;   
    top: 0;                 
    right: 0;                
    bottom: 0;
    left: 0;
    opacity: 0.5;
    z-index:9999;
    padding: 43% 43%;*/
    background: black;
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    opacity: 0.5;
    z-index: 9999;
    padding: 43% 43%;

}

</style>
</head>
<body class="cbp-spmenu-push">
	
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="<?=base_url()?>index.php/auth/login_success"><span class="fa fa-area-chart"></span> <?=PROJECT_NAME?><span class="dashboard_text"></span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              <li class="treeview">
                <a href="<?=base_url()?>index.php/auth/login_success">
                <i class="fa fa-dashboard"></i><span>Add Invoice</span>
                </a>
              </li>
              <!--<li class="treeview">-->
              <!--  <a href="<?=base_url()?>index.php/invoice/add_job_sheet">-->
              <!--  <i class="fa fa-dashboard"></i><span>Add Job Sheet</span>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="treeview">
                <a href="<?=base_url()?>index.php/invoice/view_bills">
                <i class="fa fa-dashboard"></i><span>View Invoice</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->

		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">



				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img"><img src="<?=base_url()?>extras/system/images/user.png" alt=""> </span>
									<div class="user-name">
										<p><?php 
										if($user_details=$this->session->has_userdata('user_details')){
											$user_details=$this->session->userdata('user_details');	
											echo $user_details['first_name'];
										}else{
											redirect('general/login');
										}
										?></p>
										<span><?php 
										if(isset($user_details['user_type'])){
											if($user_details['user_type']==ADMIN){
												echo 'Admin';
											}elseif($user_details['user_type']==SUB_ADMIN){
												echo 'Sub Admin';
											}else{
												echo 'Normal User';
											}
										}
										?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>
								</div>
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="<?=base_url()?>index.php/auth/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //header-ends -->
