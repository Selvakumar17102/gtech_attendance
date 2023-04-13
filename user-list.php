<?php
include('include/connection.php');
ini_set("display_errors",'off');
session_start();
$fetch_sql = "SELECT * FROM employee WHERE del_status = 0";
$fetch_result = $conn->query($fetch_sql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

	<title>Gtech - Employee_Table</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />

	<!-- Data Tables -->
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
					<div class="breadcrumb-wrapper breadcrumb-contacts">
						<div>
							<h1>Employee List</h1>
							<div>
							  <a class="btn btn-primary" href="javascript:history.go(-1)">Back</a>
							</div>
						</div>
						<div>
							<a href="add_employee.php"><button type="button" class="btn btn-primary" > Add Employee</button></a>
						</div>
					</div>
					<?php
					if($_GET['type'] == 'success'){
					?>
						<div class="alert alert-success text-center" role="alert">
							<?php echo $_REQUEST['msg']; ?>
						</div>
					<?php
					}
					elseif($_GET['type'] == 'warning'){
					?>
						<div class="alert alert-warning text-center" role="alert">
							<?php echo $_REQUEST['msg']; ?>
						</div>
					<?php
					}
					?>
					<div class="row">
						<div class="col-12">
							<div class="ec-vendor-list card card-default">
								<div class="card-body">
									<div class="table-responsive">
										<table id="responsive-data-table" class="table">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Emp Id</th>
													<th>Name</th>
													<th>Phone Number</th>
													<th>Date Of Join</th>
													<th>Location</th>
													<th>Working Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$i = 0;
												while($row=mysqli_fetch_array($fetch_result)){
													$i++;
												?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $row['emp_id'];?></td>
													<td><?php echo $row['fname'];?>&nbsp;<?php echo $row['lname'];?></td>
													<td><?php echo $row['pphno'];?></td>
													<td><?php echo $row['doj'];?></td>
													<td><?php echo $row['location'];?></td>
													<?php
															if($row['emp_status'] == 'Active'){
															?>
															<td><span class="mb-2 mr-2 badge badge-success"><?php echo $row['emp_status'];?></span></td>
															<?php
															}else{
																?>
																<td><span class="mb-2 mr-2 badge badge-danger"><?php echo $row['emp_status'];?></span></td>
																<?php
															}
															?>
													<td>
														<div class="btn-group mb-1">
															<button type="button" class="btn btn-outline-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">Info</button>
															<button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"><span class="sr-only">Info</span></button>
															<div class="dropdown-menu">
																<a class="dropdown-item" href="view_employee.php?edit_id=<?php echo $row['id'];?>">View</a>
																<a class="dropdown-item" href="add_employee.php?edit_id=<?php echo $row['id'];?>">Edit</a>
																<a class="dropdown-item" href="delete_emp.php?edit_id=<?php echo $row['id'];?>">Delete</a>
															</div>
														</div>
													</td>
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
					<!-- Add User Modal  -->
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

	<!-- Data Tables -->
	<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

	<!-- Option Switcher -->
	<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
	<script src="assets/js/manual.js"></script>
</body>

</html>