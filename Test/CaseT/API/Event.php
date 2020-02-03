<?php
namespace Dfe\Sift\Test\CaseT\API;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Settings as S;
use Exception as E;
// 2020-01-25 https://sift.com/developers/docs/curl/events-api
final class Event extends \Dfe\Sift\Test\CaseT {
	/** 2020-01-25 */
	function t00() {echo __METHOD__;}

	/** 2020-01-25 https://sift.com/developers/docs/curl/events-api/reserved-events/add-item-to-cart */
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
				 * 2020-01-30
				 * An empty value leads to the error:
				 * «Invalid field value(s) for fields: $.$browser.$user_agent»
				 */
				'browser' => ['user_agent' => df_request_ua() ?: 'CLI']
				/**
				 * 2020-01-26
				 * «The product item added to cart.
				 * Required subfields are `item_id`, `product_title`, and `price`.
				 * The `quantity` is specified as a subfield.»
				 */
				,'item' => [
					// 2020-01-30 «Slanket»
					'brand' => 'Slanket'
					// 2020-01-30 «Blankets & Throws»
					,'category' => 'Blankets & Throws'
					// 2020-01-30 «Texas Tea»
					,'color' => 'Texas Tea'
					// 2020-01-30
					,'currency_code' => 'USD'
					// 2020-01-29 «B004834GQO»
					,'item_id' => 'B004834GQO'
					// 2020-01-30 «Slanket»
					,'manufacturer' => 'Slanket'
					// 2020-01-29 «The Slanket Blanket-Texas Tea»
					,'product_title' => 'The Slanket Blanket-Texas Tea'
					// 2020-01-29 «39990000» => «$39.99»
					,'price' => 39990000
					// 2020-01-29 «16»
					,'quantity' => 16
					// 2020-01-30 «004834GQ»
					,'sku' => '004834GQ'
					,'tags' => ['Awesome', 'Wintertime specials']
					// 2020-01-30 «6786211451001»
					,'upc' => '6786211451001'
				]
				// 2020-01-25 Required, string.
				,'type' => '$add_item_to_cart'
			]);
			echo $r->j();
		}
		catch (E $e) {
			xdebug_break();
		}
	}
}