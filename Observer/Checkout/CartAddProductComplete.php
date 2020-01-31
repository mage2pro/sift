<?php
namespace Dfe\Sift\Observer\Checkout;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Settings as S;
use Exception as E;
use Magento\Catalog\Model\Product as P;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-01-31 `checkout_cart_add_product_complete`
 * @used-by \Magento\Checkout\Controller\Cart\Add::execute():
 *		$this->_eventManager->dispatch(
 *			'checkout_cart_add_product_complete',
 *			['product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse()]
 *		);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Checkout/Controller/Cart/Add.php#L113-L116
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Checkout/Controller/Cart/Add.php#L124-L127
 */
final class CartAddProductComplete implements ObserverInterface {
	/**
	 * 2020-01-31
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {
		$p = $o['product']; /** @var P $p */
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
		catch (E $e) {df_log($e, $this);}
	}
}