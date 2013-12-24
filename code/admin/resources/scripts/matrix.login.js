
$(document).ready(function(){

	var login = $('#loginform');
	var recover = $('#recoverform');
	var speed = 400;

	$('#to-recover').click(function(){
		
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
	
	
	$('#to-login').click(function(){
	
	});
    $("#loginform").validate({
		rules:{
			username:{
				required: true
				/*email: true,
				minlength:6,
				maxlength:20*/
			},
			password:{
				required:true,
				minlength:6,
				maxlength:20
			}
		},
		messages:{
			/*username:"请填写用户名",
			password:{
				required:"请填写密码",
				minlength:"密码最小为6位",
				maxlength:'密码最长为6位'
			}*/
			username:"*",
			password:{
				required:"*",
				minlength:"密码最小为6位",
				maxlength:'密码最长为20位'
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('success');
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	$('#action_login').bind('click',function(){
		$("#loginform").submit();
	})
    if($.browser.msie == true && $.browser.version.slice(0,3) < 10) {
        $('input[placeholder]').each(function(){ 
       
        var input = $(this);       
       
        $(input).val(input.attr('placeholder'));
               
        $(input).focus(function(){
             if (input.val() == input.attr('placeholder')) {
                 input.val('');
             }
        });
       
        $(input).blur(function(){
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.val(input.attr('placeholder'));
            }
        });
    });
    }
});