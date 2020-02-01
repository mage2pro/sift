<?php
namespace Dfe\Sift\Observer\Quote;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Observer as _P;
use Dfe\Sift\Payload\Browser;
use Dfe\Sift\Payload\OQI;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Item as I;
/**
 * 2020-01-31 `sales_quote_product_add_after`
 * @used-by \Magento\Quote\Model\Quote::addProduct():
 *		$this->_eventManager->dispatch('sales_quote_product_add_after', ['items' => $items])
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Quote/Model/Quote.php#L1631
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Quote/Model/Quote.php#L1694
 * 2020-02-01 https://sift.com/developers/docs/curl/events-api/reserved-events/add-item-to-cart
 */
final class ProductAddAfter implements ObserverInterface {
	/**
	 * 2020-01-31                                           I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {_P::f(function() use($o) {
		/** @uses df_oqi_is_leaf() */
		df_map(array_filter($o['items'], 'df_oqi_is_leaf'), function(I $i) {F::s()->post([
			/**
			 * 2020-01-26
			 * «The product item added to cart.
			 * Required subfields are `item_id`, `product_title`, and `price`.
			 * The `quantity` is specified as a subfield.»
			 * 2020-02-01 https://sift.com/developers/docs/curl/events-api/complex-field-types/item
			 */
			'item' => OQI::p($i)
			// 2020-01-25 Required, string.
			,'type' => '$add_item_to_cart'
		] + Browser::p());});
	});}
}