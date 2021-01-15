<?php
/*
Plugin Name: blocks_ol
Description: Краткое описание плагина.
Version: 1.0
Author: Olha Tkachiv
*/
add_action( 'init', 'true_register_products' );

function true_register_products() {
	$labels = array(
		'name' => 'Blocks',
		'singular_name' => 'Block',
		'add_new' => 'Create',
		'add_new_item' => 'Create block',
		'edit_item' => 'edit block',
		'new_item' => 'New block',
		'all_items' => 'List blocks',
		'view_item' => 'View blocks on the site',
		'search_items' => 'Search blocks',
		'not_found' =>  'Blocks not found.',
		'not_found_in_trash' => 'There are no blocks in the basket.',
		'menu_name' => 'Blocks'
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
    'show_ui' => true,
    'show_ui_naw_menus' => true,
    'menu_icon' => 'dashicons-align-wide',
		'menu_position' => 5,
    'hierarchical' => true,
		'supports' => array( 'title', 'editor')
	);
	register_post_type( 'blocks_ol',$args);
}

//підключаємо функцію активації мета блоку
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
	add_meta_box( 'extra_fields', 'Status', 'extra_fields_box_func', 'blocks_ol', 'normal', 'high'  );
}

function extra_fields_box_func( $post ){
?>
	<p> <?php $mark_v = get_post_meta($post->ID, 'block_status', 1); ?>
		<label><input type="radio" name="extra[block_status]" value="1" <?php checked( $mark_v, '1' ); ?> />on  </label>
		<label><input type="radio" name="extra[block_status]" value="2" <?php checked( $mark_v, '2' ); ?> />off  </label>
	</p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

add_action('save_post', 'my_extra_fields_update', 0);

function my_extra_fields_update( $post_id ){
	if (
		   empty( $_POST['extra'] )
		|| ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
		|| wp_is_post_autosave( $post_id )
		|| wp_is_post_revision( $post_id )
	)
		return false;

	$_POST['extra'] = array_map( 'sanitize_text_field', $_POST['extra'] );
	foreach( $_POST['extra'] as $key => $value ){
		if( empty($value) ){
			delete_post_meta( $post_id, $key );
			continue;
		}

		update_post_meta( $post_id, $key, $value );
	}

	return $post_id;
}

add_filter('manage_blocks_ol_posts_columns', 'add_views_column', 4);
function add_views_column($columns)
{
    $num = 2;

    $new_columns = [
        'id' => 'ID',
        'status' => 'Status',
        'shortcode' => 'Shortcode',
    ];

    return array_slice($columns, 0, $num) + $new_columns + array_slice($columns, $num);
}

add_action('manage_blocks_ol_posts_custom_column', 'fill_views_column', 5, 2);
function fill_views_column($colname, $post_id)
{
    if ($colname === 'id') {
        echo $post_id;
    }

    if ($colname === 'status') {
        $get_status = get_post_meta( $post_id, 'block_status', true );
        if ( $get_status === '1' ) {
            $color = '#31E70F';
        } else {
            $color = '#828482';
        }
        echo '<span style="height: 25px; width: 25px; background-color:' . $color . '; border-radius: 50%; display: inline-block;"></span>';
    }

    if ($colname === 'shortcode') {
        echo '[blocks_ol id=' . $post_id . ']';
    }
}

add_shortcode( 'blocks_ol', 'blocks_ol_shortcode' );
function blocks_ol_shortcode( $atts ) {
  $get_status = get_post_meta( $atts['id'], 'block_status', true );
  if ( $get_status === '1' ){
    return get_the_content( null, null, $atts['id'] );
  } else {
    return false;
  }
}

//ховаємо швидке редагування - свойства
function hipwee_add_action_button($actions, $post){
  if(get_post_type() === 'blocks_ol'){
    unset($actions['inline hide-if-no-js']);
  }
  return $actions;
}
add_filter( 'page_row_actions', 'hipwee_add_action_button', 10, 2 );
?>
