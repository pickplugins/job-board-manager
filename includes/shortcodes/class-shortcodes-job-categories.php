<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_job_bm_shortcodes_job_categories{
	
    public function __construct(){
		
		add_shortcode( 'job_bm_job_categories', array( $this, 'job_bm_job_categories' ) );

   		}

    public function job_bm_job_categories($atts, $content = null ) {



      $atts = shortcode_atts(
        array(
          'enable_thumb' => true,
          'enable_count' => true,
          'enable_link' => true,

          'max_count' => 10,
          'column_number' => 3,




          ),

        $atts
      );


      $atts = apply_filters('job_bm_job_categories_atts', $atts);


      $max_count = isset($atts['max_count']) ? $atts['max_count'] : 9;
      $enable_link = isset($atts['enable_link']) ? $atts['enable_link'] : true;
      $column_number = isset($atts['column_number']) ? $atts['column_number'] : 3;


        ob_start();



        do_action('job_bm_job_categories', $atts);


      $terms = get_terms( array(
        'taxonomy' => 'job_category',
        'hide_empty' => false,
        'number' => $max_count
      ) );

      ?>
      <div class="job-categories">

      <?php

      if(!empty($terms)){
        foreach ($terms as $term){

          $term_id = $term->term_id;

          $term_name = $term->name;
          $term_count = $term->count;
          $term_url = get_term_link($term_id);
          $term_thumb 	 		= get_term_meta($term_id,  'job_bm_thumb', true );
          $term_thumb_url	= wp_get_attachment_url( $term_thumb );

          //var_dump($term_id);

          ?>
          <div class="job-category">

            <?php if($enable_link): ?>

            <a href="<?php echo esc_url_raw($term_url); ?>">
            <?php endif; ?>


              <div class="job-category-thumb"><img src="<?php echo $term_thumb_url; ?>"> </div>
              <div class="job-category-title"><?php echo $term_name; ?></div>
              <div class="job-category-count">(<?php echo $term_count; ?>)</div>

            <?php if($enable_link): ?>

              </a>
            <?php endif; ?>

          </div>
          <?php


        }
      }


      ?>

      </div>


      <style type="text/css">

        .job-categories{
          columns: auto <?php echo $column_number; ?>;
          column-gap: 20px;
        }
        .job-category{
          padding: 15px 20px;
          margin-bottom: 20px;
          border: 1px solid #ddd;
        }
        .job-category-thumb{
          display: inline-block;
          width: 60px;
          vertical-align: middle;
          margin-right: 20px;
        }
        .job-category-title{
          display: inline-block;

        }
        .job-category-count{
          display: inline-block;

        }
      </style>

      <?php


        return ob_get_clean();
    }

}
	
	new class_job_bm_shortcodes_job_categories();