<?php
add_action('init','calc_new_date');
function calc_new_date()
{
	$queryArgs = array(
		'meta_query' => array(
			array(
				'key' => 'ap_wp_plugin_date'
			)
		),
		'post_status' => 'any'
	);

	$items = get_posts($queryArgs);
	if(!empty($items))

		forEach($items as $item)
		{

			if(isReadyToUnpublished($item->ID))
			{
				$item->post_status = 'private';
				$item->post_date = ((int)substr($item->post_date,0,4)+1).substr($item->post_date,4);
				wp_update_post($item);
				$newPostMeta = get_post_meta($item->ID,'ap_wp_plugin_date',true);
				$newPostMeta = substr($newPostMeta,0,6).((int)substr($newPostMeta,-4) + 1);
				update_post_meta($item->ID, 'ap_wp_plugin_date',$newPostMeta);
			}
			elseif(current_time('timestamp') >= strtotime($item->post_date, current_time('timestamp')))
			{
				$item->post_status = 'publish';
				wp_update_post($item);
			}
		}
}

function isReadyToUnpublished($post_ID = 0)
{
	$currentTime = current_time('timestamp');
	$unpublishedTime = strtotime(get_post_meta($post_ID,'ap_wp_plugin_date', true),current_time('timestamp'));

	return $currentTime >= $unpublishedTime;
}