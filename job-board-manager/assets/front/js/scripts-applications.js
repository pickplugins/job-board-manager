jQuery(document).ready(function($) {


		$(document).on('click', '.application-card .hire', function(){

			var application_id = $(this).attr('application-id');

			$(this).html('<i class="fas fa-spinner fa-spin"></i>');

			console.log(application_id);

			$.ajax(
				{
			type: 'POST',
			context: this,
			url:job_bm_ajax.job_bm_ajaxurl,
			data: {"action": "job_bm_ajax_application_marked_hired", "application_id":application_id,},
			success: function(data)
					{
						var data	= JSON.parse(data)
						var hired	= data['hired'];

						if(hired =='no'){

							$(this).removeClass('hired');
						}else{
							$(this).addClass('hired');
						}

						$(this).html('<i class="fas fa-medal"></i>');
					}
				});
		})


	$(document).on('click', '.application-card .trash', function(){

		var application_id = $(this).attr('application-id');

		$(this).html('<i class="fas fa-spinner fa-spin"></i>');

		console.log(application_id);

		$.ajax(
			{
				type: 'POST',
				context: this,
				url:job_bm_ajax.job_bm_ajaxurl,
				data: {"action": "job_bm_ajax_application_marked_trash", "application_id":application_id,},
				success: function(data)
				{
					var data	= JSON.parse(data)
					var trash	= data['trash'];

					if(trash =='no'){

						$(this).removeClass('trashed');
						$(this).fadeIn();
					}else{
						$(this).addClass('trashed');
						$(this).parent().parent().parent().fadeOut();
					}

					$(this).html('<i class="far fa-trash-alt"></i>');
				}
			});
	})







	$(document).on('mouseover','.star i',function(){

		data_count = $(this).attr('data-count');

		$(this).parent().attr('title','Click to rate');

		$(this).parent().children('i').each(function(index,element){

			if($(this).hasClass('fas')){
				$(this).removeClass('fas');
				$(this).addClass('far');

				if($(this).hasClass('fa-star-half-alt')){
					$(this).removeClass('fa-star-half-alt');
					$(this).addClass('fa-star');
				}



			}

			if( index < data_count){
				$(this).removeClass('far');
				$(this).addClass('fas');
			}


		})


	})



	$(document).on('mouseout','.star i',function(){

		current_rate = $(this).parent().attr('current-rate');
		current_rate_int = Math.floor(current_rate);
		current_rate_mod = (current_rate - current_rate_int);
		current_rate_mod = current_rate_mod.toFixed(2);

		console.log(current_rate_mod);
		console.log(current_rate_int);

		$(this).parent().children('i').each(function(index,element){
			console.log(index);


			if($(this).hasClass('fas')){
				$(this).removeClass('fas');
				$(this).addClass('far');

			}

			if(index == (current_rate_int) && current_rate_mod > 0.5){
				//$(this).addClass('fa-star-half-alt');

			}



			if( index < current_rate_int){
				$(this).removeClass('far');
				$(this).addClass('fas');
			}




		})


	})







	$(document).on('click','.star i',function(){
		data_count = $(this).attr('data-count');
		application_id = $(this).parent().attr('application_id');

		_this = this;

		$('.rating-text').html('<i class="fas fa-spin fa-spinner"></i>');

		$.ajax({
			type: 'POST',
			context: _this,
			url:job_bm_ajax.job_bm_ajaxurl,
			data: {
				"action" 		: "job_bm_ajax_application_rate",
				//"wpblockhub_ajax_nonce"	: wpblockhubadmin_ajax.ajax_nonce,
				"application_id" 		: application_id,
				"data_count" 		: data_count,
			},
			success: function( response ) {
				var data = JSON.parse( response );
				html = data['html'];
				star_rate = data['star_rate'];

				current_rate_int = Math.floor(star_rate);

				//console.log(data);

				$(_this).parent().attr('current-rate',star_rate);


				$(this).parent().children('i').each(function(index,element){
					console.log(index);


					if($(this).hasClass('fas')){
						$(this).removeClass('fas');
						$(this).addClass('far');

					}

					if( index < current_rate_int){
						$(this).removeClass('far');
						$(this).addClass('fas');
					}




				})







			}
		});



	})

















	});	







