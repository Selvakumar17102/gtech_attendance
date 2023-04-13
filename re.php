<?php

include("include/connection.php");

// $today = date('Y-m-d');

if(isset($_POST['search'])){
	$fd = $_POST['fDate'];
	$td = $_POST['tDate'];
}
else{
	$fd = date('Y-m-01');
	$td = date('Y-m-d');
}


// if($fd == ""){
// 	$start = date('Y-m-01');
// 	$end = date('Y-m-d');
// }
// else{
// 	$start = $fd;
// 	$end = $td;
// }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

	<title>Gtech - Report</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- Data-Tables -->
	<link href='assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- Ekka CSS -->
	<link id="ekka-css" rel="stylesheet" href="assets/css/ekka.css" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
</head>

<style>
	table, th, td{
		border-width: 3px;
	}
</style>

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
							<h1>Report</h1>
							<p class="breadcrumbs"><span><a href="index.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Report</p>
						</div>
						<!-- <div>
							<a href="product-list.php" class="btn btn-primary">Attendance Report</a>
						</div> -->
					</div>
                    <div class="row m-b30">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Attendance Report</h2>
								</div>
								<div class="card-body">
									<div class="row ec-vendor-uploads">
										<div class="col-lg-12">
											<div class="ec-vendor-upload-detail">
												<form id="apply_leave" method="post" class="row g-3" enctype="multipart/form-data">
													<div class="col-md-6">
														<label class="form-label">From</label>
														<input type="date" class="form-control" name="fDate" id="fDate" value="<?php echo $fd; ?>">
													</div>
													<div class="col-md-6">
														<label class="form-label">To</label>
														<input type="date" class="form-control" name="tDate" id="tDate" value="<?php echo $td; ?>">
													</div>
													<div class="col-md-12">
														<!-- <input type="submit" name="request" id="request" value="Request" class="btn btn-primary"/> -->
														<button type="submit" name="search" id="search" class="btn btn-success">Search</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row m-b30">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2 style="text-align: center">GTS Attendance Report</h2>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table" style="width:100%">
											<thead style="border-width:5px">
												<tr>
													<th>S.No</th>
													<?php
													?>
													<th>Name</th>
													<?php
													for($loopDate = $fd; $loopDate <= $td; $loopDate = date('Y-m-d', strtotime($loopDate.'+1 day'))){
														?>
														<th><?php echo date('d',strtotime($loopDate));?></th>
														<?php
													}
													?>
													<th>Present</th>
													<th>Absent - Full Day</th>
													<th>Absent - Half Day</th>
													<!-- <th>Permission</th> -->
												</tr>
											</thead>

											<tbody>
												<?php
												$employee_sql = "SELECT * FROM employee WHERE del_status=0 ORDER BY fname ASC";
												// $employee_sql = "SELECT *,a.id AS employee_id FROM employee a LEFT OUTER JOIN attendance b ON a.id = b.emp_id WHERE a.del_status = 0 AND b.date = $loopDate ORDER BY fname ASC";
												// echo $employee_sql; die();
												$employee_result = $conn->query($employee_sql);
												$count = 1;
												while($employee_row = mysqli_fetch_array($employee_result)){
													$id = $employee_row['id'];
													$p = $af = $ah = 0;
													?>
												<tr>
													<td><?php echo $count++; ?></td>
													<td><?php echo $employee_row['fname']; ?>&nbsp;<?php echo $employee_row['lname']; ?></td>
													<?php
													for($loopDate = $fd; $loopDate <= $td; $loopDate = date('Y-m-d', strtotime($loopDate.'+1 day'))){
														$status = "";
														$color = "";
														$attend_sql = "SELECT * FROM attendance WHERE date = '$loopDate' AND emp_id = '$id'";
														// echo $attend_sql;die();
														$attend_result = $conn->query($attend_sql);
														if($attend_result->num_rows > 0){
															$attend_row = mysqli_fetch_array($attend_result);
															if($attend_row['status'] == 0){
																$status = "P";
																$p++;
															}
															else{
																if($attend_row['count'] == 1){
																	$status = "A";
																	$af++;
																	$color = "bg-failed";
																}
																else{
																	$status = "AH";
																	$ah++;
																	$color = "bg-warning";
																}
															}
															?>
															<td class='<?php echo $color; ?>'><?php echo $status;?></td>
															<?php
														}else{
														?>
														<td class="bg-secondary"> H </td>
														<?php
														}
													}
													?>
													<td><?php echo $p;?></td>
													<td><?php echo $af;?></td>
													<td><?php echo $ah;?></td>
													<!-- <td>0</td> -->
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
</body>
</html>

<script>
	$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>