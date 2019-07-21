jQuery(document).ready(function($) {

	$(document).on('click','.job-bm-job-submit .media-upload',function(e){
		var side_uploader;
		this_ = $(this);
		//alert(target_input);
		e.preventDefault();
		//If the uploader object has already been created, reopen the dialog
		if (side_uploader) {
			side_uploader.open();
			return;
		}
		//Extend the wp.media object
		side_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		//When a file is selected, grab the URL and set it as the text field's value
		side_uploader.on('select', function() {
			attachment = side_uploader.state().get('selection').first().toJSON();

			attachmentId = attachment.id;
			src_url = attachment.url;
			//console.log(attachment);

			$(this_).prev().val(src_url);

			$(this_).parent().children('.media-preview-wrap').children('img').attr('src',src_url);

		});

		//Open the uploader dialog
		side_uploader.open();

	})


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







