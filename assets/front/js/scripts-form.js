jQuery(document).ready(function($)
	{
		
        $('#job_bm_expire_date').datepicker({
            dateFormat : 'yy-mm-dd'
        });

		

		
		
		
		
		$(document).on('change', '.job-submit .job_bm_salary_type', function()
			{
				var salary_type = $(this).val();
				//alert(salary_type);
				
				if(salary_type=='fixed'){
					
					$('#job_bm_salary_fixed').parent().fadeIn();
					$('#job_bm_salary_min').parent().fadeOut();
					$('#job_bm_salary_max').parent().fadeOut();					
					
					
					}
				else if(salary_type=='min-max'){
					
					$('#job_bm_salary_min').parent().fadeIn();
					$(' #job_bm_salary_max').parent().fadeIn();					
					
					$('#job_bm_salary_fixed').parent().fadeOut();
					
					}
				else{
					$('#job_bm_salary_fixed').parent().fadeOut();
					$('#job_bm_salary_min').parent().fadeOut();
					$('#job_bm_salary_max').parent().fadeOut();					
					
					}
				
			})	
		




	});	







