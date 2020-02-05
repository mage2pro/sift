<?php
namespace Dfe\Sift\Payload;
use Magento\Catalog\Model\Category as C;
use Magento\Catalog\Model\Product as P;
use Magento\Quote\Model\Quote\Item as QI;
use Magento\Sales\Model\Order\Item as OI;
// 2020-02-01 https://sift.com/developers/docs/curl/events-api/complex-field-types/item
final class OQI {
	/**
	 * 2020-02-01
	 * @used-by \Dfe\Sift\Observer\Quote\ProductAddAfter::execute()
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param QI|OI $i
	 * @return array(string => mixed)
	 */
	static function p($i) {$p = df_product($i); /** @var P $p */return [
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
	];}
}