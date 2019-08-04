<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

wp_enqueue_style( 'job-bm-addons' );


$class_job_bm_support_help = new class_job_bm_support_help();
$addons_list = $class_job_bm_support_help->addons_list();

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div>
    <h2>Ready Add-ons</h2>

    <div class="addon-list">

        <?php

        if(!empty($addons_list)):
            foreach ($addons_list as $addon):
                $addon_title = $addon['title'];
                $addon_link = $addon['item_link'];
                $addon_thumb = $addon['thumb'];

                ?>
                <div class="item">
                    <div class="thumb-wrap">
                        <img src="<?php echo $addon_thumb;?>">
                    </div>
                    <div class="addon-title"><?php echo $addon_title;?></div>
                    <div class="addon-link button"><a href="<?php echo $addon_link;?>">Download</a> </div>
                </div>
            <?php
            endforeach;
        endif;

        ?>


    </div>


</div>
