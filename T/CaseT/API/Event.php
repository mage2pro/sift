<?php
namespace Dfe\Sift\T\CaseT\API;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Settings as S;
use Exception as E;
// 2020-01-25 https://sift.com/developers/docs/curl/events-api
final class Event extends \Dfe\Sift\T\CaseT {
	/** 2020-01-25 */
	function t00() {echo __METHOD__;}

	/** @test 2020-01-25 https://sift.com/developers/docs/curl/events-api/reserved-events/add-item-to-cart */
	function t01_add_item_to_cart() {
		$s = S::s(); /** @var S $s */
		try {
			$r = F::s()->post([
				/**
				 * 2020-01-26
				 * «The user agent of the browser that is used to add the item to cart.
				 * Represented by the `browser` object.
				 * Use this field if the client is a browser.
				 * Note: cannot be used in conjunction with `app`.»
				 */
				'browser' => ['user_agent' => df_request_ua()]
				/**
				 * 2020-01-26
				 * «The product item added to cart.
				 * Required subfields are `item_id`, `product_title`, and `price`.
				 * The `quantity` is specified as a subfield.»
				 */
				,'item' => [
					// 2020-01-29 «B004834GQO»
					'item_id' => ''
					// 2020-01-29 «The Slanket Blanket-Texas Tea»
					,'product_title' => ''
					// 2020-01-29 «39990000» => «$39.99»
					,'price' => ''
					// 2020-01-29 «16»
					,'quantity' => ''
				]
				// 2020-01-25 Required, string.
				,'type' => '$add_item_to_cart'
			]);
			echo df_json_encode($r);
		}
		catch (E $e) {
			xdebug_break();
		}
	}
}