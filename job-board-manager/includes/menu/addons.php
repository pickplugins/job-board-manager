<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

wp_enqueue_style( 'job-bm-addons' );


$class_job_bm_support_help = new class_job_bm_support_help();
$addons_list = $class_job_bm_support_help->addons_list();

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div>
    <h2><?php echo __('Ready Add-ons','job-board-manager'); ?></h2>

    <div class="addon-list">

        <?php

        if(!empty($addons_list)):
            foreach ($addons_list as $addon):
                $addon_title = isset($addon['title']) ? $addon['title'] : '';
                $addon_link = isset($addon['item_link']) ? $addon['item_link'] : '';
                $addon_thumb = isset($addon['thumb']) ? $addon['thumb'] : '';
                $download_link = isset($addon['download']) ? $addon['download'] : '';


                ?>
                <div class="item">
                    <div class="thumb-wrap">
                        <img src="<?php echo $addon_thumb;?>">
                    </div>
                    <div class="addon-title"><?php echo $addon_title;?></div>
                    <div class="addon-link button"><a href="<?php echo $addon_link;?>"><?php echo __('Read more','job-board-manager'); ?></a> </div>

                    <?php if(!empty($download_link)): ?>
                    <div class="addon-link button"><a href="<?php echo $download_link;?>">Install</a> </div>
                    <?php endif; ?>
                </div>
            <?php
            endforeach;
        endif;

        ?>


    </div>


</div>
