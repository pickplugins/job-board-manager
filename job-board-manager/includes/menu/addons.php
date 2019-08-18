<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

wp_enqueue_style( 'job-bm-addons' );


$class_job_bm_support_help = new class_job_bm_support_help();
$addons_list = $class_job_bm_support_help->addons_list();

$install_slug = isset($_GET['install_slug']) ? sanitize_text_field($_GET['install_slug']) : '';

var_dump($install_slug);

?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div>
    <h2><?php echo __('Ready Add-ons','job-board-manager'); ?></h2>





    <div class="addon-list">

        <?php

        if(!empty($addons_list)):
            foreach ($addons_list as $addon):
                $addon_title = isset($addon['title']) ? $addon['title'] : '';
                $item_link = isset($addon['item_link']) ? $addon['item_link'] : '';
                $addon_thumb = isset($addon['thumb']) ? $addon['thumb'] : '';
                $zip_link = isset($addon['zip_link']) ? $addon['zip_link'] : '';
                $wp_org_slug = isset($addon['wp_org_slug']) ? $addon['wp_org_slug'] : '';


                ?>
                <div class="item">
                    <div class="thumb-wrap">
                        <a href="<?php echo $item_link;?>"><img src="<?php echo $addon_thumb;?>"></a>
                    </div>
                    <div class="addon-title"><a class="addon-link" href="<?php echo $item_link;?>"><?php echo $addon_title;?></a></div>
                    <?php if(!empty($zip_link)): ?>
                    <div class="addon-link button"><a href="<?php echo $zip_link;?>">Download</a> </div>
                    <?php endif; ?>

                    <?php if(!empty($wp_org_slug)): ?>
                        <div class="addon-link button"><a href="<?php echo admin_url().'edit.php?post_type=job&page=job_bm_addons&install_slug='.$wp_org_slug;?>">Install</a> </div>
                    <?php endif; ?>

                </div>
            <?php
            endforeach;
        endif;

        ?>


    </div>


</div>
