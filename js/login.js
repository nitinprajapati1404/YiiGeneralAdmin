$(document).ready(function(e){
 $('#divConsumerError').html('');
$('#frmLoginform').validationEngine();
    $('#frmLoginform input').bind('keypress', function(e){
        if(e.keyCode==13)
            $('#btnSubmitlogin').trigger('click');
    });
    $('#btnSubmitlogin').click(function(e){
        e.preventDefault();
        if($('#frmLoginform').validationEngine('validate'))
        {
             $('form#frmLoginform').submit();
        }
     }); 
     $('#btnForgetPwd').click(function(e){
        $('#frmForgetPwdform').validationEngine();
    });
    
    $('#btnForgetpwdSubmit').click(function(e){
        if($('#frmForgetPwdform').validationEngine('validate'))
        {
            $('#btnForgetpwdSubmit').hide();
            $('#spnLoadingImg').show();
             var url=config.siteUrl+"site/forgetPassword" ;
             var data = {};
             data['email'] = encodeURIComponent($('#txtUsername').val());
             $.ajax({
                url: url,
                data : data,
                type : 'post',
                success : function(e){
                    //alert(e);
                    e  = $.trim(e); 
                    if(e == -1)
                    {
                        //alert('Please Enter Email Address');
                        $('#divConsumerError').show();
                        $('#divConsumerError').html('Please Enter Email Address');
                        return false;
                    }
                    if(e == 0)
                    {
                        //alert('Email address not registered with system');
                        $('#divConsumerError').show();
                        $('#divConsumerError').html('Email address not registered with system');
                        $('#spnLoadingImg').hide();
                        $('#spnLoadingImg').hide();
                        $('#btnForgetpwdSubmit').show();
                        return false;
                    }
                    if(e == 1)
                    {
                        //alert('Email address not registered with system');
                        $('#divConsumerError').show();
                        myAlert('Mail has been sent successfully','success');
                        $('#divConsumerError').html('Mail has been sent successfully');
                        $('#divConsumerError').html('');
                        $('#btnForgetpwdSubmit').show();
                        $('#divForgetPwd').modal('hide');
                        return false;
                    }
                    else
                    {
                        $('#divConsumerError').show();
                        $('#divConsumerError').html('Error Occured during sending mail...');
                        $('#spnLoadingImg').hide();
                    $('#btnForgetpwdSubmit').show();
                        return false;
                    }
                    $('#spnLoadingImg').hide();
                    $('#btnForgetpwdSubmit').show();
                }
           });
        }
    });
    $('.modal').on('hidden.bs.modal', function(e)
    { 
         $('#spnLoadingImg').hide();
         $('#txtUsername').val('');
         $(e.target).removeData('bs.modal');
         //$('#frmForgetPwdform').validationEngine('detach');
         $('#frmForgetPwdform').validationEngine('hideAll')
         //$('#frmForgetPwdform').validationEngine('hide');
         $('#divConsumerError').html('');
         //$('#frmForgetPwdform').reset();
    });
 });