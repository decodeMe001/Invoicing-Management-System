$(document).ready(function () {
    // when the form is submitted
    $('.login').unbind('submit').bind('submit', function (e) {

        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var dataInfo = $(this); 

            // POST values in the background to the script URL
            $.ajax({
                url: dataInfo.attr('action'),
				type: dataInfo.attr('method'),
                data: dataInfo.serialize(),
                dataType:'json',
                success: function (response)
                {
					console.log(response);
                    if(response.success == true){
                        $(".text-danger").remove();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						
						window.location.href = response.redirect_url;
												
                    }else{
						if(response.messages instanceof Object) {
							$.each(response.messages, function(key, value) {
								var element = $('#' + key);
								element.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')//check value lenght
								.find('.text-danger')
								.remove();
								//assign the form_error field after the element
								element.after(value);
							});
						}
						else {						
							$(".msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							response.messages+'</div>');

							$(".text-danger").remove();
							$(".form-group").removeClass('has-error').removeClass('has-success');
						}
                    }
                }
            });
            return false;
        }
    })
});