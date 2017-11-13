jQuery(document).ready(function($)
	{


		$(document).on('click', '.pp-admin.welcome .job-bm-subscribe', function()
			{
				
				//alert('Hello');
				
				var is_confirm = $(this).attr('confirm');
				
				if(is_confirm=='ok'){
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:job_bm_ajax.job_bm_ajaxurl,
					data: {"action": "job_bm_ajax_welcome_subscribe_email",},
					success: function(data)
							{	
								$('.subscribe .message').html(data);
								$(this).html('Done');
								//alert(data);
								//$(this).html(data);
								//$(this).parent().parent().remove();
								//$('.see-phone-number .phone-number').html(data);
								//location.reload(true);
								//alert(data);
							}
						});
					
					}
				else{
					
					$(this).attr('confirm','ok');
					$(this).html('Confirm');
					
					
					}

				})







	});	







