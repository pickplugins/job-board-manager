jQuery(document).ready(function($) {


		$(document).on('click', '.application-card .hired', function(){



				var job_id = $(this).attr('job-id');

				$.ajax(
					{
				type: 'POST',
				context: this,
				url:job_bm_ajax.job_bm_ajaxurl,
				data: {"action": "job_bm_ajax_delete_job_by_id", "job_id":job_id,},
				success: function(data)
						{
                            var data	= JSON.parse(data)
                            var html	= data['html'];
                            var is_deleted	= data['is_deleted'];
							//alert(data);
							$(this).html(html);

							if(is_deleted=='yes'){
                                $(this).parent().parent().fadeOut(2000);
							}

						}
					});


				}




			})

	});	







