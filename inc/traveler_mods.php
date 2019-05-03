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

if(!function_exists( 'st_vc_list_tour' )) {
	function st_vc_list_tour( $attr , $content = false )
	{
		global $st_search_args;
		$param   = array(
			'st_ids'                 => '' ,
			'st_number_tour'         => 4 ,
			'st_order'               => '' ,
			'st_orderby'             => '' ,
			'st_tour_of_row'         => '' ,
			'st_style'               => 'style_1' ,
			'only_featured_location' => 'no' ,
			'st_location'            => '' ,
			'title'                  => '' ,
			'font_size'              => '3' ,
		);
		$list_tax = TravelHelper::get_object_taxonomies_service('st_tours');
		if( !empty( $list_tax ) ){
			foreach( $list_tax as $name => $label ){
				$param['taxonomies--'. $name] = '';
			}
		}

		$data    = shortcode_atts( $param , $attr , 'st_list_tour' );

		extract( $data );
		$st_search_args=$data;

		$page = STInput::request( 'paged' );
		if(!$page) {
			$page = get_query_var( 'paged' );
		}
		$query = array(
			'post_type'      => 'st_tours' ,
			'posts_per_page' => $st_number_tour ,
			'paged'          => $page ,
			'order'          => $st_order ,
			'orderby'        => $st_orderby,
		);

		$st_search_args['featured_location']=STLocation::inst()->get_featured_ids();
		$tour=STTour::get_instance();
		$tour->alter_search_query();
		query_posts( $query );
		global $wp_query;
		$r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop3' , '' , $data ) . "</div>";
		wp_reset_query();
		$tour->remove_alter_search_query();
		$st_search_args=null;

		if(!empty( $title ) and !empty( $r )) {
			$r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
		}
		return $r;
	}
	st_reg_shortcode( 'st_list_tour' , 'st_vc_list_tour' );

}

if ( ! function_exists( 'st_after_logout_redirect' ) ) {
	function st_after_logout_redirect( $redirect_to, $requested_redirect_to, $user ) {
		return st_after_login_redirect( $redirect_to, $requested_redirect_to, $user );
	}
}

if ( ! function_exists( 'st_after_login_redirect' ) ) {
	function st_after_login_redirect( $redirect_to, $request, $user ) {
		if ( $_SERVER['HTTP_REFERER'] ) {
			$redirect_to = $_SERVER['HTTP_REFERER'];
		}

		die( $redirect_to );

		return $redirect_to;
	}
}
