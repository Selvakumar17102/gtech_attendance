<?php

session_start();
ini_set('display_errors', 'off');
include("include/connection.php");

$today = date('Y-m-d');
// $today1 = date('d/m/Y');
$minDate = date('Y-m-01');

// if(isset($_POST['submit'])){
//     $id = $_POST['empId'];
//     $date = $_POST['date'];
//     $range = $_POST['range'];
//     $fn_an_status = $_POST['fn_an_status'];

//     $comp_sql = "SELECT * FROM comp_off WHERE emp_id='$id' AND date='$date'";
//     $comp_result = $conn->query($comp_sql);
//     if($comp_result->num_rows > 0){

//         if($range == 1){
//             $fn_an_status = 0;
//         }
//         $comp_sql1 = "UPDATE comp_off SET count='$range', fn_an_status='$fn_an_status' WHERE emp_id='$id' AND date='$date'";
//         if($conn->query($comp_sql1) == TRUE){
//             header('location: comp-off.php?msg=Comp-Off Updated!&type=warning');
//         }
//     }
//     else{

//         if($range == 1){
//             $fn_an_status = 0;
//         }
//         $comp_sql2 = "INSERT INTO comp_off (emp_id, date, count, fn_an_status) VALUES ('$id', '$date', '$range', '$fn_an_status')";
//         if($conn->query($comp_sql2)){
//             header('location: comp-off.php?msg=Comp-Off Added!&type=success');
//         }
//     }
// }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

	<title>Gtech - Comp-Off</title>

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
							<h1>Comp-Off</h1>
							<p class="breadcrumbs"><span><a href="index.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Comp-Off</p>
						</div>
						<!-- <div>
							<a href="product-list.php" class="btn btn-primary">Attendance Report</a>
						</div> -->
					</div>

					<?php
					// if(localStorage)
					?>

						<div class="alert alert-success text-center" role="alert" style="display:none">
							<p id="successmsg"></p>
						</div>
						<div class="alert alert-warning text-center" role="alert" style="display:none">
							<p id="warningmsg"></p>
						</div>

					<div class="row m-b30">
						<div class="col-12">
							<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>Comp-off Report</h2>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <form id="compOff" method="post">
                                            <table class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Employee Name</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-4">
                                                        <div class="col">
															<select name="empId" id="empId" class="form-select">
																<option value='0'>-- Select Employee Name --</option>
                                                                <?php
                                                                $emp_table = "SELECT * FROM employee WHERE del_status=0";
                                                                $emp_result = $conn->query($emp_table);
                                                                while($emp_row = mysqli_fetch_array($emp_result)){
                                                                ?>
																    <option value="<?php echo $emp_row['id']; ?>"><?php echo $emp_row['fname'];?> <?php echo $emp_row['lname'];?></option>
                                                                <?php
                                                                }
                                                                ?>
															</select>
														</div>
                                                    </td>
                                                    <td class="col-4"><input type="date" name="date" id="date" class="form-control" max="<?php echo $today;?>" min="<?php echo $minDate;?>"></td>
                                                    <td class="col-4">
                                                        <div class="row">
                                                        	<div class="col">
																<select name="range" id="range" class="form-select" onclick="fnanStatus(this.value)">
																	<option value="1">Full Day</option>
																	<option value="2">Half A Day</option>
																</select>
															</div>
                                                        	<div class="col absent_status" style="display: none">
																<select name="fn_an_status" id="fn_an_status" class="form-select">
																	<option value="1">FN</option>
																	<option value="2">AN</option>
																</select>
															</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><button type="button" class="btn btn-success" id="submitCompOff" name="submit">Submit</button></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </form>
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

	<!-- Data-Tables -->
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
<script>
        // FN AN control
		function fnanStatus(val){
			if(val == 1){
				$('.absent_status').hide();
			}
			else{
				$('.absent_status').show();
			}
		}
</script>