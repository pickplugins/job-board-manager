jQuery(document).ready(function($)
	{


		$(document).on('click', '.reset-email-templates', function()
			{

				var is_confirm = $(this).attr('confirm');
				if(is_confirm=='ok'){
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:job_bm_ajax.job_bm_ajaxurl,
					data: {"action": "job_bm_ajax_reset_email_templates_data",},
					success: function(data)
							{	
								//alert(data);
								//$(this).html(data);
								//$(this).parent().parent().remove();
								//$('.see-phone-number .phone-number').html(data);
								location.reload(true);
							}
						});
					
					}
				else{
					$(this).attr('confirm','ok');
					$(this).val('Confirm');
					
					
					}

				})




		$(document).on('change', '.job-bm-meta .job_bm_salary_type', function()
			{
				var salary_type = $(this).val();
				//alert(salary_type);
				
				if(salary_type=='fixed'){
					
					$('.salary_fixed').fadeIn();
					$('.salary_min, .salary_max').fadeOut();
					
					}
				else if(salary_type=='min-max'){
					
					$('.salary_min, .salary_max').fadeIn();
					$('.salary_fixed').fadeOut();
					
					}
				else{
					$('.salary_fixed').fadeOut();
					$('.salary_min, .salary_max').fadeOut();
					}
				
			})






	});	







