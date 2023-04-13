<?php

session_start();
// if(empty($_SESSION['id'])){
// 	header('location: sign-in.php');
// }
ini_set('display_errors','off');
include("include/connection.php");

	$today = date('Y-m-d');
	$time = date('h:i:sa');

if(isset($_POST["request"])){
	$type = $_POST['type'];
	$range = $_POST['range'];
	$fdate = $_POST['fDate'];
	$tdate = $_POST['tDate'];
	$fTime = $_POST['fTime'];
	$tTime = $_POST['tTime'];
	$reason = $_POST['reason'];
	$fn_an_status = $_POST['fn_an_status'];

	if($tdate == null){
		$tdate = $_POST['fDate'];
	}
		$leave_sql = "INSERT INTO employee_leave(type,count,from_date,to_date,from_time,to_time,reason,applied_date,fn_an_status) VALUES ('$type', '$range', '$fdate', '$tdate', '$fTime', '$tTime', '$reason', '$today', '$fn_an_status')";
		$leave_result = $conn->query($leave_sql);
		if($leave_result){
			header("location: leave-apply.php?msg=Leave Requested!&type=success");
		}
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	if (empty($_POST["fDate"])) {
// 	  $nameErr = "Date is required";
// 	} else {
// 	  $name = test_input($_POST["fDate"]);
// 	  echo $name;
// 	}
// }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="ekka - Admin Dashboard HTML Template.">

	<title>GTech - Leave Apply</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- ekka CSS -->
	<link id="ekka-css" rel="stylesheet" href="assets/css/ekka.css" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-dark ec-header-light" id="body">

	<!-- WRAPPER -->
	<div class="wrapper">

		<!-- LEFT MAIN SIDEBAR -->
		<?php include("include/side-bar.php"); ?>

		<!-- PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			<?php include("include/header.php"); ?>

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					<div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
						<div>
							<h1>Apply Leave</h1>
							<p class="breadcrumbs"><span><a href="index.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Leave</p>
						</div>
						<!-- <div>
							<a href="product-list.php" class="btn btn-primary"> View All
							</a>
						</div> -->
					</div>

					<?php
						if($_GET['type'] == 'success'){
					?>
							<div class="alert alert-success text-center" role="alert">
								<?php echo $_REQUEST['msg']; ?>
							</div>
					<?php
						}
						elseif($_GET['type'] == 'failed')
						{
					?>
							<div class="alert alert-danger text-center" role="alert">
								<?php echo $_REQUEST['msg']; ?>
							</div>
					<?php
						}
					?>

					<div class="row">
						<div class="col-xl-8 col-md-12 p-b-15"></div>
						<div class="col-xl-4 col-md-12 p-b-15">
							<!-- Doughnut Chart -->
							<div class="card card-default">
								<div class="card-header justify-content-center">
									<h2>Used <span class="badge bg-primary">0</span></h2>&nbsp;&nbsp;&nbsp;
									<h2>Leave Balance  <span class="badge bg-primary">1</span></h2>
								</div>
								<!-- <div class="card-body">
								</div> -->
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Apply Leave</h2>
								</div>
								<div class="card-body">
									<div class="row ec-vendor-uploads">
										<div class="col-lg-12">
											<div class="ec-vendor-upload-detail">
												<form id="apply_leave" method="post" class="row g-3" enctype="multipart/form-data">
													<!-- <div class="col-md-6">
														<label for="inputEmail4" class="form-label">Product name</label>
														<input type="text" class="form-control slug-title" id="inputEmail4">
													</div> -->
													<div class="col-md-6">
														<label class="form-label">Select Type</label>
														<select name="type" id="type" class="form-select" required>
															<!-- <optgroup label="Fashion"> -->
																<option value="">-- Select Type --</option>
																<option value="Sick Leave">Sick Leave</option>
																<option value="Casual Leave">Casual Leave</option>
																<!-- <option value="LOP">Loss Of Pay</option> -->
															<!-- </optgroup> -->
														</select>
													</div>
													<div class="col-md-6">
														<label class="form-label">Select Range</label>
														<select name="range" id="range" class="form-select" onchange="gets(this.value)" required>
															<!-- <optgroup label="Fashion"> -->
															<option value="">-- Select Range --</option>
																<option value="1">Full Day</option>
																<option value="2">Half Day</option>
																<option value="3">Permission</option>
																<option value="4">More than a Day</option>
															<!-- </optgroup> -->
														</select>
													</div>
													<!-- <div class="col-md-12"> -->
														<div style="display: block" class="col-md-6">
															<div class="hide">
																<label id="date"></label>
																<input type="date" class="form-control" name="fDate" id="fDate" min="<?php echo $today;?>" required>
															</div>
														</div>
														<div class="col-md-6">
															<div id="toDate"></div>
														</div>
														<div class="col-md-6">
															<div id="absentStatus"></div>
														</div>
														<!-- <div style="display: block" class="col-md-6">
															<div class="hide">
																<label>To</label>
																<input type="date" class="form-control" name="tDate" id="tDate" min="<?php echo $today;?>">
															</div>
														</div> -->
														<div id="time"></div>
													<!-- </div> -->
													<!-- <div style="display: block" class="col-md-6">
														<div class="hide">
															<label>From</label>
															<input type="time" class="form-control" name="fTime" id="fTime">
														</div>
													</div>
													<div style="display: block" class="col-md-6">
														<div class="hide">
															<label>To</label>
															<input type="time" class="form-control" name="tTime" id="tTime">
														</div>
													</div> -->
													<!-- <div class="col-md-12">
														<label for="slug" class="col-12 col-form-label">Slug</label> 
														<div class="col-12">
															<input id="slug" name="slug" class="form-control here set-slug" type="text">
														</div>
													</div> -->
													<div class="col-md-12">
														<label class="form-label">Reason</label>
														<textarea name="reason" id="reason" class="form-control" rows="2" required></textarea>
													</div>
													<div class="col-md-12">
														<!-- <input type="submit" name="request" id="request" value="Request" class="btn btn-primary"/> -->
														<button type="submit" name="request" id="request" class="btn btn-primary">Request</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- End Content -->
			</div> <!-- End Content Wrapper -->

			<!-- Footer -->
			<?php include("include/footer.php"); ?>

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>                                                              
	<script src="assets/plugins/tags-input/bootstrap-tagsinput.js"></script>
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- ekka Custom -->
	<script src="assets/js/ekka.js"></script>
	<script src="assets/js/manual.js"></script>
</body>

</html>

<script>
	function gets(val){
		if(val == 1){
			document.getElementsByClassName('hide')[0].style.display = 'block';
			document.getElementById('date').innerHTML = 'Date';
			$('#fnan_status').remove();
			$('#time-div').remove();
			$('#toDate-div').remove();
		}
		else if(val == 2){
			document.getElementsByClassName('hide')[0].style.display = 'block';
			document.getElementById('date').innerHTML = 'Date';
			$('#absentStatus').append('<div id="fnan_status"><select id="fn_an_status" id="fn_an_status" class="form-control"><option value="1">FN</option><option value="2">AN</option></select></div>');
			$('#time-div').remove();
			$('#toDate-div').remove();
		}
		else if(val == 3){
			document.getElementsByClassName('hide')[0].style.display = 'block';
			document.getElementById('date').innerHTML = 'Date';
			$('#toDate-div').remove();
			$('#fnan_status').remove();
			$('#time').append('<div class="row" id="time-div"><div style="display: block" class="col-md-6"><div><label>From</label><input type="time" class="form-control" name="fTime" id="fTime" required></div></div><div style="display: block" class="col-md-6"><div><label>To</label><input type="time" class="form-control" name="tTime" id="tTime" required></div></div></div>');
			// $('#time').append('<div><label>From</label></div>');
		}
		else{
			document.getElementsByClassName('hide')[0].style.display = 'block';
			document.getElementById('date').innerHTML = 'From';
			$('#toDate').append('<div id="toDate-div"><label>To</label><input type="date" class="form-control" name="tDate" id="tDate" min="<?php echo $today;?>" required></div>');
			$('#time-div').remove();
			$('#fnan_status').remove();
		}
	}
</script>