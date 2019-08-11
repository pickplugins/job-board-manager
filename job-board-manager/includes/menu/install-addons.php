<?php
if ( ! defined('ABSPATH')) exit;  // if direct access
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div>
    <h2>Install add-ons</h2>

    <?php

    $pluginSlugs = array(
        'contact-form-7',
        'simple-cache',
        'codepress-admin-columns',
    );
    //require_once(dirname(__FILE__) . '/wp-load.php');
    require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/misc.php');
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
    /*
     * Hide the 'Activate Plugin' and other links when not using QuietSkin as these links will
     * fail when not called from /wp-admin
     */
    echo '<style>a {display: none;}</style>';
    class QuietSkin extends \WP_Upgrader_Skin
    {
        public function feedback($string) { /* no output */ }
    }
    /**
     * Download, install and activate a plugin
     *
     * If the plugin directory already exists, this will only try to activate the plugin
     *
     * @param string $slug The slug of the plugin (should be the same as the plugin's directory name
     */
    function sswInstallActivatePlugin($slug)
    {
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
    foreach ($pluginSlugs as $pluginSlug) {
        sswInstallActivatePlugin($pluginSlug);
    }

    ?>

</div>
