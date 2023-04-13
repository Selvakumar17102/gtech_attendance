window.addEventListener('load', (event) => {
    const queryString = new URLSearchParams(window.location.search)
    let msg = queryString.get('msg')
    let login_id = queryString.get('id')
    if(login_id != null){
        localStorage.setItem('id', login_id)
        $.ajax({
            type: "POST",
            url: "ajax/sessionSet.php",
            data:{'login':login_id},
            success: function(data){
                location.replace('dashboard.php')
            }
        });
    }
    if(msg != null){
        Snackbar.show({
            text: msg,
            pos: 'bottom-right',
            actionText: 'Success',
            actionTextColor: '#8dbf42',
            duration: 5000
        });
    }
    let login = localStorage.getItem('id')
    if(login == null){
        let thisURl = window.location.href
        if(thisURl.charAt(thisURl.length-1) != '/'){
            // console.log(thisURl.charAt(thisURl.length-1))
            location.replace('./')
        }
    } else{
        $.ajax({
            type: "POST",
            url: "ajax/sessionSet.php",
            data:{'login':login},
            success: function(data){
                if(window.location.href.charAt(window.location.href.length-1) == '/'){
                    location.replace('dashboard.php')
                } else{
                    if(data == 'false'){
                        location.reload()
                    }
                }
            }
        });
    }
});

$('#signin').click(function(){
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
                    localStorage.setItem('id', data)
                    $.ajax({
                        type: "POST",
                        url: "ajax/sessionSet.php",
                        data:{'login':data},
                        success: function(data){
                            location.replace('dashboard.php');
                        }
                    });
                }
            }
        });
    }
});

function logOut(){
    $.ajax({
        type: "POST",
        url: "ajax/logoutCheck.php",
        data:{'username':1,},
        success: function(data){
            if(data == 'success'){
                localStorage.removeItem('id')
                location.replace('./')
            }
        }
    });
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