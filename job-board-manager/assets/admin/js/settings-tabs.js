jQuery(document).ready(function($){



	$(document).on('click','.settings-tabs .tab-nav',function(){

		$(this).parent().parent().children('.tab-navs').children('.tab-nav').removeClass('active');

        $(this).addClass('active');

        id = $(this).attr('data-id');

		//console.log('Hello click');
        console.log(id);

        $(this).parent().parent().children('.tab-content').removeClass('active');

        $(this).parent().parent().children('.tab-content#'+id).addClass('active');


	})



    // $(document).on('click','.settings-tabs .media-upload',function(){
    //
    //     dataId = $(this).attr('data-id');
    //
    //
    //
    //     var send_attachment_bkp = wp.media.editor.send.attachment;
    //
    //     wp.media.editor.send.attachment = function(props, attachment) {
    //         $("#media_preview_"+dataId).attr("src", attachment.url);
    //         $("#media_input_"+dataId).val(attachment.id);
    //         wp.media.editor.send.attachment = send_attachment_bkp;
    //     }
    //     wp.media.editor.open($(this));
    //     return false;
    // });
    //
    // $("#media_clear_<?php echo $id; ?>").click(function() {
    //     $("#media_input_<?php echo $id; ?>").val("");
    //     $("#media_preview_<?php echo $id; ?>").attr("src","");
    // })



    $(document).on('click','.media-upload',function(e){
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

            $(this_).prev().val(attachmentId);

            $(this_).parent().children('.media-preview-wrap').children('img').attr('src',src_url);

        });

        //Open the uploader dialog
        side_uploader.open();

    })










	
 		

});