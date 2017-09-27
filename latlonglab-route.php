<?php
/**
   Plugin Name: embed latlonglab route
   Plugin URI:
   Description:
   Version: 1.0
   Author: Ryuji
   Author URI: http://ryus.co.jp
   License: GPL2

   @package LatLongLab-route
 */

wp_embed_register_handler( 'latlonglab_route', '#http://latlonglab\.yahoo\.co\.jp/route/watch\?id=([0-9a-z]+)#i', 'wp_embed_handler_latlonglab_route' );

/**
 *  LatLongLab-route の地図を埋め込むためのハンドラ.
 *
 *  @param string $matches マッチした部分.
 *  @param array  $attr    属性 (array に分解したもの).
 *  @param string $url     url.
 *  @param string $rawattr 属性文字列.
 */
function wp_embed_handler_latlonglab_route( $matches, $attr, $url, $rawattr ) {

	$width  = get_option( 'embed_size_w' );
	if ( intval( $width ) === 0 ) {
		$width = $GLOBALS['content_width'];
		$height = intval( $width * 0.75 );
	} else {
		$height = get_option( 'embed_size_h' );
	}

	$embed = sprintf(
		'<script type="text/javascript" encoding="UTF-8" src="http://latlonglab.yahoo.co.jp/route/paste?id=%s&width=%d&height=%d&mapstyle=map&graph=true&maponly=false"></script>',
		esc_attr( $matches[1] ),
		$width,
		$height
	);

	return apply_filters( 'embed_latlonglab_route', $embed, $matches, $attr, $url, $rawattr );
}
