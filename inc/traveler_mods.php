<?php
if ( ! function_exists( 'st_location_list_hotel_func' ) ) {
	function st_location_list_hotel_func( $attr ) {
		global $st_search_args;
		$data = shortcode_atts(
			array(
				'st_location_style'   => "",
				'st_location_num'     => "",
				'st_location_orderby' => "",
				'st_location_order'   => "",
				'st_location'         => get_the_ID()
			), $attr, 'st_location_list_hotel' );
		extract( $data );
		$st_search_args = $data;
		$hotel          = STHotel::inst();

		add_action( 'posts_where', [ $hotel, '_get_where_query' ] );
		add_action( 'pre_get_posts', [ $hotel, 'change_search_hotel_arg' ] );
		add_filter( 'posts_orderby', [ $hotel, '_get_order_by_query' ] );
		add_filter( 'posts_groupby', [ $hotel, '_change_posts_groupby' ] );
		add_filter( 'posts_where', function ( $where ) {
			return str_replace( ' AND check_in >= UNIX_TIMESTAMP(CURRENT_DATE)', '', $where );
		} );

		$return           = '';
		$query            = array(
			'post_type'                 => 'st_hotel',
			'posts_per_page'            => $st_location_num,
			'order'                     => $st_location_order,
			'orderby'                   => $st_location_orderby,
			'post_status'               => 'publish',
			'is_st_location_list_hotel' => '1'
		);
		$data['query']    = $query;
		$data['style']    = $st_location_style;
		$data['taxonomy'] = false;
		$qry = new WP_Query( $query );
		if ( $qry->have_posts() ) :
			if ( $st_location_style == 'grid' ) {
				$return .= '<div class="row row-wrap loop_hotel loop_grid_hotel style_box">';
			}
			while ( $qry->have_posts() ) : $qry->the_post();
				switch ( $st_location_style ) {
					case "grid":
						$return .= st()->load_template( 'hotel/loop', 'grid', $data );
						break;
					default:
						$return .= st()->load_template( 'hotel/loop', 'list', $data );
						break;
				}
			endwhile;
			if ( $st_location_style == 'grid' ) {
				$return .= '</div>';
			}
		endif;
		$hotel->remove_alter_search_query();
		wp_reset_query();

		return $return;
	}

	st_reg_shortcode( 'st_location_list_hotel', 'st_location_list_hotel_func' );
};
