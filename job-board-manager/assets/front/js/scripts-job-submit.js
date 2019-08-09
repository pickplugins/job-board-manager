jQuery(document).ready(function($) {


	$(document).on('change', '.job-bm-job-submit select[name="job_bm_salary_type"]', function(){



		var salary_type = $(this).val();
		//alert(salary_type);

		if(salary_type=='fixed'){

			$('.salary_fixed').fadeIn();
			$('.salary_min').fadeOut();
			$('.salary_max').fadeOut();


		}
		else if(salary_type=='min-max'){

			$('.salary_fixed').fadeOut();
			$('.salary_min').fadeIn();
			$('.salary_max').fadeIn();

		}
		else{
			$('.salary_fixed').fadeOut();
			$('.salary_min').fadeOut();
			$('.salary_max').fadeOut();

		}

	})









});







