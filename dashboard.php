<?php

session_start();

// if(isset($_SESSION['login_id'])){
// 	header('Location: index.php');
// }

// if(empty($_SESSION['id'])){
// 	header('location: sign-in.php');
// }

// $_SESSION['passed_default'] = 1;
include("include/connection.php");
// if($_SESSION['id']){
// 	echo $_SESSION['id'];
// }
//  exit();

$today = date('Y-m-d');
$today1 = date('d-m-Y');

$employee_sql1 = "SELECT * FROM employee WHERE del_status=0";
$employee_result1 = $conn->query($employee_sql1);
$count = $employee_result1->num_rows;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="ekka - Admin Dashboard eCommerce HTML Template.">

	<title>GTech - Dashboard</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- ekka CSS -->
	<link id="ekka-css" href="assets/css/ekka.css" rel="stylesheet" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">
		
		<!-- LEFT MAIN SIDEBAR -->
		<?php include("include/side-bar.php"); ?>

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header Begins -->
			<?php include("include/header.php"); ?>
			<!-- Header End -->

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				<div class="content">
					<!-- Employee -->
					<div class="row">
						<div class="col col p-b-15 lbl-card">
							<div class="card card-mini dash-card card-1">
								<div class="card-body new-class">
									<h2 class="mb-1"><?php echo $count;?></h2>
									<p>Total Employees</p>
									<span class="mdi mdi-account-group"></span>
								</div>
							</div>
						</div>

						<?php
						$count_sql = "SELECT COUNT(location) AS locationcount, location FROM employee WHERE del_status=0 GROUP BY location";
						$count_result = $conn->query($count_sql);
						while($count_row = mysqli_fetch_array($count_result)){
						?>
							<div class="col col p-b-15 lbl-card">
								<div class="card card-mini dash-card card-2">
									<div class="card-body new-class">
										<h2 class="mb-1"><?php echo $count_row['locationcount']; ?></h2>
										<p><?php echo $count_row['location']; ?></p>
										<span class="mdi mdi-account-multiple"></span>
									</div>
								</div>
							</div>
						<?php
						}
						?>
						<!-- <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-3">
								<div class="card-body">
									<h2 class="mb-1">15,503</h2>
									<p>Daily Order</p>
									<span class="mdi mdi-package-variant"></span>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
							<div class="card card-mini dash-card card-4">
								<div class="card-body">
									<h2 class="mb-1">$98,503</h2>
									<p>Daily Revenue</p>
									<span class="mdi mdi-currency-usd"></span>
								</div>
							</div>
						</div> -->
					</div>

					<!-- Attendance Table -->
					<div class="row">
						<div class="col-xl-7 col-md-12 p-b-15">
							<!-- Team Report -->
							<div id="user-acquisition" class="card card-default">
								<div class="card-header">
									<h2>GTS Team Wise Attendance - <?php echo $today1;?></h2>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table" style="width:100%">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Team</th>
													<th>Total Members</th>
													<th>Today Present</th>
												</tr>
											</thead>
											<tbody>
												<?php
												// $employee_sql = "SELECT COUNT(team) AS teamcount, team FROM employee GROUP BY team";
												$sql = "SELECT a.team, COUNT(a.team) AS teamcount, COUNT(CASE WHEN b.status=0 THEN 1 END) AS present FROM employee a
												LEFT OUTER JOIN attendance b ON a.id = b.emp_id
												WHERE a.del_status = 0 AND b.date='$today' GROUP BY a.team;";
												$result = $conn->query($sql);
												$a = 1;
												if($result->num_rows > 0){
												while($row = mysqli_fetch_array($result)){
												?>
													<tr>
														<td><?php echo $a++; ?></td>
														<td><?php echo $row['team']; ?></td>
														<td><?php echo $row['teamcount']; ?></td>
														<td><?php echo $row['present']; ?></td>
													</tr>
												<?php
												}
												}
												else{
												?>
													<tr><td colspan="4" style="text-align: center">Today Attendance Not updated</td></tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-5 col-md-12 p-b-15">
							<!-- Total Report -->
							<div id="user-acquisition" class="card card-default">
								<div class="card-header">
									<h2>Attendance - <?php echo $today1; ?></h2>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table" style="width:100%">
											<tbody>
												<?php
												$sql = "SELECT COUNT(CASE WHEN status = 0 THEN 1 END) AS present,
												COUNT(CASE WHEN status = 1 THEN 1 END) AS absent,
												COUNT(CASE WHEN count = 1 && status = 1 THEN 1 END) AS fullday,
												COUNT(CASE WHEN count = 2 THEN 1 END) AS halfday
												FROM attendance WHERE date='$today'";
												$result = $conn->query($sql);
												// if($result->num_rows > 0){
												while($row = mysqli_fetch_array($result)){
												?>
													<tr>
														<td>Total Members</td>
														<td><span class="badge bg-primary"><?php echo $count; ?></span></td>
													</tr>
													<tr>
														<td>Present</td>
														<td><span class="badge bg-success"><?php echo $row['present']; ?></span></td>
													</tr>
													<tr>
														<td>Absent - Full Day</td>
														<td><span class="badge bg-failed"><?php echo $row['fullday']; ?></span></td>
													</tr>
													<tr>
														<td>Absent - Half Day</td>
														<td><span class="badge bg-warning"><?php echo $row['halfday']; ?></span></td>
													</tr>
												<?php
													if($row['present'] == 0 && $row['fullday'] == 0 && $row['halfday'] == 0){
														?>
														<tr><td colspan="2" style="text-align: center">Today Attendance Not updated</td></tr>
														<?php
													}
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Leave Details -->
					<div class="row">
						<div class="col col-md-12 p-b-15">
						<div id="user-acquisition" class="card card-default">
							<div class="card-header">
								<h2 style="text-align: center">Leave Details</h2>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-xl-6 col-md-12 p-b-15">
										<h4 style="text-align: center">Informed</h4>
											<div class="row">
												<div class="col-6">
													<div class="table-responsive">
														<table id="responsive-data-table" class="table" style="width:100%, border-width:5px solid black">
															<thead>
																<tr>
																	<th colspan="2" style="text-align: center">Full Day</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$attend_sql = "SELECT * FROM attendance a
																LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='$today' AND a.status=1 AND a.inform_status=1 AND a.count=1";
																$attend_result = $conn->query($attend_sql);
																$a = 1;
																while($attend_row = mysqli_fetch_array($attend_result)){
																	if($attend_row['type'] == 1){
																		$type = "Casual Leave";
																	}
																	elseif($attend_row['type'] == 2){
																		$type = "Sick Leave";
																	}
																	elseif($attend_row['type'] == 3){
																		$type = "LOP";
																	}
																?>
																	<tr>
																		<td><?php echo $a++; ?></td>
																		<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?>&nbsp;<?php echo "- ".$type;?></td>
																	</tr>
																<?php
																}
																?>
															</tbody>
														</table>
													</div>
												</div>
												<div class="col-6">
													<div class="table-responsive">
														<table id="responsive-data-table" class="table" style="width:100%">
															<thead>
																<tr>
																	<th colspan="2" style="text-align: center">Half Day</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$attend_sql = "SELECT * FROM attendance a
																LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='$today' AND a.status=1 AND a.inform_status=1 AND a.count=2";
																$attend_result = $conn->query($attend_sql);
																$a = 1;
																while($attend_row = mysqli_fetch_array($attend_result)){
																	if($attend_row['type'] == 1){
																		$type = "Casual Leave";
																	}
																	elseif($attend_row['type'] == 2){
																		$type = "Sick Leave";
																	}
																	elseif($attend_row['type'] == 3){
																		$type = "LOP";
																	}
																?>
																	<tr>
																		<td><?php echo $a++; ?></td>
																		<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?>&nbsp;<?php echo "- ".$type;?></td>
																	</tr>
																<?php
																	}
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
									</div>
									<div class="col-xl-6 col-md-12 p-b-15">
										<h4 style="text-align: center">Uninformed</h4>
											<div class="row">
												<div class="col-6">
													<div class="table-responsive">
														<table id="responsive-data-table" class="table" style="width:100%">
															<thead>
																<tr>
																	<th colspan="2" style="text-align: center">Full Day</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$attend_sql = "SELECT * FROM attendance a
																LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='$today' AND a.status=1 AND a.inform_status=2 AND a.count=1";
																$attend_result = $conn->query($attend_sql);
																$a = 1;
																while($attend_row = mysqli_fetch_array($attend_result)){
																?>
																	<tr>
																		<td><?php echo $a++; ?></td>
																		<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?></td>
																	</tr>
																<?php
																	}
																?>
															</tbody>
														</table>
													</div>
												</div>
												<div class="col-6">
													<div class="table-responsive">
														<table id="responsive-data-table" class="table" style="width:100%">
															<thead>
																<tr>
																	<th colspan="2" style="text-align: center">Half Day</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$attend_sql = "SELECT * FROM attendance a
																LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='$today' AND a.status=1 AND a.inform_status=2 AND a.count=2";
																$attend_result = $conn->query($attend_sql);
																$a = 1;
																while($attend_row = mysqli_fetch_array($attend_result)){
																?>
																	<tr>
																		<td><?php echo $a++; ?></td>
																		<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?></td>
																	</tr>
																<?php
																	}
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>

					<!-- OD Details -->
					<div class="row">
						<div class="col col-md-12 p-b-15">
						<div id="user-acquisition" class="card card-default">
							<div class="card-header">
								<h2 style="text-align: center">OD Details</h2>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col">
										<div class="table-responsive">
											<table id="responsive-data-table" class="table" style="width:100%">
												<thead>
													<tr>
														<th colspan="2" style="text-align: center">Client Meet</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$attend_sql = "SELECT * FROM attendance a
													LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='2023-04-11' AND a.status=0 AND a.location=2";
													$attend_result = $conn->query($attend_sql);
													$a = 1;
													while($attend_row = mysqli_fetch_array($attend_result)){
													?>
														<tr>
															<td><?php echo $a++; ?></td>
															<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?></td>
														</tr>
													<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col">
										<div class="table-responsive">
											<table id="responsive-data-table" class="table" style="width:100%">
												<thead>
													<tr>
														<th colspan="2" style="text-align: center">Work From Home</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$attend_sql = "SELECT * FROM attendance a
													LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='2023-04-11' AND a.status=0 AND a.location=3";
													$attend_result = $conn->query($attend_sql);
													$a = 1;
													while($attend_row = mysqli_fetch_array($attend_result)){
													?>
														<tr>
															<td><?php echo $a++; ?></td>
															<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?></td>
														</tr>
													<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>

					<!-- Employee Details -->
					<div class="row">
						<div class="col-xl-4 col-md-12 p-b-15">
						<div id="user-acquisition" class="card card-default">
							<div class="card-header">
								<h2 style="text-align: center">Employee Details</h2>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col">
										<div class="table-responsive">
											<table id="responsive-data-table" class="table" style="width:100%">
												<thead>
													<tr>
														<th colspan="2" style="text-align: center">New Joinee</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$emp_sql = "SELECT * FROM employee WHERE del_status=0";
													$emp_result = $conn->query($emp_sql);
													$a = 1;
													while($emp_row = mysqli_fetch_array($emp_result)){
														$date = $emp_row['doj'];
														$endDate = date('Y-m-d',strtotime($date. '+7 days'));
														if(($date <= $today) && ($endDate >= $today)){
													?>
														<tr>
															<td><?php echo $a++; ?></td>
															<td><?php echo $emp_row['fname'];?> <?php echo $emp_row['lname'];?> <?php echo "- ".$emp_row['designation'];?></td>
														</tr>
													<?php
														}
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- <div class="col">
										<div class="table-responsive">
											<table id="responsive-data-table" class="table" style="width:100%">
												<thead>
													<tr>
														<th colspan="2" style="text-align: center">Resign</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$attend_sql = "SELECT * FROM attendance a
													LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='2023-04-11' AND a.status=0 AND a.location=3";
													$attend_result = $conn->query($attend_sql);
													$a = 1;
													while($attend_row = mysqli_fetch_array($attend_result)){
													?>
														<tr>
															<td><?php echo $a++; ?></td>
															<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?></td>
														</tr>
													<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col">
										<div class="table-responsive">
											<table id="responsive-data-table" class="table" style="width:100%">
												<thead>
													<tr>
														<th colspan="2" style="text-align: center">Terminate</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$attend_sql = "SELECT * FROM attendance a
													LEFT OUTER JOIN employee b ON a.emp_id=b.id WHERE a.date='2023-04-11' AND a.status=0 AND a.location=3";
													$attend_result = $conn->query($attend_sql);
													$a = 1;
													while($attend_row = mysqli_fetch_array($attend_result)){
													?>
														<tr>
															<td><?php echo $a++; ?></td>
															<td><?php echo $attend_row['fname'];?>&nbsp;<?php echo $attend_row['lname'];?></td>
														</tr>
													<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div> -->
								</div>
							</div>
						</div>
						</div>
					</div>

					<!-- <div class="row">
						<div class="col-xl-8 col-md-12 p-b-15">
							<div id="user-acquisition" class="card card-default">
								<div class="card-header">
									<h2>Sales Report</h2>
								</div>
								<div class="card-body">
									<ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom"
										role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
												aria-selected="true">Today's</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab"
												aria-selected="false">Monthly </a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab"
												aria-selected="false">Yearly</a>
										</li>
									</ul>
									<div class="tab-content pt-4" id="salesReport">
										<div class="tab-pane fade show active" id="source-medium" role="tabpanel">
											<div class="mb-6" style="max-height:247px">
												<canvas id="acquisition" class="chartjs2"></canvas>
												<div id="acqLegend" class="customLegend mb-2"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4 col-md-12 p-b-15">
							<div class="card card-default">
								<div class="card-header justify-content-center">
									<h2>Orders Overview</h2>
								</div>
								<div class="card-body">
									<canvas id="doChart"></canvas>
								</div>
								<a href="#" class="pb-5 d-block text-center text-muted"><i
										class="mdi mdi-download mr-2"></i> Download overall report</a>
								<div class="card-footer d-flex flex-wrap bg-white p-0">
									<div class="col-6">
										<div class="p-20">
											<ul class="d-flex flex-column justify-content-between">
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
														style="color: #4c84ff"></i>Order Completed</li>
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
														style="color: #80e1c1 "></i>Order Unpaid</li>
												<li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
														style="color: #ff7b7b "></i>Order returned</li>
											</ul>
										</div>
									</div>
									<div class="col-6 border-left">
										<div class="p-20">
											<ul class="d-flex flex-column justify-content-between">
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
														style="color: #8061ef"></i>Order Pending</li>
												<li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
														style="color: #ffa128"></i>Order Canceled</li>
												<li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
														style="color: #7be6ff"></i>Order Broken</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="row">
						<div class="col-xl-8 col-md-12 p-b-15">
							<div class="card card-default" id="user-activity">
								<div class="no-gutters">
									<div>
										<div class="card-header justify-content-between">
											<h2>User Activity</h2>
											<div class="date-range-report ">
												<span></span>
											</div>
										</div>
										<div class="card-body">
											<div class="tab-content" id="userActivityContent"> 
												<div class="tab-pane fade show active" id="user" role="tabpanel">
													<canvas id="activity" class="chartjs"></canvas>
												</div>
											</div>
										</div>
										<div class="card-footer d-flex flex-wrap bg-white border-top">
											<a href="#" class="text-uppercase py-3">In-Detail Overview</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-md-12 p-b-15">
							<div class="card card-default">
								<div class="card-header flex-column align-items-start">
									<h2>Current Users</h2>
								</div>
								<div class="card-body">
									<canvas id="currentUser" class="chartjs"></canvas>
								</div>
								<div class="card-footer d-flex flex-wrap bg-white border-top">
									<a href="#" class="text-uppercase py-3">In-Detail Overview</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="row">
						<div class="col-xl-8 col-12 p-b-15">
							<div class="card card-default" id="analytics-country">
								<div class="card-header justify-content-between">
									<h2>Purchased by Country</h2>
									<div class="date-range-report ">
										<span></span>
									</div>
								</div>
								<div class="card-body vector-map-world-2">
									<div id="regions_purchase" style="height: 100%; width: 100%;"></div>
								</div>
								<div class="border-top mt-3">
									<div class="row no-gutters">
										<div class="col-lg-6">
											<div class="world-data-chart border-bottom pt-15px pb-15px">
												<canvas id="hbar1" class="chartjs"></canvas>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="world-data-chart pt-15px pb-15px">
												<canvas id="hbar2" class="chartjs"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex flex-wrap bg-white">
									<a href="#" class="text-uppercase py-3">In-Detail Overview</a>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-12 p-b-15">
							<div class="card card-default Sold-card-table">
								<div class="card-header justify-content-between">
									<h2>Sold by Items</h2>
									<div class="tools">
										<button class="text-black-50 mr-2 font-size-20"><i
												class="mdi mdi-cached"></i></button>
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#" role="button"
												id="dropdown-units" data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static"></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><a href="#">Action</a></li>
												<li class="dropdown-item"><a href="#">Another action</a></li>
												<li class="dropdown-item"><a href="#">Something else here</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body py-0 compact-units" data-simplebar style="height: 534px;">
									<table class="table ">
										<tbody>
											<tr>
												<td class="text-dark">Backpack</td>
												<td class="text-center">9</td>
												<td class="text-right">33% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">T-Shirt</td>
												<td class="text-center">6</td>
												<td class="text-right">150% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">Coat</td>
												<td class="text-center">3</td>
												<td class="text-right">50% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">Necklace</td>
												<td class="text-center">7</td>
												<td class="text-right">150% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">Jeans Pant</td>
												<td class="text-center">10</td>
												<td class="text-right">300% <i
														class="mdi mdi-arrow-down-bold text-danger pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">Shoes</td>
												<td class="text-center">5</td>
												<td class="text-right">100% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">T-Shirt</td>
												<td class="text-center">6</td>
												<td class="text-right">150% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">Watches</td>
												<td class="text-center">18</td>
												<td class="text-right">160% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">Inner</td>
												<td class="text-center">156</td>
												<td class="text-right">120% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
											<tr>
												<td class="text-dark">T-Shirt</td>
												<td class="text-center">6</td>
												<td class="text-right">150% <i
														class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i>
												</td>
											</tr>
										</tbody>
									</table>

								</div>
								<div class="card-footer d-flex flex-wrap bg-white">
									<a href="#" class="text-uppercase py-3">View Report</a>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="row">
						<div class="col-12 p-b-15">
							<div class="card card-table-border-none card-default recent-orders" id="recent-orders">
								<div class="card-header justify-content-between">
									<h2>Recent Orders</h2>
									<div class="date-range-report">
										<span></span>
									</div>
								</div>
								<div class="card-body pt-0 pb-5">
									<table class="table card-table table-responsive table-responsive-large"
										style="width:100%">
										<thead>
											<tr>
												<th>Order ID</th>
												<th>Product Name</th>
												<th class="d-none d-lg-table-cell">Units</th>
												<th class="d-none d-lg-table-cell">Order Date</th>
												<th class="d-none d-lg-table-cell">Order Cost</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>24541</td>
												<td>
													<a class="text-dark" href=""> Coach Swagger</a>
												</td>
												<td class="d-none d-lg-table-cell">1 Unit</td>
												<td class="d-none d-lg-table-cell">Oct 20, 2018</td>
												<td class="d-none d-lg-table-cell">$230</td>
												<td>
													<span class="badge badge-success">Completed</span>
												</td>
												<td class="text-right">
													<div class="dropdown show d-inline-block widget-dropdown">
														<a class="dropdown-toggle icon-burger-mini" href=""
															role="button" id="dropdown-recent-order1"
															data-bs-toggle="dropdown" aria-haspopup="true"
															aria-expanded="false" data-display="static"></a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li class="dropdown-item">
																<a href="#">View</a>
															</li>
															<li class="dropdown-item">
																<a href="#">Remove</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<tr>
												<td>24541</td>
												<td>
													<a class="text-dark" href=""> Toddler Shoes, Gucci Watch</a>
												</td>
												<td class="d-none d-lg-table-cell">2 Units</td>
												<td class="d-none d-lg-table-cell">Nov 15, 2018</td>
												<td class="d-none d-lg-table-cell">$550</td>
												<td>
													<span class="badge badge-primary">Delayed</span>
												</td>
												<td class="text-right">
													<div class="dropdown show d-inline-block widget-dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#"
															role="button" id="dropdown-recent-order2"
															data-bs-toggle="dropdown" aria-haspopup="true"
															aria-expanded="false" data-display="static"></a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li class="dropdown-item">
																<a href="#">View</a>
															</li>
															<li class="dropdown-item">
																<a href="#">Remove</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<tr>
												<td>24541</td>
												<td>
													<a class="text-dark" href=""> Hat Black Suits</a>
												</td>
												<td class="d-none d-lg-table-cell">1 Unit</td>
												<td class="d-none d-lg-table-cell">Nov 18, 2018</td>
												<td class="d-none d-lg-table-cell">$325</td>
												<td>
													<span class="badge badge-warning">On Hold</span>
												</td>
												<td class="text-right">
													<div class="dropdown show d-inline-block widget-dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#"
															role="button" id="dropdown-recent-order3"
															data-bs-toggle="dropdown" aria-haspopup="true"
															aria-expanded="false" data-display="static"></a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li class="dropdown-item">
																<a href="#">View</a>
															</li>
															<li class="dropdown-item">
																<a href="#">Remove</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<tr>
												<td>24541</td>
												<td>
													<a class="text-dark" href=""> Backpack Gents, Swimming Cap Slin</a>
												</td>
												<td class="d-none d-lg-table-cell">5 Units</td>
												<td class="d-none d-lg-table-cell">Dec 13, 2018</td>
												<td class="d-none d-lg-table-cell">$200</td>
												<td>
													<span class="badge badge-success">Completed</span>
												</td>
												<td class="text-right">
													<div class="dropdown show d-inline-block widget-dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#"
															role="button" id="dropdown-recent-order4"
															data-bs-toggle="dropdown" aria-haspopup="true"
															aria-expanded="false" data-display="static"></a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li class="dropdown-item">
																<a href="#">View</a>
															</li>
															<li class="dropdown-item">
																<a href="#">Remove</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
											<tr>
												<td>24541</td>
												<td>
													<a class="text-dark" href=""> Speed 500 Ignite</a>
												</td>
												<td class="d-none d-lg-table-cell">1 Unit</td>
												<td class="d-none d-lg-table-cell">Dec 23, 2018</td>
												<td class="d-none d-lg-table-cell">$150</td>
												<td>
													<span class="badge badge-danger">Cancelled</span>
												</td>
												<td class="text-right">
													<div class="dropdown show d-inline-block widget-dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#"
															role="button" id="dropdown-recent-order5"
															data-bs-toggle="dropdown" aria-haspopup="true"
															aria-expanded="false" data-display="static"></a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li class="dropdown-item">
																<a href="#">View</a>
															</li>
															<li class="dropdown-item">
																<a href="#">Remove</a>
															</li>
														</ul>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div> -->

					<!-- <div class="row">
						<div class="col-xl-5">
							<div class="card ec-cust-card card-table-border-none card-default">
								<div class="card-header justify-content-between ">
									<h2>New Customers</h2>
									<div>
										<button class="text-black-50 mr-2 font-size-20">
											<i class="mdi mdi-cached"></i>
										</button>
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#" role="button"
												id="dropdown-customar" data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static">
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><a href="#">Action</a></li>
												<li class="dropdown-item"><a href="#">Another action</a></li>
												<li class="dropdown-item"><a href="#">Something else here</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 pb-15px">
									<table class="table ">
										<tbody>
											<tr>
												<td>
													<div class="media">
														<div class="media-image mr-3 rounded-circle">
															<a href="profile.html"><img
																	class="profile-img rounded-circle w-45"
																	src="assets/img/user/u1.jpg"
																	alt="customer image"></a>
														</div>
														<div class="media-body align-self-center">
															<a href="profile.html">
																<h6 class="mt-0 text-dark font-weight-medium">Selena
																	Wagner</h6>
															</a>
															<small>@selena.oi</small>
														</div>
													</div>
												</td>
												<td>2 Orders</td>
												<td class="text-dark d-none d-md-block">$150</td>
											</tr>
											<tr>
												<td>
													<div class="media">
														<div class="media-image mr-3 rounded-circle">
															<a href="profile.html"><img
																	class="profile-img rounded-circle w-45"
																	src="assets/img/user/u2.jpg"
																	alt="customer image"></a>
														</div>
														<div class="media-body align-self-center">
															<a href="profile.html">
																<h6 class="mt-0 text-dark font-weight-medium">Walter
																	Reuter</h6>
															</a>
															<small>@walter.me</small>
														</div>
													</div>
												</td>
												<td>5 Orders</td>
												<td class="text-dark d-none d-md-block">$200</td>
											</tr>
											<tr>
												<td>
													<div class="media">
														<div class="media-image mr-3 rounded-circle">
															<a href="profile.html"><img
																	class="profile-img rounded-circle w-45"
																	src="assets/img/user/u3.jpg"
																	alt="customer image"></a>
														</div>
														<div class="media-body align-self-center">
															<a href="profile.html">
																<h6 class="mt-0 text-dark font-weight-medium">Larissa
																	Gebhardt</h6>
															</a>
															<small>@larissa.gb</small>
														</div>
													</div>
												</td>
												<td>1 Order</td>
												<td class="text-dark d-none d-md-block">$50</td>
											</tr>
											<tr>
												<td>
													<div class="media">
														<div class="media-image mr-3 rounded-circle">
															<a href="profile.html"><img
																	class="profile-img rounded-circle w-45"
																	src="assets/img/user/u4.jpg"
																	alt="customer image"></a>
														</div>
														<div class="media-body align-self-center">
															<a href="profile.html">
																<h6 class="mt-0 text-dark font-weight-medium">Albrecht
																	Straub</h6>
															</a>
															<small>@albrech.as</small>
														</div>
													</div>
												</td>
												<td>2 Orders</td>
												<td class="text-dark d-none d-md-block">$100</td>
											</tr>
											<tr>
												<td>
													<div class="media">
														<div class="media-image mr-3 rounded-circle">
															<a href="profile.html"><img
																	class="profile-img rounded-circle w-45"
																	src="assets/img/user/u5.jpg"
																	alt="customer image"></a>
														</div>
														<div class="media-body align-self-center">
															<a href="profile.html">
																<h6 class="mt-0 text-dark font-weight-medium">Leopold
																	Ebert</h6>
															</a>
															<small>@leopold.et</small>
														</div>
													</div>
												</td>
												<td>1 Order</td>
												<td class="text-dark d-none d-md-block">$60</td>
											</tr>
											<tr>
												<td>
													<div class="media">
														<div class="media-image mr-3 rounded-circle">
															<a href="profile.html"><img
																	class="profile-img rounded-circle w-45"
																	src="assets/img/user/u3.jpg"
																	alt="customer image"></a>
														</div>
														<div class="media-body align-self-center">
															<a href="profile.html">
																<h6 class="mt-0 text-dark font-weight-medium">Larissa
																	Gebhardt</h6>
															</a>
															<small>@larissa.gb</small>
														</div>
													</div>
												</td>
												<td>1 Order</td>
												<td class="text-dark d-none d-md-block">$50</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="col-xl-7">
							<div class="card card-default ec-card-top-prod">
								<div class="card-header justify-content-between">
									<h2>Top Products</h2>
									<div>
										<button class="text-black-50 mr-2 font-size-20"><i
												class="mdi mdi-cached"></i></button>
										<div class="dropdown show d-inline-block widget-dropdown">
											<a class="dropdown-toggle icon-burger-mini" href="#" role="button"
												id="dropdown-product" data-bs-toggle="dropdown" aria-haspopup="true"
												aria-expanded="false" data-display="static">
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li class="dropdown-item"><a href="#">Update Data</a></li>
												<li class="dropdown-item"><a href="#">Detailed Log</a></li>
												<li class="dropdown-item"><a href="#">Statistics</a></li>
												<li class="dropdown-item"><a href="#">Clear Data</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body mt-10px mb-10px py-0">
									<div class="row media d-flex pt-15px pb-15px">
										<div
											class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
											<a href="#"><img src="assets/img/products/p1.jpg" alt="customer image"></a>
										</div>
										<div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
											<a href="#">
												<h6 class="mb-10px text-dark font-weight-medium">Baby cotton shoes</h6>
											</a>
											<p class="float-md-right sale"><span class="mr-2">58</span>Sales</p>
											<p class="d-none d-md-block">Statement belting with double-turnlock hardware
												adds “swagger” to a simple.</p>
											<p class="mb-0 ec-price">
												<span class="text-dark">$520</span>
												<del>$580</del>
											</p>
										</div>
									</div>
									<div class="row media d-flex pt-15px pb-15px">
										<div
											class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
											<a href="#"><img src="assets/img/products/p2.jpg" alt="customer image"></a>
										</div>
										<div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
											<a href="#">
												<h6 class="mb-10px text-dark font-weight-medium">Hoodies for men</h6>
											</a>
											<p class="float-md-right sale"><span class="mr-2">20</span>Sales</p>
											<p class="d-none d-md-block">Statement belting with double-turnlock hardware
												adds “swagger” to a simple.</p>
											<p class="mb-0 ec-price">
												<span class="text-dark">$250</span>
												<del>$300</del>
											</p>
										</div>
									</div>
									<div class="row media d-flex pt-15px pb-15px">
										<div
											class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
											<a href="#"><img src="assets/img/products/p3.jpg" alt="customer image"></a>
										</div>
										<div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
											<a href="#">
												<h6 class="mb-10px text-dark font-weight-medium">Long slive t-shirt</h6>
											</a>
											<p class="float-md-right sale"><span class="mr-2">10</span>Sales</p>
											<p class="d-none d-md-block">Statement belting with double-turnlock hardware
												adds “swagger” to a simple.</p>
											<p class="mb-0 ec-price">
												<span class="text-dark">$480</span>
												<del>$654</del>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div> <!-- End Content -->
			</div> <!-- End Content Wrapper -->

			<!-- Footer -->
			<?php include("include/footer.php"); ?>

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Chart -->
	<script src="assets/plugins/charts/Chart.min.js"></script>
	<script src="assets/js/chart.js"></script>

	<!-- Google map chart -->
	<script src="assets/plugins/charts/google-map-loader.js"></script>
	<script src="assets/plugins/charts/google-map.js"></script>

	<!-- Date Range Picker -->
	<script src="assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="assets/js/date-range.js"></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- ekka Custom -->
	<script src="assets/js/ekka.js"></script>
	<script src="assets/js/manual.js"></script>
</body>

</html>