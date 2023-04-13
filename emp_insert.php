<?php
include('include/connection.php');
session_start();

    $image= $_FILES['image']['name'];
    if($image){
        $upload = "assets/img/employee_img/";
        $temp_name = $_FILES['image']['tmp_name'];
        $images = $upload.$image;
        move_uploaded_file($temp_name,$images);
    }else{
        $images ="https://www.pngkey.com/png/detail/305-3050875_employee-parking-add-employee-icon-png.png";
    }
    
	$aadhar= $_FILES['aadhar']['name'];
    if($aadhar){
        $upload1 = "assets/img/employee_documents/aadhar_card/";
        $temp_aadhar = $_FILES['aadhar']['tmp_name'];
        $aadhar1 = $upload1.$aadhar;
        move_uploaded_file($temp_aadhar,$aadhar1);
    }else{
        $aadhar1="";
    }
    
    $pan= $_FILES['pan']['name'];
    if($pan){
        $upload2 = "assets/img/employee_documents/pan_card/";
        $temp_pan = $_FILES['pan']['tmp_name'];
        $pan1 = $upload2.$pan;
        move_uploaded_file($temp_pan,$pan1);
    }else{
        $pan1="";
    }
    

    $experience= $_FILES['experience']['name'];
    if($experience){
        $upload3 = "assets/img/employee_documents/experience/";
        $temp_experience = $_FILES['experience']['tmp_name'];
        $experience1 = $upload3.$experience;
        move_uploaded_file($temp_experience,$experience1);
    }else{
        $experience1="";
    }
    

    $relieving= $_FILES['relieving']['name'];
    if($relieving){
        $upload4 = "assets/img/employee_documents/relieving/";
        $temp_relieving = $_FILES['relieving']['tmp_name'];
        $relieving1 = $upload4.$relieving;
        move_uploaded_file($temp_relieving,$relieving1);
    }else{
        $relieving1="";
    }

    
    

    $payslip= $_FILES['payslip']['name'];
    if($payslip){
        $upload5 = "assets/img/employee_documents/payslip/";
        $temp_payslip = $_FILES['payslip']['tmp_name'];
        $payslip1 = $upload5.$payslip;
        move_uploaded_file($temp_payslip,$payslip1);
    }else{
        $payslip1="";
    }
    

    $degree= $_FILES['degree']['name'];
    if($degree){
        $upload6 = "assets/img/employee_documents/degree/";
        $temp_degree = $_FILES['degree']['tmp_name'];
        $degree1 = $upload6.$degree;
        move_uploaded_file($temp_degree,$degree1);
    }else{
        $degree1="";
    }
    

if(isset($_POST['submit'])){
    // personal details
    $id = $_POST['id'];
	$fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $employee_id=$_POST['emp_id_no'];
    $pemail=$_POST['pemail'];
    $oemail=$_POST['oemail'];
    $skype=$_POST['skype'];
    $pphone=$_POST['pphone'];
    $sphone=$_POST['sphone'];
    $wphone=$_POST['wphone'];
    $gender=$_POST['gender'];
    $marital=$_POST['marital'];
    $birthday=$_POST['birthday'];
    $joinday=$_POST['joinday'];
	$blood=$_POST['blood'];
	$paddress=$_POST['paddress'];
	$caddress=$_POST['caddress'];

    // official detail

	$team=$_POST['team'];
	$divisions=$_POST['divisions'];
    $location=$_POST['location'];
    $roll=$_POST['roll'];

    if($roll == "Employee"){
        $emp_control = 1;
    }elseif($roll == "Team Leader"){
        $emp_control = 2;
    }elseif($roll == "Project Manager"){
        $emp_control = 3;
    }elseif($roll == "Human Resources"){
        $emp_control = 4;
    }else{
        $emp_control = 5;
    }

    $report1=$_POST['report'];
    $report = implode("/",$report1);
    
    $employeetype=$_POST['employeetype'];
    $employeesatatus=$_POST['employeesatatus'];
	$designation=$_POST['designation'];
    $salary=$_POST['salary'];

    // assets details

    $systemtype=$_POST['systemtype'];
	$sparegadgets1=$_POST['sparegadgets'];
    $sparegadgets = implode("/",$sparegadgets1);

    $configuration=$_POST['configuration'];
    $systemid=$_POST['systemid'];

    // emergency

    $rname=$_POST['rname'];
	$relationship=$_POST['relationship'];
    $contactnumber=$_POST['contactnumber'];


        if($id > 0 ){
		        $updatesql = "UPDATE employee SET emp_id='$employee_id',fname='$fname',lname='$lname',pemail='$pemail',oemail='$oemail',skype='$skype',pphno='$pphone',sphno='$sphone',wphno='$wphone',paddress='$paddress',caddress='$caddress',dob='$birthday',doj='$joinday',blood_group='$blood',division='$divisions',designation='$designation',team='$team',basic_salary='$salary',emp_photo='$images',aadhar='$aadhar1',pan='$pan1',experience='$experience1',reliving='$relieving1',payslip='$payslip1',degreecertificate='$degree1',gender='$gender',marital='$marital',emp_roll='$roll',emp_report_to='$report',location='$location',emp_type='$employeetype',emp_status='$employeesatatus',system_type='$systemtype',spare='$sparegadgets',configuration='$configuration',system_id='$systemid',rname='$rname',relationship='$relationship',contactnumber='$contactnumber', control='$emp_control', username='$oemail',password='$employee_id'  WHERE id=$id";
		        $updateresult=$conn->query($updatesql);
                if($updateresult == TRUE){
                    header('location:user-list.php?msg=Employee Updated!&type=warning');
                }
            
        }else{
		        $sql = "INSERT INTO employee (emp_id,fname,lname,pemail,oemail,skype,pphno,sphno,wphno,paddress,caddress,dob,doj,blood_group,division,designation,team,basic_salary,emp_photo,aadhar,pan,experience,reliving,payslip,degreecertificate,gender,marital,location,emp_type,emp_status,system_type,spare,configuration,system_id,rname,relationship,contactnumber,emp_roll,emp_report_to,username,password,control) VALUES('$employee_id','$fname','$lname','$pemail','$oemail','$skype','$pphone','$sphone','$wphone','$paddress','$caddress','$birthday','$joinday','$blood','$divisions','$designation','$team','$salary','$images','$aadhar1','$pan1','$experience1','$relieving1','$payslip1','$degree1','$gender','$marital','$location','$employeetype','$employeesatatus','$systemtype','$sparegadgets','$configuration','$systemid','$rname','$relationship','$contactnumber','$roll','$report','$oemail','$employee_id','$emp_control')";
		        $result=$conn->query($sql);
                if($result == TRUE){
                    header('location:user-list.php?msg=Employee Added!&type=success');
                }
        }
	
}
?>