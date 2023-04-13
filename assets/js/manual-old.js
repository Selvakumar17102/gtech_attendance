// alert("jhkj");
// $(function(){
// $('#reason_modal').validate({
//     errorElement: 'span',
//     errorElementId : 'error',
//     rules : {
//         reason : {
//             required : true,
//         },
//     },
//     messages : {
//         reason : {
//             required : "Please Enter Reason",
//         },
//         action: "Please provide some data",
//     },
// });
// });

// $('.reason-div').slideUp();

// $('#reject').click(function(e) {
//     e.preventDefault();
//     var reason = $(this).closest('tr').next('.reason-class');
//     reason.slideUp();
//     // $(this).find(".reason-div").slideToggle("slow"); 
// });

function loginCheck(e){
    e.preventDefault()
    // alert("jkhkj");
    var name = document.getElementById('name');
    var pass = document.getElementById('pass');

    if(name.value == ''){
        name.style.border = '1px solid red';
    }
    else{
        name.style.border = '1px solid #bfc9d4';
        if(pass.value == ''){
            pass.style.border = '1px solid red';
            return false;
        }
    }

    if(pass.value != ''){
        pass.style.border = '1px solid #bfc9d4';
        
        $.ajax({
            type : 'POST',
            url : 'user-sign-in.php',
            data : {
                name : name.value,
                pass : pass.value,
            },
            success : function(data){
                // alert(data);
                if(data == 'Invalid username or Password'){
                    $('.validform').html('<span style="color:red; text-align:center">Invalid Username or Password <span>');
                    name.value = '';
                    pass.value = '';
                }
                else{
                    location.replace("dashboard.php");
                }
            }
        });
    }
}

$('#submitCompOff').click(function(){
    // alert("gjhg");
    var id = document.getElementById('empId').value;
    var date = document.getElementById('date').value;
    var range = document.getElementById('range').value;
    var fnan_status = document.getElementById('fn_an_status').value;
    $.ajax({
        type : 'POST',
        url : 'user-comp-off.php',
        data : {
            id : id,
            date : date,
            range : range,
            fnan_status : fnan_status,
        },
        success : function(data){
            // alert(data);
            if(data == 'Enter Name'){
                document.getElementById('empId').style.border = '1px solid red';
            }
            else if(data == 'Enter Date'){
                document.getElementById('empId').style.border = '1px solid #bfc9d4';
                document.getElementById('date').style.border = '1px solid red';
            }
            else if(data == 'Comp Off Updated'){
                $('form')[0].reset();
                document.getElementById('warningmsg').innerHTML = "Comp Off Updated";
                $('#successmsg').parent('div').hide();
                $('#warningmsg').parent('div').show();
                fnanStatus(1);
            }
            else if(data == 'Comp Off Added'){
                $('form')[0].reset();
                document.getElementById('successmsg').innerHTML = "Comp Off Added";
                $('#warningmsg').parent('div').hide();
                $('#successmsg').parent('div').show();
                fnanStatus(1);
            }
        }
    });
});