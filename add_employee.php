<?php

session_start();
ini_set("display_errors",'off');
include('include/connection.php');
if(isset($_GET['edit_id'])){
    $id=$_GET['edit_id'];
    $sql = "SELECT * FROM employee WHERE id=$id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}

$alldataSql = "SELECT * FROM employee WHERE control != 1";
$alldataResult = $conn->query($alldataSql);

// $teamSql = "SELECT * FROM team";
// $teamResult =$conn->query($teamSql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

	<title>GTech - Add Employee.</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


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
							<h1>Add Employee</h1>
							<!-- <p class="breadcrumbs"><span><a href="index.php">Home</a></span>
								<span><i class="mdi mdi-chevron-right"></i></span>Product</p> -->
						</div>
						<div>
							<a href="javascript:history.go(-1)" class="btn btn-primary">Back
							</a>
						</div>
					</div>
					<div class="row review-rating mt-4">
						<div class="col-12">
							<ul class="nav nav-tabs" id="myRatingTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="product-detail-tab" data-bs-toggle="tab" data-bs-target="#productdetail" href="#productdetail" role="tab" aria-selected="true">
										<i class="mdi mdi-library-books mr-1"></i>Personal Details</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" id="product-information-tab" data-bs-toggle="tab" data-bs-target="#productinformation" href="#productinformation" role="tab" aria-selected="false">
										<i class="mdi mdi-information mr-1"></i>Official Details</a>
								</li>

								<li class="nav-item">
									<a class="nav-link" id="product-reviews-tab" data-bs-toggle="tab" data-bs-target="#document" href="#document" role="tab" aria-selected="false">
										<i class="mdi mdi-star-half mr-1"></i> Documents </a>
								</li>

								<li class="nav-item">
									<a class="nav-link" id="product-reviews-tab" data-bs-toggle="tab" data-bs-target="#assets" href="#assets" role="tab" aria-selected="false">
										<i class="mdi mdi-star-half mr-1"></i> Assets Management </a>
								</li>

								<li class="nav-item">
									<a class="nav-link" id="product-reviews-tab" data-bs-toggle="tab" data-bs-target="#emergency" href="#emergency" role="tab" aria-selected="false">
										<i class="mdi mdi-star-half mr-1"></i> Emergency Contact Details </a>
								</li>
							</ul>
							<form method="post" id="regForm" action="emp_insert.php" enctype="multipart/form-data">
								<div class="tab-content" id="myTabContent2">
								<div class="tab-pane pt-3 fade show active" id="productdetail" role="tabpanel">
									<div class="row mb-2">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="firstName">First Name<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="firstname" name="fname" placeholder="first Name" value="<?php echo $row['fname']?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="firstName">Last Name<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="lastname" name="lname" placeholder="Last Name" value="<?php echo $row['lname']?>"required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="Designation">Designation<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="designation1" name="designation" placeholder="Designation"value="<?php echo $row['designation']?>"required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="firstName">Employee Id<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="emp_id" name="emp_id_no" placeholder="Employee Id" value="<?php echo $row['emp_id']?>"required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="personal_Email">Personal Email<span style="color:red;font-weight:bold">*</span></label>
												<input type="email" class="form-control" id="peremail" name="pemail" placeholder="Personal Email" value="<?php echo $row['pemail']?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="Office_Email">Office Email<span style="color:red;font-weight:bold">*</span></label>
												<input type="email" class="form-control" id="offemail" name="oemail" placeholder="Office Email" value="<?php echo $row['oemail']?>"required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="Skype">Skype<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="skypeid" name="skype" placeholder="Skype" value="<?php echo $row['skype']?>"required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="primery_Phone">Primary Phone Number<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="perphone" name="pphone" placeholder="Primary Phone Number" value="<?php echo $row['pphno']?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="secondary_Phone">Secondary Phone Number</label>
												<input type="text" class="form-control" id="secphone" name="sphone" placeholder="Secondary Phone Number" value="<?php echo $row['sphno']?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="Whatsapp">Whatsapp Number<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="whatphone" name="wphone" placeholder="Whatsapp Number" value="<?php echo $row['wphno']?>"required>
											</div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Gender<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="gender" id="gender" class="form-control" value="male" required>
										    			<option value="" data-display="Team">Select Gender</option>
										    			<option value="Male" <?php if($row['gender']=='Male'){ echo "selected"; }?>>Male</option>
										    			<option value="Female" <?php if($row['gender']=='Female'){ echo "selected"; }?>>Female</option>
														<option value="Transgender" <?php if($row['gender']=='Transgender'){ echo "selected"; }?>>Transgender</option>
										    	</select>
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Marital Status<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="marital" id="marital" class="form-control" required>
										    			<option value="" data-display="Team">Select Marital Status</option>
										    			<option value="Married" <?php if($row['marital']=='Married'){ echo "selected"; }?>>Married</option>
										    			<option value="Divorced"<?php if($row['marital']=='Divorced'){ echo "selected"; }?>>Divorced</option>
														<option value="Widowed"<?php if($row['marital']=='Widowed'){ echo "selected"; }?>>Widowed</option>
														<option value="Single"<?php if($row['marital']=='Single'){ echo "selected"; }?>>Single</option>
										    	</select>
										    </div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="birthday">Birth Date<span style="color:red;font-weight:bold">*</span></label>
												<input type="date" class="form-control" id="birthdaydate" name="birthday" placeholder="Birth Date" value="<?php echo $row['dob']?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="Birthday">Joining Date<span style="color:red;font-weight:bold">*</span></label>
												<input type="date" class="form-control" id="joindaydate" name="joinday" placeholder="Joining Date" value="<?php echo $row['doj']?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Blood Group<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="bloodgroup" name="blood" placeholder="Blood Group" value="<?php echo $row['blood_group']?>" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="permanent_Address">Permanent Address<span style="color:red;font-weight:bold">*</span></label>
												<textarea type="text" class="form-control" id="peraddress" name="paddress" placeholder="Permanent Address" required><?php echo $row['paddress']?></textarea>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="current_Address">Current Address<span style="color:red;font-weight:bold">*</span></label>
												<textarea type="text" class="form-control" id="curaddress" name="caddress" placeholder="Current Address" required><?php echo $row['caddress']?></textarea>
											</div>
										</div>
										<div class="modal-footer px-4">
											<button type="button" name="persnol_submit" id="persnol_submit" class="btn btn-primary btn-pill">Next</button>
										</div>
									</div>
								</div>

								<div class="tab-pane pt-3 fade" id="productinformation" role="tabpanel">
									<div class="row mb-2">
										<div class="col-md-6">
											<div class="form-group mb-4">
												<label class="form-label">Team<span style="color:red;font-weight:bold">*</span></label>
												<select name="team" id="team1" class="form-control" required>
														<option value="" data-display="Team">Select Team</option>
														<?php
														// while($teamRow = mysqli_fetch_array($teamResult)){
															?>
															<!-- <option value="<?php echo $teamRow['id']?>" <?php if($row['team'] == $teamRow['id']){ echo "selected"; }?>><?php echo $teamRow['name']?></option> -->
															<?php
														// }
														?>
														<option value="Development" <?php if($row['team']=='Development'){ echo "selected"; }?>>Development</option>
														<option value="Adroid Developer" <?php if($row['team']=='Adroid Developer'){ echo "selected"; }?>>Digital Marketing</option>
														<option value="Design" <?php if($row['team']=='Design'){ echo "selected"; }?>>Design</option>
														<option value="HR" <?php if($row['team']=='HR'){ echo "selected"; }?>>HR</option>
														<option value="Business Development" <?php if($row['team']=='Business Development'){ echo "selected"; }?>>Business Development</option>
												</select>
											</div>
										</div>
										<?php
										if($row['team']==''){
											$doption ="none";
										}else{
											$doption ="block";
										}
										?>
										<div class="col-md-6 divisions"style="display:<?php echo $doption;?>">
											<div class="form-group mb-4">
												<label class="form-label">Divisions<span style="color:red;font-weight:bold">*</span></label>
												<select name="divisions" id="divisions1" class="form-control">
														<option value="" data-display="Divisions">Select Divisions</option>
														<option value="Node" <?php if($row['division']=='Node'){ echo "selected"; }?>>Node</option>
														<option value="PHP" <?php if($row['division']=='PHP'){ echo "selected"; }?>>PHP</option>
														<option value="Laravel" <?php if($row['division']=='Laravel'){ echo "selected"; }?>>Laravel</option>
														<option value="React" <?php if($row['division']=='React'){ echo "selected"; }?>>React</option>
														<option value="Adroid" <?php if($row['division']=='Adroid'){ echo "selected"; }?>>Adroid</option>
														<option value="Angular" <?php if($row['division']=='Angular'){ echo "selected"; }?>>Angular</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Roll<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="roll" id="roll1" class="form-control" required>
										    			<option value="" data-display="Team">Select Roll</option>
										    			<option value="Employee" <?php if($row['emp_roll']=='Employee'){ echo "selected"; }?>>Employee</option>
														<option value="Team Leader" <?php if($row['emp_roll']=='Team Leader'){ echo "selected"; }?>>Team Leader</option>
										    			<option value="Project Manager" <?php if($row['emp_roll']=='Project Manager'){ echo "selected"; }?>>Project Manager</option>
														<option value="Human Resources" <?php if($row['emp_roll']=='Human Resources'){ echo "selected"; }?>>Human Resources</option>
														<option value="Super Admin" <?php if($row['emp_roll']=='Super Admin'){ echo "selected"; }?>>Super Admin</option>
										    	</select>
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Reporting To<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="report[]" id="report1" class="selectpicker" multiple data-live-search="true" required>
													<?php
													while($alldata = mysqli_fetch_array($alldataResult)){
														?>
														<option value="<?php echo $alldata['fname']?><?php echo $alldata['lname']?>" <?php if($row['emp_report_to']== $alldata['fname'].$alldata['lname']){ echo "selected"; }?>><?php echo $alldata['fname']?><?php echo $alldata['lname']?></option>
														<?php
													}
													?>
										    			<!-- <option value="Team Leader" <?php if($row['emp_report_to']=='Team Leader'){ echo "selected"; }?>>Team Leader</option>
										    			<option value="Project Manager" <?php if($row['emp_report_to']=='Project Manager'){ echo "selected"; }?>>Project Manager</option>
														<option value="Super Admin" <?php if($row['emp_report_to']=='Super Admin'){ echo "selected"; }?>>Super Admin</option> -->
										    	</select>
										    </div>
										</div>
                                        <div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Location<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="location" id="location1" class="form-control" required>
										    			<option value="" data-display="Team">Select Location</option>
										    			<option value="Chennai" <?php if($row['location']=='Chennai'){ echo "selected"; }?>>Chennai</option>
										    			<option value="Pudukkottai" <?php if($row['location']=='Pudukkottai'){ echo "selected"; }?>>Pudukkottai</option>
										    	</select>
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Employee Type<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="employeetype" id="employeetype1" class="form-control" required>
										    			<option value="" data-display="Team">Select Employee Type</option>
										    			<option value="Prohibition" <?php if($row['emp_type']=='Prohibition'){ echo "selected"; }?>>Prohibition</option>
										    			<option value="Permanent" <?php if($row['emp_type']=='Permanent'){ echo "selected"; }?>>Permanent</option>
										    	</select>
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Employee Status<span style="color:red;font-weight:bold">*</span></label>
										    	<select name="employeesatatus" id="employeestatus1" class="form-control" required>
										    			<option value="" data-display="Team">Select Employee Status</option>
										    			<option value="Active" <?php if($row['emp_status']=='Active'){ echo "selected"; }?>>Active</option>
										    			<option value="Resign" <?php if($row['emp_status']=='Resign'){ echo "selected"; }?>>Resign</option>
														<option value="Abscond" <?php if($row['emp_status']=='Abscond'){ echo "selected"; }?>>Abscond</option>
														<option value="Terminated" <?php if($row['emp_status']=='Terminated'){ echo "selected"; }?>>Terminated</option>
										    	</select>
										    </div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="salary">Salary<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="salaryamo" name="salary" placeholder="Salary"value="<?php echo $row['basic_salary']?>" required>
											</div>
										</div>
										<div class="modal-footer px-4">
											<button type="button" name="official_submit" id="official_submit" class="btn btn-primary btn-pill">Next</button>
										</div>
									</div>
								</div>

								<div class="tab-pane pt-3 fade" id="document" role="tabpanel">
									<div class="form-group row mb-3">
										<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Profile Image</label>
										<div class="col-sm-8 col-lg-10">
											<div class="custom-file">
												<input type="file" name="image" class="form-control" id="coverImage" value="<?php echo $row['emp_photo']?>">
											</div>
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Aadhar Card<span style="color:red;font-weight:bold">*</span></label>
												<input type="file" class="form-control" id="aadharcard" name="aadhar" placeholder="Aadhar Card" required>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Pan Card</label>
												<input type="file" class="form-control" id="pancard" name="pan" placeholder="Pan Card">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Experience</label>
												<input type="file" class="form-control" id="experiencecer" name="experience" placeholder="Experience" >
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Relieving</label>
												<input type="file" class="form-control" id="relievingcer" name="relieving" placeholder="Relieving ">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Pay Slip</label>
												<input type="file" class="form-control" id="payslipcer" name="payslip" placeholder="Pay Slip">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">Degree Certificate</label>
												<input type="file" class="form-control" id="degreecer" name="degree" placeholder="Degree Certificate" >
											</div>
										</div>
										<div class="modal-footer px-4">
											<button type="button" name="document_submit" id="document_submit" class="btn btn-primary btn-pill">Next</button>
										</div>
									</div>
								</div>

								<div class="tab-pane pt-3 fade" id="assets" role="tabpanel">
									<div class="row mb-2">
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">System Type</label>
										    	<select name="systemtype" id="systemtype1" class="form-control" >
										    			<option value=" " data-display="Team">Select System Type</option>
										    			<option value="Desktop" <?php if($row['system_type']=='Desktop'){ echo "selected"; }?>>Desktop</option>
										    			<option value="Laptop" <?php if($row['system_type']=='Laptop'){ echo "selected"; }?>>Laptop</option>
										    	</select>
										    </div>
										</div>
										<div class="col-md-6">
										    <div class="form-group mb-4">
										    	<label class="form-label">Spare Gadgets</label>
										    	<select name="sparegadgets[]" id="sparegadgets" class="selectpicker" multiple data-live-search="true">
										    			<option value="Headset" <?php if($row['spare']=='Headset'){ echo "selected"; }?>>Headset</option>
										    			<option value="Mouse" <?php if($row['spare']=='Mouse'){ echo "selected"; }?>>Mouse</option>
														<option value="Wifi Adapter" <?php if($row['spare']=='Wifi Adapter'){ echo "selected"; }?>>Wifi Adapter</option>
														<option value="Keyboard" <?php if($row['spare']=='Keyboard'){ echo "selected"; }?>>Keyboard</option>
														<option value="Ethernetcable" <?php if($row['spare']=='Ethernetcable'){ echo "selected"; }?>>Ethernet cable</option>
										    	</select>
										    </div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">System Configuration</label>
												<input type="text" class="form-control" id="configuration" name="configuration" placeholder="System Configuration" value="<?php echo $row['configuration']?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group mb-4">
												<label for="event">System Id</label>
												<input type="text" class="form-control" id="systemid" name="systemid" placeholder="System Id" value="<?php echo $row['system_id']?>">
											</div>
										</div>
										<div class="modal-footer px-4">
											<button type="button" name="assets_submit" id="assets_submit" class="btn btn-primary btn-pill">Next</button>
										</div>
									</div>
								</div>

								<div class="tab-pane pt-3 fade" id="emergency" role="tabpanel">
									<div class="row mb-2">
										<div class="col-lg-4">
											<div class="form-group mb-4">
												<label for="event">Name<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="rname" name="rname" placeholder="Relation Name" value="<?php echo $row['rname']?>" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group mb-4">
												<label for="event">Relationship<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="relationship" name="relationship" placeholder="Relationship" value="<?php echo $row['relationship']?>" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group mb-4">
												<label for="event">Contact Number<span style="color:red;font-weight:bold">*</span></label>
												<input type="text" class="form-control" id="contactnumber" name="contactnumber" placeholder="Contact Number" value="<?php echo $row['contactnumber']?>" required>
											</div>
										</div>
									</div>
									<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']?>">
									<div class="modal-footer px-4">
										<button type="submit" name="submit" id="submit" class="btn btn-primary btn-pill">Save Details</button>
									</div>
								</div>
								</div>
							</form>
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

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
	<script src="assets/js/manual.js"></script>
</body>

</html>
<script>
	$('#team1').change(function(){
		
		var team=$('#team1').val();
		if(team == 'Development'){
		
		$('.divisions').show();
		}else{
			
			$('.divisions').hide();
		}
	});
</script>
<script>
$(document).ready(function(){
	$('#persnol_submit').click(function(){
		var firstName = document.getElementById('firstname')
		var lastname = document.getElementById('lastname')
		var designation = document.getElementById('designation1')
		var emp_id = document.getElementById('emp_id')
		var peremail = document.getElementById('peremail')
		var offemail = document.getElementById('offemail')
		var skypeid = document.getElementById('skypeid')
		var perphone = document.getElementById('perphone')
		var whatphone = document.getElementById('whatphone')
		var gender = document.getElementById('gender')
		var marital = document.getElementById('marital')
		var birthdaydate = document.getElementById('birthdaydate')
		var joindaydate = document.getElementById('joindaydate')
		var bloodgroup = document.getElementById('bloodgroup')
		var peraddress = document.getElementById('peraddress')
		var curaddress = document.getElementById('curaddress')
		

		if(firstName.value==""){
			firstName.style.border='1px solid red'
		}else{
			firstName.style.border='1px solid green'
			if(lastname.value==""){
				lastname.style.border='1px solid red' 
			}else{
				lastname.style.border='1px solid green'
				if(designation.value ==""){
					designation.style.border='1px solid red'
				}else{
					designation.style.border='1px solid green'
					if(emp_id.value==""){
						emp_id.style.border='1px solid red'
					}else{
						emp_id.style.border='1px solid green'
						if(peremail.value==""){
							peremail.style.border='1px solid red'
						}else{
							peremail.style.border='1px solid green'
							if(offemail.value==""){
								offemail.style.border='1px solid red'
							}else{
								offemail.style.border='1px solid green'
								if(skypeid.value==""){
									skypeid.style.border='1px solid red'
								}else{
									skypeid.style.border='1px solid green'
									if(perphone.value==""){
										perphone.style.border='1px solid red'
									}else{
										perphone.style.border='1px solid green'
										if(whatphone.value==""){
											whatphone.style.border='1px solid red'
										}else{
											whatphone.style.border='1px solid green'
											if(gender.value==""){
												gender.style.border='1px solid red'
											}else{
												gender.style.border='1px solid green'
												if(marital.value==""){
													marital.style.border='1px solid red'
												}else{
													marital.style.border='1px solid green'
													if(birthdaydate.value==""){
														birthdaydate.style.border='1px solid red'
													}else{
														birthdaydate.style.border='1px solid green'
														if(joindaydate.value==""){
															joindaydate.style.border='1px solid red'
														}else{
															joindaydate.style.border='1px solid green'
															if(bloodgroup.value==""){
																bloodgroup.style.border='1px solid red'
															}else{
																bloodgroup.style.border='1px solid green'
																if(peraddress.value==""){
																	peraddress.style.border='1px solid red'
																}else{
																	peraddress.style.border='1px solid green'
																	if(curaddress.value==""){
																		curaddress.style.border='1px solid red'
																	}else{
																		curaddress.style.border='1px solid green'
																		return true;
																	}	
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}

			}
		}
	});
	$('#official_submit').click(function(){
		var team = document.getElementById('team1')
		var divisions = document.getElementById('divisions1')
		var roll = document.getElementById('roll1')
		var report = document.getElementById('report1')
		var location = document.getElementById('location1')
		var employeetype = document.getElementById('employeetype1')
		var employeestatus = document.getElementById('employeestatus1')
		var salaryamo = document.getElementById('salaryamo')

		if(team.value==""){
			team.style.border='1px solid red'
		}else{
			team.style.border='1px solid green'
				if(roll.value ==""){
					roll.style.border='1px solid red'
				}else{
					roll.style.border='1px solid green'
					if(report.value==""){
						report.style.border='1px solid red'
					}else{
						report.style.border='1px solid green'
						if(location.value==""){
							location.style.border='1px solid red'
						}else{
							location.style.border='1px solid green'
							if(employeetype.value==""){
								employeetype.style.border='1px solid red'
							}else{
								employeetype.style.border='1px solid green'
								if(employeestatus.value==""){
									employeestatus.style.border='1px solid red'
								}else{
									employeestatus.style.border='1px solid green'
									if(salaryamo.value==""){
										salaryamo.style.border='1px solid red'
									}else{
										salaryamo.style.border='1px solid green'
										return true;
									}
								}
							}
						}
					}
				}
			
		}
	});
	$('#document_submit').click(function(){
		var aadharcard = document.getElementById('aadharcard')

		if(aadharcard.value==""){
			aadharcard.style.border='1px solid red'
		}else{
			aadharcard.style.border='1px solid green'
			return true;
		}
	});
	$('#submit').click(function(){
		var rname = document.getElementById('rname')
		var relationship = document.getElementById('relationship')
		var contactnumber = document.getElementById('contactnumber')

		if(rname.value==""){
			rname.style.border='1px solid red'
		}else{
			rname.style.border='1px solid green'
			if(relationship.value==""){
				relationship.style.border='1px solid red'
			}else{
				relationship.style.border='1px solid green'
				if(contactnumber.value==""){
					contactnumber.style.border='1px solid red'
				}else{
					contactnumber.style.border='1px solid green'
				}
			}
		}
	});
});
</script>