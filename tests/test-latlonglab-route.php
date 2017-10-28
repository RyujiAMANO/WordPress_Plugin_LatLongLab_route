<?php
/**
 * Class LatLongLabRouteTest
 *
 * @package Latlonglab_Route
 */

/**
 * LatLongLabRoute test case.
 */
class LatLongLabRouteTest extends WP_UnitTestCase {
	/**
	 * Http と https のテストを共通化.
	 *
	 * @param String $expected 期待している結果.
	 * @param String $content 与えるテストデータ.
	 */
	function _test_http_body( $expected, $content ) {
		// グローバルを変更するので保存しておく.
		$original_width = isset( $GLOBALS['content_width'] ) ? $GLOBALS['content_width'] : 'unset';

		// グローバルを変更.
		$GLOBALS['content_width'] = 810;

		// テスト本体.
		$actual = $GLOBALS['wp_embed']->autoembed( $content );
		$this->assertEquals( $expected, $actual );

		// 保存しておいたグローバルを元に戻す.
		if ( 'unset' == $original_width ) {
			unset( $GLOBALS['content_width'] );
		} else {
			$GLOBALS['content_width'] = $original_width;
		}
	}

	/**
	 * ルートラボの http スキームによる URL を埋め込みタグに変換することをテスト.
	 */
	function test_http() {
		$expected = '<script type="text/javascript" encoding="UTF-8" src="http://latlonglab.yahoo.co.jp/route/paste?id=39abcd9e7e587783eef0bed6c35b17dc&width=810&height=607&mapstyle=map&graph=true&maponly=false"></script>';
		$content  = 'http://latlonglab.yahoo.co.jp/route/watch?id=39abcd9e7e587783eef0bed6c35b17dc';
		$this->_test_http_body( $expected, $content );
	}

	/**
	 * ルートラボの https スキームによる URL を埋め込みタグに変換することをテスト.
	 */
	function test_https() {
		$expected = '<script type="text/javascript" encoding="UTF-8" src="https://latlonglab.yahoo.co.jp/route/paste?id=39abcd9e7e587783eef0bed6c35b17dc&width=810&height=607&mapstyle=map&graph=true&maponly=false"></script>';
		$content  = 'https://latlonglab.yahoo.co.jp/route/watch?id=39abcd9e7e587783eef0bed6c35b17dc';
		$this->_test_http_body( $expected, $content );
	}
}
