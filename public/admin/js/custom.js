$(document).ready(function(){
   $('#current_password').keyup(function(){
        var currentPassword = $("#current_password").val();
        // alert(currentPassword);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type:'post',
            url:'/admin/check_password',
            data: {
                currentPassword: currentPassword,
                // new_password: $("#new_password").val(),
                // confirm_password: $("#confirm_password").val()
            },
            success:function(response){
                if(response=="false"){
                    $("#verifyCurrentPassword").html("Password you have entered is Incorrect");
                }
                else if(response=="true"){
                    $("#verifyCurrentPassword").html("Password you have entered is correct.");
                }
            },
            error:function(){
                alert('Wrong password');
            }
        });
    });
});
