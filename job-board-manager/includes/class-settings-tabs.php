<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

if( ! class_exists( 'settings_tabs_field' ) ) {
class settings_tabs_field{


    function field_template(){

        ob_start();

        ?>
        <div class="setting-field">
            <div class="field-lable">%s</div>
            <div class="field-input">%s
                <p class="description">%s</p>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }


    function generate_field($option){

        $id 		= isset( $option['id'] ) ? $option['id'] : "";
        $type 		= isset( $option['type'] ) ? $option['type'] : "";
        $details 	= isset( $option['details'] ) ? $option['details'] : "";






        if( empty( $id ) ) return;

        if( isset($option['type']) && $option['type'] === 'select' ) 		    $this->field_select( $option );
        elseif( isset($option['type']) && $option['type'] === 'select2')	    $this->field_select2( $option );
        elseif( isset($option['type']) && $option['type'] === 'checkbox')	    $this->field_checkbox( $option );
        elseif( isset($option['type']) && $option['type'] === 'radio')		    $this->field_radio( $option );
        elseif( isset($option['type']) && $option['type'] === 'radio_image')	$this->field_radio_image( $option );
        elseif( isset($option['type']) && $option['type'] === 'textarea')	    $this->field_textarea( $option );
        elseif( isset($option['type']) && $option['type'] === 'scripts_js')	    $this->field_scripts_js( $option );
        elseif( isset($option['type']) && $option['type'] === 'scripts_css')	$this->field_scripts_css( $option );
        elseif( isset($option['type']) && $option['type'] === 'number' ) 	    $this->field_number( $option );
        elseif( isset($option['type']) && $option['type'] === 'text' ) 		    $this->field_text( $option );
        elseif( isset($option['type']) && $option['type'] === 'text_icon' )     $this->field_text_icon( $option );
        elseif( isset($option['type']) && $option['type'] === 'text_multi' ) 	$this->field_text_multi( $option );
        elseif( isset($option['type']) && $option['type'] === 'range' ) 		$this->field_range( $option );
        elseif( isset($option['type']) && $option['type'] === 'colorpicker')    $this->field_colorpicker( $option );
        elseif( isset($option['type']) && $option['type'] === 'datepicker')	    $this->field_datepicker( $option );
        //elseif( isset($option['type']) && $option['type'] === 'repeater')	    $this->field_repeater( $option );
        elseif( isset($option['type']) && $option['type'] === 'faq')	        $this->field_faq( $option );
        elseif( isset($option['type']) && $option['type'] === 'addons_grid')	$this->field_addons_grid( $option );
        elseif( isset($option['type']) && $option['type'] === 'custom_html')	$this->field_custom_html( $option );
        elseif( isset($option['type']) && $option['type'] === 'repeatable')	    $this->field_repeatable( $option );
        elseif( isset($option['type']) && $option['type'] === 'media')	        $this->field_media( $option );




        elseif( isset($option['type']) && $option['type'] === $type ) 	do_action( "settings_tabs_field_$type", $option );


        //if( !empty( $details ) ) echo "<p class='description'>$details</p>";





    }




    public function field_media( $option ){



        $id			= isset( $option['id'] ) ? $option['id'] : "";
        if(empty($id)) return;
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $field_name 	= isset( $option['field_name'] ) ? $option['field_name'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $placeholder	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $default			= isset( $option['default'] ) ? $option['default'] : '';
        $value			= isset( $option['value'] ) ? $option['value'] : '';
        $value          = !empty($value) ?  $value : $default;

        $media_url	= wp_get_attachment_url( $value );
        $media_type	= get_post_mime_type( $value );
        $media_title= get_the_title( $value );
        $media_url = !empty($media_url) ? $media_url : $placeholder;

        $field_name     = !empty( $field_name ) ? $field_name : $id;
        $field_name = !empty($parent) ? $parent.'['.$field_name.']' : $field_name;



        ob_start();
        //wp_enqueue_media();

        ?>
        <div id="field-wrapper-<?php echo $css_id; ?>" class="field-wrapper field-media-wrapper
            field-media-wrapper-<?php echo $css_id; ?>">
            <div class="media-preview-wrap" style="width: 150px;margin-bottom: 10px;background: #eee;padding: 5px;    text-align: center;">
                <?php

                if( "audio/mpeg" == $media_type ){
                    ?>
                    <div class="media-preview" class="dashicons dashicons-format-audio" style="font-size: 70px;display: inline;"></div>
                    <div><?php echo $media_title; ?></div>
                    <?php
                }
                else {
                    ?>
                    <img class="media-preview" src="<?php echo $media_url; ?>" style="width:100%"/>
                    <?php
                }
                ?>
            </div>
            <input type="hidden" name="<?php echo $field_name; ?>" id="media_input_<?php echo $css_id; ?>" value="<?php echo $value; ?>" />
            <div class="media-upload button" id="media_upload_<?php echo $css_id; ?>"><?php echo __('Upload','pickplugins-options-framework');?></div>
            <div class="clear button" id="media_clear_<?php echo $css_id; ?>"><?php echo __('Clear','pickplugins-options-framework');?></div>
            <div class="error-mgs"></div>
        </div>

        <?php


        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }






    public function field_repeatable( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        if(empty($id)) return;
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_name 	= isset( $option['field_name'] ) ? $option['field_name'] : $id;
        $field_name     = !empty( $parent ) ? $parent.'['.$field_name.']' : $field_name;

        $sortable 	    = isset( $option['sortable'] ) ? $option['sortable'] : true;
        $collapsible 	= isset( $option['collapsible'] ) ? $option['collapsible'] : true;
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $values			= isset( $option['value'] ) ? $option['value'] : array();
        $fields 		= isset( $option['fields'] ) ? $option['fields'] : array();
        $title_field 	= isset( $option['title_field'] ) ? $option['title_field'] : '';
        $remove_text 	= isset( $option['remove_text'] ) ? $option['remove_text'] : '<i class="fas fa-times"></i>';
        $limit 	        = isset( $option['limit'] ) ? $option['limit'] : '';



        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $settings_tabs_field = new settings_tabs_field();

        ob_start();
        ?>
        <script>
            jQuery(document).ready(function($) {
                jQuery(document).on("click", ".field-repeatable-wrapper-<?php echo $css_id; ?> .collapsible .header .title-text", function() {
                    if(jQuery(this).parent().parent().hasClass("active")){
                        jQuery(this).parent().parent().removeClass("active");
                    }else{
                        jQuery(this).parent().parent().addClass("active");
                    }
                })

                jQuery(document).on("click", ".field-repeatable-wrapper-<?php echo $css_id; ?> .add-item", function() {
                    now = jQuery.now();
                    fields_arr = <?php echo json_encode($fields); ?>;
                    html = '<div class="item-wrap collapsible"><div class="header"><span class="button remove" ' +
                        'onclick="jQuery(this).parent().parent().remove()"><?php echo $remove_text; ?></span> ';
                    <?php if($sortable):?>
                    html += '<span class="button sort" ><i class="fas fa-arrows-alt"></i></span>';
                    <?php endif; ?>
                    html += ' <span  class="title-text">#'+now+'</span></div>';

                    <?php

                    $fieldHtml = '';

                        if(!empty($fields)):
                            foreach ($fields as $field):

                                $fieldType = isset($field['type']) ? $field['type'] : '';
                                $field['parent'] = $field_name.'[TIMEINDEX]';

                                ob_start();
                                ?>
                                <div class="item">
                                    <?php if($collapsible):?>
                                        <div class="content">
                                    <?php endif; ?>

                                    <?php
                                    $settings_tabs_field->generate_field($field);
                                    ?>
                                    <?php if($collapsible):?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <?php
                                $fieldHtml .= ob_get_clean();
                            endforeach;
                        endif;


                    $string = str_replace("\n", "", $fieldHtml);
                    $fieldHtml = str_replace("\r", "", $string);


                    ?>

                    fieldHtml = '<?php echo $fieldHtml; ?>';
                    html+= fieldHtml.replace(/TIMEINDEX/g, now);
                    html+='</div>';

                    <?php
                    if(!empty($limit)):
                    ?>
                    var limit = <?php  echo $limit; ?>;
                    var node_count = $( ".field-repeatable-wrapper-<?php echo $css_id; ?> .field-list .item-wrap" ).size();
                    if(limit > node_count){
                        jQuery('.<?php echo 'field-repeatable-wrapper-'.$css_id; ?> .field-list').append(html);
                    }else{
                        jQuery('.field-repeatable-wrapper-<?php echo $css_id; ?> .error-mgs').html('Sorry! you can add max '+limit+' item').stop().fadeIn(400).delay(3000).fadeOut(400);
                    }

                    <?php
                    else:
                    ?>
                    jQuery('.<?php echo 'field-repeatable-wrapper-'.$css_id; ?> .field-list').append(html);
                    <?php
                    endif;
                    ?>
                })
                jQuery( ".field-repeatable-wrapper-<?php echo $css_id; ?> .field-list" ).sortable({ handle: '.sort' });
            });
        </script>
        <div id="field-wrapper-<?php echo $css_id; ?>" class=" field-wrapper field-repeatable-wrapper
            field-repeatable-wrapper-<?php echo $css_id; ?>">
            <div class="add-item button"><?php _e('Add','pickplugins-options-framework'); ?></div>
            <div class="field-list" id="<?php echo $css_id; ?>">
                <?php
                if(!empty($values)):
                    $count = 1;
                    foreach ($values as $index=>$val):
                        $title_field_val = !empty($val[$title_field]) ? $val[$title_field] : '#'.$count;
                        ?>
                        <div class="item-wrap <?php if($collapsible) echo 'collapsible'; ?>">
                            <?php if($collapsible):?>
                            <div class="header">
                                <?php endif; ?>
                                <span class="button remove" onclick="jQuery(this).parent().parent().remove()"><?php echo $remove_text; ?></span>
                                <!--                                    <span index_id="--><?php //echo $index; ?><!--" class="button clone"><i class="far fa-clone"></i></span>-->
                                <?php if($sortable):?>
                                    <span class="button sort"><i class="fas fa-arrows-alt"></i></span>
                                <?php endif; ?>
                                <span class="title-text"><?php echo $title_field_val; ?></span>
                                <?php if($collapsible):?>
                            </div>
                        <?php endif; ?>
                            <?php



                            foreach ($fields as $field_index => $field):
                                $fieldId = $field['id'];

                                $title_field_class = ($title_field == $field_index) ? 'title-field':'';
                                ?>
                                <div class="item <?php echo $title_field_class; ?>">
                                    <?php if($collapsible):?>
                                    <div class="content">
                                        <?php endif; ?>

                                        <?php
                                        $field['parent'] = $field_name.'['.$index.']';
                                        $field['value'] = isset($val[$fieldId]) ? $val[$fieldId] : '';

                                        $settings_tabs_field->generate_field($field);


                                        if($collapsible):?>
                                    </div>
                                <?php endif; ?>
                                </div>
                            <?php

                            endforeach; ?>
                        </div>
                        <?php
                        $count++;
                    endforeach;
                else:
                    ?>
                <?php
                endif;
                ?>
            </div>
            <div class="error-mgs"></div>
        </div>

        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);



    }








    public function field_select( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : array();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : false;
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();




        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        if($multiple){
            $value 	= isset( $option['value'] ) ? $option['value'] : array();
            $field_name = !empty($parent) ? $parent.'['.$id.'][]' : $id.'[]';
            $default 	= isset( $option['default'] ) ? $option['default'] : array();
        }else{
            $value 	= isset( $option['value'] ) ? $option['value'] : '';
            $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;
            $default 	= isset( $option['default'] ) ? $option['default'] : '';
        }


        $value = !empty($value) ? $value : $default;




        ob_start();
        ?>
        <select <?php if($multiple) echo 'multiple'; ?> name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>">
            <?php
            foreach( $args as $key => $name ):
                if($multiple){
                    $selected = in_array($key, $value) ? "selected" : "";
                }else{
                    $selected = $value == $key ? "selected" : "";
                }


                ?>
                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $name; ?></option>
            <?php
            endforeach;
            ?>
        </select>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);


    }

    public function field_select2( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : array();
        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();

        if($multiple){
            $value 	= isset( $option['value'] ) ? $option['value'] : array();
            $field_name = !empty($parent) ? $parent.'['.$id.'][]' : $id.'[]';
            $default 	= isset( $option['default'] ) ? $option['default'] : array();
        }else{
            $value 	= isset( $option['value'] ) ? $option['value'] : '';
            $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;
            $default 	= isset( $option['default'] ) ? $option['default'] : '';
        }

        $value = !empty($value) ? $value : $default;

        //$value	= get_post_meta( $post_id, $id, true );
        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        ob_start();
        ?>
        <select class="select2" <?php if($multiple) echo 'multiple'; ?>  name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>">
            <?php
            foreach( $args as $key => $name ):

                if($multiple){
                    $selected = in_array($key, $value) ? "selected" : "";
                }else{
                    $selected = ($key == $value) ? "selected" : "";
                }

                ?>
                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $name; ?></option>
            <?php
            endforeach;
            ?>
        </select>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);





    }










    public function field_text( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();


        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <input type="text" class="" name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo $value; ?>" />
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }




    public function field_text_icon( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $option_value = empty($value) ? $default : $value;

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;




        ob_start();
        ?>
        <div class="text-icon">
            <span class="icon"><i class="<?php echo $option_value; ?>"></i></span><input type="text" class="" name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo $option_value; ?>" />
        </div>
        <style type="text/css">
            .text-icon{}
            .text-icon .icon{
                /* width: 30px; */
                background: #ddd;
                /* height: 28px; */
                display: inline-block;
                vertical-align: top;
                text-align: center;
                font-size: 14px;
                padding: 5px 10px;
                line-height: normal;
            }
        </style>
        <script>
            jQuery(document).ready(function($){
                $(document).on("keyup", ".text-icon input", function () {
                    val = $(this).val();
                    if(val){
                        $(this).parent().children(".icon").html('<i class="'+val+'"></i>');
                    }
                })
            })
        </script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }



    public function field_range( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();

        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $args 	= isset( $option['args'] ) ? $option['args'] : "";

        $min = isset($args['min']) ? $args['min'] : '';
        $max = isset($args['max']) ? $args['max'] : '';
        $step = isset($args['step']) ? $args['step'] : '';

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <div class="range-input">
            <span class="range-value"><?php echo $value; ?></span><input type="range" min="<?php if($min) echo $min; ?>" max="<?php if($max) echo $max; ?>" step="<?php if($step) echo $step; ?>" class="" name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" value="<?php echo $value; ?>" />
        </div>

        <script>
            jQuery(document).ready(function($){
                $(document).on("change", "#<?php echo $css_id; ?>", function () {
                    val = $(this).val();
                    if(val){
                        $(this).parent().children(".range-value").html(val);
                    }
                })
            })
        </script>

        <style type="text/css">
            .range-input{}
            .range-input .range-value{
                display: inline-block;
                vertical-align: top;
                margin: 0 0;
                padding: 4px 10px;
                background: #eee;
            }
        </style>
        <?php

        $input_html = ob_get_clean();
        echo sprintf($field_template, $title, $input_html, $details);
    }



    public function field_textarea( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <textarea name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" cols="40" rows="5" placeholder="<?php echo $placeholder; ?>"><?php echo $value; ?></textarea>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);






    }



    public function field_scripts_js( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;


        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();
        ?>
        <textarea name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" cols="40" rows="5" placeholder="<?php echo $placeholder; ?>"><?php echo $value; ?></textarea>

        <script>
            var editor = CodeMirror.fromTextArea(document.getElementById("<?php echo $css_id; ?>"), {
                lineNumbers: true,
            });

        </script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);




    }


    public function field_scripts_css( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";

        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 		= isset( $option['details'] ) ? $option['details'] : "";



        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;
        ?>

        <?php

        ob_start();
        ?>
        <textarea name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" cols="40" rows="5" placeholder="<?php echo $placeholder; ?>"><?php echo $value; ?></textarea>
        <script>

            var editor = CodeMirror.fromTextArea(document.getElementById("<?php echo $css_id; ?>"), {
                lineNumbers: true,
                value: "",
                viewportMargin: Infinity,

                //scrollbarStyle: "simple"
            });



        </script>

        <style type="text/css">
            .CodeMirror {
                min-height:80px;
            }

        </style>

        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);

    }







    public function field_radio( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 		= isset( $option['details'] ) ? $option['details'] : "";
        $for 		= isset( $option['for'] ) ? $option['for'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();

        $option_value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $option_value = !empty($option_value) ? $option_value : $default;

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;


        ob_start();

        if(!empty($args))
            foreach( $args as $key => $value ):
                $checked = ( $key == $option_value ) ? "checked" : "";
                $for = !empty($for) ? $for.'-'.$css_id."-".$key : $css_id."-".$key;
                ?>
                <label for="<?php echo $for;?>"><input name="<?php echo $field_name; ?>" type="radio" id="<?php echo $for; ?>" value="<?php echo $key;?>"  <?php echo $checked;?>><span><?php echo $value;?></span></label>

                <?php
            endforeach;

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);


    }



    public function field_radio_image( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        //$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";
        $width 			= isset( $option['width'] ) ? $option['width'] : "250px";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;

        //var_dump($option_value);

        $option_value = empty($option_value) ? $default : $option_value;



        ob_start();
        ?>
        <div class="radio-img">
            <?php
            foreach( $args as $key => $value ):

                $name = $value['name'];
                $thumb = $value['thumb'];


                $checked = ($key == $option_value) ? "checked" : "";

                //var_dump($checked);

                ?>
                <label title="<?php echo $name; ?>" class="<?php if($checked =='checked') echo 'active';?>">
                    <input name="<?php echo $field_name; ?>" type="radio" id="<?php echo $css_id; ?>-<?php echo $key; ?>" value="<?php echo $key; ?>"  <?php echo $checked; ?>>
                    <?php // echo $name; ?>
                    <img alt="<?php echo $name; ?>" src="<?php echo $thumb; ?>">
                </label>
            <?php

            endforeach;
            ?>
        </div>
        <script>
            jQuery(document).ready(function($){
                $(document).on("click", ".radio-img label", function () {
                    $(this).parent().children("label").removeClass("active");
                    $(this).addClass("active");
                })
            })
        </script>

        <style type="text/css">
            .radio-img{}
            .radio-img label{
                display: inline-block;
                vertical-align: top;
                margin: 5px;
                padding: 2px;
                background: #eee;
            }

            .radio-img label.active{
                background: #fd730d;
            }

            .radio-img input[type=radio]{
                display: none;
            }
            .radio-img img{
                width: <?php echo $width; ?>;
                vertical-align: top;
            }

        </style>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);


    }





    public function field_colorpicker( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";

        $value 	= isset( $option['value'] ) ? $option['value'] : '';
        $default 	= isset( $option['default'] ) ? $option['default'] : '';
        $value = !empty($value) ? $value : $default;

        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";

        $field_name = !empty($parent) ? $parent.'['.$id.']' : $id;




        ob_start();
        ?>
        <input name="<?php echo $field_name; ?>" id="<?php echo $css_id; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo $value; ?>" />
        <script>jQuery(document).ready(function($) { $("#<?php echo $css_id; ?>").wpColorPicker();});</script>
        <?php

        $input_html = ob_get_clean();

        echo sprintf($field_template, $title, $input_html, $details);
    }



    public function field_custom_html( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $css_id 			= isset( $option['css_id'] ) ? $option['css_id'] : $id;
        $parent 			= isset( $option['parent'] ) ? $option['parent'] : "";
        $field_template 	= isset( $option['field_template'] ) ? $option['field_template'] : $this->field_template();
        $html 	= isset( $option['html'] ) ? $option['html'] : "";


        $title			= isset( $option['title'] ) ? $option['title'] : "";
        $details 			= isset( $option['details'] ) ? $option['details'] : "";


        echo sprintf($field_template, $title, $html, $details);







    }



}}