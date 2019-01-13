<?php

session_start();

require_once("portal/config.php");

$companyId = $_SESSION['portalId'];
$query = "SELECT * FROM jobs ";

$result = $con->query($query);
$flag = false;
$jobs = array();
if($result->num_rows > 0) {
    $flag = true;
    while($row = $result->fetch_assoc()){
        $jobs[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="CodePixar">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta charset="UTF-8">
	<title>Portal</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="portal/css/screen.css">
        <link rel="stylesheet" href="portal/css/style.css">
	</head>
	
	<body>
		<div id="top"></div>
		<!-- Start Header Area -->
		<header>
			<div class="sticky-header">
				<div class="container">
					<div class="header-content d-flex justify-content-between align-items-center">
						<div class="logo">
							<!--<a href="#top" class="smooth"><img src="" alt=""></a>-->
							<font size='6' color="White" >Portal</font>
						</div>
							
						<div class="right-bar d-flex align-items-center">
							<nav class="d-flex align-items-center">
								<ul class="menu"> 
									<li><a href="index.html"><b>Home</b></a></li>
									<li><a href="#services"><b>Services</b></a></li>
									<li><a href="jobs.php"><b>Jobs</b></a></li>
									<li><a href="internships.php"><b>Internship</b></a></li>
									<li><a href="#contact"><b>Contact</b></a></li>
							        <li><a href="login.php"><b>Login</b></a></li>
								    <li><a href="Signup"><b> SignUp </b></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>
    

        <section style="margin-top: 120px">
			
            <div class="container">
				<h4>Jobs</h4>
                <div class="row">
                    <div class="col-md-12">
                        <table id="job-table" class="table table-responsive" style="border:1px solid #F4F4F4; border-radius: 4px">
                            <thead>
                            <tr class="table-row-heading" style="border: 1px solid rgba(0, 0, 0, 0.07);">
                                <th width="5%">SNo.</th>
                                <th width="40%">Job Title</th>
                                <th width="25%">Posted Date</th>
                                <th width="20%">SKills</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody style="background: #fff">
                            <?php
                            $count = 1;
                            if ($flag):
                                foreach ($jobs as $job):
                                    ?>
                                    <tr class="jobs-detail">
                                        <td align="center"><?php echo $count; ?></td>
                                        <td>
                                            <a href="job_response.php?job=<?php echo $job['id']; ?>"
                                            style="color: #2980b9;"><?php echo $job['profile']; ?></a><br>
                                            <a style="color: #7f8c8d; font-size: 12px;">Skills :
                                                <span><?php echo $job['skills']; ?></span></a>
                                        </td>
                                        <td style="padding-top: 12px">
                                            <p><?php echo $job['added_date']; ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $job['skills']; ?></p>
                                        </td>
                                        <td><a href="job_response.php?job=<?php echo $job['id']; ?>" class="btn btn-primary"
                                            style="font-size: 12px">Apply</a></td>
                                    </tr>

                                    <?php
                                    $count++;
                                endforeach; endif; ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>

        </section>



		<!-- End Cta Area -->
		<footer class="section-full">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<div class="single-footer-widget">
							<h6 class="text-white text-uppercase mb-20">About Agency</h6>
							<p>The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point </p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="single-footer-widget">
							<h6 class="text-white text-uppercase mb-20">Navigation Links</h6>
							<div class="d-flex">
								<ul class="footer-nav">
									<li><a href="#">Home</a></li>
									<li><a href="#">Features</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Portfolio</a></li>
								</ul>
								<ul class="ml-30 footer-nav">
									<li><a href="#">Team</a></li>
									<li><a href="#">Pricing</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="single-footer-widget">
							<h6 class="text-white text-uppercase mb-20">Newsletter</h6>
							<p>For business professionals caught between high OEM price and mediocre print and graphic output,</p>
							<div id="mc_embed_signup">
								<form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01" method="get" class="subscription relative d-flex justify-content-center">
									<input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required>
									<div style="position: absolute; left: -5000px;">
										<input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
									</div>
									<button type="submit" class="newsletter-btn" name="subscribe"><span class="lnr lnr-location"></span></button>
									<div class="info"></div>
								</form>
							</div>
						</div>
					</div>
				
				</div>

			</div>
		</footer>

		<script src="js/vendor/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/jquery.sticky.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/mixitup.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>
