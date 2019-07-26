<?php


add_action('post_submitbox_misc_actions','add_ap_wp_plugin_metabox');

function add_ap_wp_plugin_metabox($post = 0){
    global $post;
    if(!empty($post->ID))
        $myPost = get_post_meta($post->ID,'ap_wp_plugin_date',true);
    if(!empty($myPost))
    {
        $myText = "The post will be unpublished on ";
        $date = date("d.m.Y",strtotime($myPost));
    }
    else
    {
        $myText = "";
        $date = "Non-selected";
    }
    ?>
    <div id="misc-publishing-actions">
        <div class='misc-pub-section'>
            <span class='wp-media-buttons-icon dashicons dashicons-calendar' >
            </span>
            <span id='ap-wp-plugin-metafield'> AutoPost Editor:
            <?php echo $myText ?>
                </span>
                <b class="text-label"><?php echo $date ?></b>
            <br>
                <div class='ap-wp-plugin-metafield-date'></div>
                <a href='#' class='ap-wp-plugin-edit-button ap-button'>Edit</a>
                <a href='#' class='ap-wp-plugin-clear-button ap-button'>Clear</a>
                <div class='ap-wp-plugin-editor-field'>Select Date<br>
                    <input id='ap-wp-plugin-date-id' name='ap-wp-plugin-date' class='datepicker' placeholder='dd-mm-yyyy' value="<?php echo $date; ?>">
                    <div class='ap-wp-plugin-editor-field-button button'>OK</div>
                </div>
            </br>
        </div>
    </div>
<?php
}
add_action('save_post','save_ap_wp_plugin_metabox');

function save_ap_wp_plugin_metabox($postID = 0){
    $newAutoDate = !empty($_POST['ap-wp-plugin-date']) && strcmp($_POST['ap-wp-plugin-date'],"Non-selected") ? sanitize_text_field($_POST['ap-wp-plugin-date']) : false;
    if(!strcmp($_POST['ap-wp-plugin-date'],"Non-selected"))
    {
        delete_post_meta($postID,'ap_wp_plugin_date');
    }
    if($newAutoDate)
    {
        update_post_meta($postID,'ap_wp_plugin_date',$newAutoDate);
    }
    else
    {
        if(get_post_meta($postID,'ap_wp_plugin_date',true))
            update_post_meta($postID,'ap_wp_plugin_date',get_post_meta($postID,'ap_wp_plugin_date',true));
        else
            delete_post_meta($postID,'ap_wp_plugin_date');
    }
}

?>