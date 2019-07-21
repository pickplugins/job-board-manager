<?php	
if ( ! defined('ABSPATH')) exit;  // if direct access



$testimonial_settings_tab = array();


$testimonial_settings_tab[] = array(
    'id' => 'general',
    'title' => __('<i class="fas fa-laptop-code"></i> General','testimonial'),
    'priority' => 1,
    'active' => true,
);

$testimonial_settings_tab[] = array(
    'id' => 'pages',
    'title' => __('<i class="fas fa-palette"></i> Pages','testimonial'),
    'priority' => 2,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'job_post',
    'title' => __('<i class="fas fa-qrcode"></i> Job Post','testimonial'),
    'priority' => 2,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'notification',
    'title' => __('<i class="fas fa-map"></i> Notification','testimonial'),
    'priority' => 3,
    'active' => false,
);

$testimonial_settings_tab[] = array(
    'id' => 'style',
    'title' => __('<i class="fas fa-map"></i> Style','testimonial'),
    'priority' => 3,
    'active' => false,
);


$testimonial_settings_tabs = apply_filters('job_bm_settings_tabs', $testimonial_settings_tab);


$tabs_sorted = array();
foreach ($testimonial_settings_tabs as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
array_multisort($tabs_sorted, SORT_ASC, $testimonial_settings_tabs);
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(job_bm_plugin_name.' Settings', 'job-board-manager')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	        <input type="hidden" name="job_bm_hidden" value="Y">

            <div class="settings-tabs vertical">
                <ul class="tab-navs">
                    <?php
                    foreach ($testimonial_settings_tabs as $tab){
                        $id = $tab['id'];
                        $title = $tab['title'];
                        $active = $tab['active'];
                        $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                        $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                        ?>
                        <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo $data_visible; ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo $id; ?>"><?php echo $title; ?></li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                foreach ($testimonial_settings_tabs as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];


                    ?>

                    <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo $id; ?>">
                        <?php
                        do_action('job_bm_settings_tabs_content_'.$id, $tab);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="clear clearfix"></div>



            <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','job-board-manager' ); ?>" />
            </p>
		</form>


</div>
