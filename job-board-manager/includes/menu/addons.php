<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access

wp_enqueue_style( 'job-bm-addons' );
wp_enqueue_style( 'font-awesome-5' );

$active_plugins = get_option('active_plugins');

$class_job_bm_support_help = new class_job_bm_support_help();
$addons_list = $class_job_bm_support_help->addons_list();

$install_slug = isset($_GET['install_slug']) ? sanitize_text_field($_GET['install_slug']) : '';

//var_dump($install_slug);

?>
<div class="wrap">
    <h2><?php echo __('Ready Add-ons','job-board-manager'); ?></h2>


    <?php

    if(!empty($install_slug) && current_user_can('manage_options')):

        require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/misc.php');
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

        function job_bm_insatll_addons($slug){
            $pluginDir = WP_PLUGIN_DIR . '/' . $slug;
            /*
             * Don't try installing plugins that already exist (wastes time downloading files that
             * won't be used
             */
            if (!is_dir($pluginDir)) {
                $api = plugins_api(
                    'plugin_information',
                    array(
                        'slug' => $slug,
                        'fields' => array(
                            'short_description' => false,
                            'sections' => false,
                            'requires' => false,
                            'rating' => false,
                            'ratings' => false,
                            'downloaded' => false,
                            'last_updated' => false,
                            'added' => false,
                            'tags' => false,
                            'compatibility' => false,
                            'homepage' => false,
                            'donate_link' => false,
                        ),
                    )
                );

                // Replace with new QuietSkin for no output
                $skin = new Plugin_Installer_Skin(array('api' => $api));
                $upgrader = new Plugin_Upgrader($skin);
                $install = $upgrader->install($api->download_link);
                if ($install !== true) {
                    echo 'Error: Install process failed (' . $slug . '). var_dump of result follows.<br>'
                        . "\n";
                    var_dump($install); // can be 'null' or WP_Error
                }
            }
            /*
             * The install results don't indicate what the main plugin file is, so we just try to
             * activate based on the slug. It may fail, in which case the plugin will have to be activated
             * manually from the admin screen.
             */
            $pluginPath = $pluginDir . '/' . $slug . '.php';
            if (file_exists($pluginPath)) {
                activate_plugin($pluginPath);
            } else {
                echo 'Error: Plugin file not activated (' . $slug . '). This probably means the main '
                    . 'file\'s name does not match the slug. Check the plugins listing in wp-admin.<br>'
                    . "\n";
            }
        }



        ?>
        <div class="install-addon">

            <?php

            job_bm_insatll_addons($install_slug);

            ?>
        </div>
        <?php
    endif;

    ?>





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
                        <?php
                        if(in_array( $wp_org_slug.'/'.$wp_org_slug.'.php', (array) $active_plugins )){
                            ?>
                            <div class="addon-link button"><a href="#"><i class="fas fa-check"></i> Installed</a> </div>
                            <?php

                        }else{
                            ?>
                            <div class="addon-link button"><a href="<?php echo admin_url().'edit.php?post_type=job&page=job_bm_addons&install_slug='.$wp_org_slug;?>"><i class="fab fa-wordpress"></i> Install</a> </div>

                            <?php
                        }

                        ?>
                    <?php

                    else:
                        ?>
                        <div class="addon-link button"><a href="<?php echo $item_link;?>"> Buy to download</a> </div>

                    <?php

                    endif; ?>

                </div>
            <?php
            endforeach;
        endif;

        ?>


    </div>


</div>
