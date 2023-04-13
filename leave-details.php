<?php

session_start();
// echo $_SESSION['id'];exit();
include("include/connection.php");
if(isset($_POST['accept'])){
	$id = $_POST['accept'];

	$leave_sql1 = "UPDATE employee_leave SET tl_status='1' WHERE id='$id'";
	$leave_result1 = $conn->query($leave_sql1);
}

if(isset($_POST['save'])){
	$id = $_POST['leave-id'];
	$reason = $_POST['reason'];

	if($reason != null){
		$leave_sql3 = "UPDATE employee_leave SET tl_status='2', tl_reason='$reason' WHERE id='$id'";
		$leave_result3 = $conn->query($leave_sql3);
	}
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="ekka - Admin Dashboard HTML Template.">

	<title>ekka - Admin Dashboard HTML Template.</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- No Extra plugin used -->

	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

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
							<h1>Leave Detais</h1>
							<p class="breadcrumbs"><span><a href="index.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Leave Details</p>
						</div>
						<!-- <div>
							<a href="product-list.php" class="btn btn-primary"> Add Porduct</a>
						</div> -->
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<form method="post">
										<table id="responsive-data-table" class="table"	style="width:100%">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Name</th>
													<th>Department</th>
													<th>Applied Date</th>
													<th>Type</th>
													<th>Range</th>
													<th>Leave Date</th>
													<th>Status</th>
													<?php
													// if($_SESSION['count'] == 1){
														?>
														<!-- <th>Action</th> -->
														<?php
													// }
													// else{
														?>
														<!-- <th style="display:none">Action</th> -->
														<?php
													// }
													?>
													<th>Action</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$leave_sql = "SELECT *,a.emp_id as employee_id, a.id as leave_id FROM employee_leave a
												LEFT OUTER JOIN employee b ON b.id=a.emp_id";
												$leave_result = $conn->query($leave_sql);
												$s = 1;
												while($leave_row = mysqli_fetch_array($leave_result)){
													$leave_id = $leave_row['leave_id'];
													$control = $leave_row['control'];
													// $reason = 

													// if($control == 1){}
														?>
												<tr>
													<td><?php echo $s++; ?></td>
													<td><?php echo $leave_row['fname'];?>&nbsp;<?php echo $leave_row['lname'];?></td>
													<td><?php echo $leave_row['team'];?></td>
													<td><?php echo $leave_row['applied_date'];?></td>
													<td><?php echo $leave_row['type'];?></td>
													<td>
														<?php
															if($leave_row['count'] == 1){
																echo "Full Day";
															}
															elseif($leave_row['count'] == 2){
																echo "Half Day";
															}
															elseif($leave_row['count'] == 3){
																echo "Permission";
															}
															elseif($leave_row['count'] == 4){
																echo "More than 1 Day";
															}
														?>
													</td>
													<td>
														<?php
															if($leave_row['count'] == 4){
																echo $leave_row['from_date']. " - " .$leave_row['to_date'];
															}
															else{
																echo $leave_row['from_date'];
															}
														?>
													</td>
													<input type="hidden" id="rejectPopup<?=$s;?>" name="rejectPopup" value="<?php echo $leave_row['tl_reason'];?>">
													<td>
														<?php
															if($leave_row['tl_status'] == 1){
																// echo "Accepted";
																// $color = "green";
																?>
																<p class="success">Accepted</p>
																<?php
															}
															elseif($leave_row['tl_status'] == 2){
																// $color = 'style="color: green"';
																?>
																<!-- <a href="#" onclick=data-bs-toggle="modal1" data-bs-target="#addUser1">Rejected</a> -->
																<a href="" class="failed" data-bs-toggle="modal" data-bs-target="#modal-add-member" onclick="rejectReason(<?php echo $s;?>)">Rejected</a>
																<?php
																// echo "Rejected";	
															}
															else{
																?>
																<p class="primary">Pending</p>
																<?php
																// echo "Pending";
																// $color = 'style="color: green"';
															}
														?>
													</td>
													<?php
													if($control == 0){
													?>
														<td style="display:none"></td>
													<?php
													}
													else{
													?>
													<td>	
														<button type="submit" class="btn btn-success" id="accept" name="accept" value="<?php echo $leave_id;?>">&#10003;</button>&nbsp;
														<button type="button" data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-danger" id="reject" onclick="rejectStatus(<?php echo $leave_id;?>)">&#10005;</button>
													</td>
													<?php
													}
													?>
												</tr>
												<?php
												}
												?>
											</tbody>
										</table>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<form name="reason_modal" id="reason_modal" method="post">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Reason</h5>
									</div>
									<div class="modal-body px-4">
										<div class="form-group row mb-6">
											<textarea name="reason" id="reason" class="form-control" rows="2" placeholder="Enter Reason" required></textarea>
										</div>
									</div>
									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
											data-bs-dismiss="modal">Cancel</button>
										<input type="hidden" id="leave-id" name="leave-id">
										<button type="submit" id="save" name="save" class="btn btn-primary btn-pill" value="<?php echo $leave_id;?>">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="modal fade" id="modal-add-member" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
							<div class="modal-content">
								<form name="reason_modal" id="reason_modal" method="post">
									<div class="modal-header px-4">
										<h5 class="modal-title" id="exampleModalCenterTitle">Reason</h5>
									</div>
									<div class="modal-body px-4">
										<div class="form-group row mb-6">
											<textarea name="rejectReason" id="rejectReason" class="form-control" rows="2" readonly></textarea>
										</div>
									</div>
									<div class="modal-footer px-4">
										<button type="button" class="btn btn-secondary btn-pill"
											data-bs-dismiss="modal">OK</button>
									</div>
								</form>
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
	<script src="assets/plugins/simplebar/simplebar.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Datatables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- ekka Custom -->
	<script src="assets/js/ekka.js"></script>
	<script src="assets/js/manual.js"></script>
</body>

</html>

<script>
// 	$('#reject').click(function(e) {
//     e.preventDefault();
//     var reason = $(this).closest('tr').next('.reason-class');
//     reason.slideToggle("slow");
//     // $(this).find(".reason-div").slideToggle("slow"); 
// });
	function rejectStatus(val){
		// alert(val);
		$('#leave-id').val(val);
	}

	function rejectReason(val){
		// alert(val);
		var reason = $('#rejectPopup'+val).val();
		$('#rejectReason').val(reason);
	}
</script>