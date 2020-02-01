<?php
namespace Dfe\Sift\Observer\Quote;
use Dfe\Sift\API\Facade\Event as F;
use Magento\Catalog\Model\Category as C;
use Magento\Catalog\Model\Product as P;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Item as I;
/**
 * 2020-01-31 `sales_quote_product_add_after`
 * @used-by \Magento\Quote\Model\Quote::addProduct():
 *		$this->_eventManager->dispatch('sales_quote_product_add_after', ['items' => $items])
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Quote/Model/Quote.php#L1631
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Quote/Model/Quote.php#L1694
 */
final class ProductAddAfter implements ObserverInterface {
	/**
	 * 2020-01-31                                           I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {\Dfe\Sift\Observer::f(function() use($o) {
		/** @uses df_oqi_is_leaf() */
		df_map(array_filter($o['items'], 'df_oqi_is_leaf'), function(I $i) { /** @var I $i */
			$p = $i->getProduct(); /** @var P $p */
			// 2020-02-01 https://sift.com/developers/docs/curl/events-api/reserved-events/add-item-to-cart
			F::s()->post([
				/**
				 * 2020-01-26
				 * «The user agent of the browser that is used to add the item to cart.
				 * Represented by the `browser` object.
				 * Use this field if the client is a browser.
				 * Note: cannot be used in conjunction with `app`.»
				 * 2020-01-30
				 * An empty value leads to the error: «Invalid field value(s) for fields: $.$browser.$user_agent».
				 * 2020-02-01 https://sift.com/developers/docs/curl/events-api/complex-field-types/browser
				 */
				'browser' => ['user_agent' => df_request_ua() ?: 'CLI']
				/**
				 * 2020-01-26
				 * «The product item added to cart.
				 * Required subfields are `item_id`, `product_title`, and `price`.
				 * The `quantity` is specified as a subfield.»
				 * 2020-02-01 https://sift.com/developers/docs/curl/events-api/complex-field-types/item
				 */
				,'item' => [
					// 2020-01-30 «Slanket»
					// 2020-02-01 String. «The brand name of the item.»
					'brand' => df_product_att_val_s($p, 'brand', null)
					// 2020-01-30 «Blankets & Throws»
					// 2020-02-01 String.
					// «The category this item is listed under in your business.
					// e.g., "kitchen appliance", "menswear > pants".»
					,'category' => df_csv_pretty(df_map($p->getCategoryCollection(), function(C $c) {return
						$c->getName()
					;}))
					// 2020-01-30 «Texas Tea»
					// 2020-02-01 String. «The color of the item.»
					,'color' => df_product_att_val_s($p, 'color', null)
					// 2020-02-01 String. «ISO-4217 currency code for the price».
					,'currency_code' => df_oqi_currency_c($i)
					// 2020-02-01 Integer.
					// «If the item is a book with an International Standard Book Number (ISBN), provide it here.»
					// https://en.wikipedia.org/wiki/International_Standard_Book_Number
					,'isbn' => ''
					// 2020-01-29 «B004834GQO»
					// 2020-02-01 String.
					// «The item's unique identifier according to your systems.
					// Use the same ID that you would use to look up items on your website's database.»
					,'item_id' => $i['product_id']
					// 2020-01-30 «Slanket»
					// 2020-02-01 String. «Name of the item's manufacturer.»
					,'manufacturer' => df_product_att_val_s($p, 'manufacturer', null)
					// 2020-01-29 «The Slanket Blanket-Texas Tea»
					// 2020-02-01 String.
					// «The item's name, e.g., "Men's Running Springblade Drive Shoes, US10"»
					,'product_title' => $i->getName()
					// 2020-01-29 $39.99 => 39990000
					// 2020-02-01 Integer.
					// «The item unit price in micros, in the base unit of the $currency_code.
					// 1 cent = 10,000 micros. $1.23 USD = 123 cents = 1,230,000 micros.»
					,'price' => sift_amt(df_oqi_price($i))
					// 2020-01-29 «16»
					// 2020-02-01 Integer. «Quantity of the item»
					,'quantity' => df_oqi_qty($i)
					// 2020-02-01 String. «The size of the item.»
					,'size' => df_product_att_val_s($p, 'size', null)
					// 2020-01-30 «004834GQ»
					// 2020-02-01 String. «If the item has a Stock-keeping Unit ID (SKU), provide it here.»
					,'sku' => $i->getSku()
					// 2020-01-31 Magento 2 does not have a built-in tagging module.
					// 2020-02-01 Array of strings.
					// «The tags used to describe this item in your business. e.g., "funny", "halloween".»
					,'tags' => []
					// 2020-01-30 «6786211451001»
					// 2020-01-31
					// It seems to mean «Universal Product Code» https://en.wikipedia.org/wiki/Universal_Product_Code
					// 2020-02-01 String.
					// «If the item has a Universal Product Code (UPC), provide it here.»
					// http://en.wikipedia.org/wiki/Universal_Product_Code
					,'upc' => ''
				]
				// 2020-01-25 Required, string.
				,'type' => '$add_item_to_cart'
			]);
		});
	});}
}