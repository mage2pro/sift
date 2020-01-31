<?php
namespace Dfe\Sift\Observer\Quote;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Settings as S;
use Exception as E;
use Magento\Catalog\Model\Product as P;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote as Q;
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
	function execute(O $o) {
		try {
			$s = S::s(); /** @var S $s */
			if ($s->enable()) {
				/** @uses df_oqi_is_leaf() */
				df_map(array_filter($o['items'], 'df_oqi_is_leaf'), function(I $i) { /** @var I $i */
					F::s()->post([
						/**
						 * 2020-01-26
						 * «The user agent of the browser that is used to add the item to cart.
						 * Represented by the `browser` object.
						 * Use this field if the client is a browser.
						 * Note: cannot be used in conjunction with `app`.»
						 * 2020-01-30
						 * An empty value leads to the error: «Invalid field value(s) for fields: $.$browser.$user_agent».
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
							,'currency_code' => df_oqi_currency_c($i)
							// 2020-01-29 «B004834GQO»
							,'item_id' => 'B004834GQO'
							// 2020-01-30 «Slanket»
							,'manufacturer' => 'Slanket'
							,'product_title' => $i->getName() // 2020-01-29 «The Slanket Blanket-Texas Tea»
							,'price' => round(10**6 * df_oqi_price($i)) // 2020-01-29 «39990000» => «$39.99»
							,'quantity' => df_oqi_qty($i) // 2020-01-29 «16»
							// 2020-01-30 «004834GQ»
							,'sku' => '004834GQ'
							,'tags' => [] // 2020-01-31 Magento 2 does not have a built-in tagging module.
							// 2020-01-30 «6786211451001»
							,'upc' => '6786211451001'
						]
						// 2020-01-25 Required, string.
						,'type' => '$add_item_to_cart'
					]);
				});
			}
		}
		catch (E $e) {df_log($e, $this);}
	}
}