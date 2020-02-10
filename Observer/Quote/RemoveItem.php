<?php
namespace Dfe\Sift\Observer\Quote;
use Dfe\Sift\API\B\Event;
use Dfe\Sift\Observer as _P;
use Dfe\Sift\Payload\OQI;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-02-10
 * 1) `sales_quote_remove_item`
 * @used-by \Magento\Quote\Model\Quote::removeItem():
 * 		$this->_eventManager->dispatch('sales_quote_remove_item', ['quote_item' => $item]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Quote/Model/Quote.php#L1504
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Quote/Model/Quote.php#L1558
 *
 * 2) There is also the @see \Magento\Quote\Model\Quote::deleteItem() method,
 * and it does not trigger any the `sales_quote_remove_item` event,
 * but an item removal via the frontend UI calls the @see \Magento\Quote\Model\Quote::removeItem() method,
 * not `deleteItem()`. The call stack:
 * 2.1) @see \Magento\Checkout\Controller\Cart\Delete::execute():
 * 		$this->cart->removeItem($id);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Checkout/Controller/Cart/Delete.php#L21
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Checkout/Controller/Cart/Delete.php#L31
 * 2.2) @see \Magento\Checkout\Model\Cart::removeItem():
 * 		$this->getQuote()->removeItem($itemId);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Checkout/Model/Cart.php#L538-L549
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Checkout/Model/Cart.php#L556-L567
 *
 * 3) There is also the \Magento\Quote\Model\Quote::removeAllItems() method:
 * 		public function removeAllItems() {
 * 			foreach ($this->getItemsCollection() as $itemId => $item) {
 * 				if ($item->getId() === null) {
 * 					$this->getItemsCollection()->removeItemByKey($itemId);
 * 				}
 * 				else {
 * 					$item->isDeleted(true);
 * 				}
 * 			}
 * 			return $this;
 * 		}
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Quote/Model/Quote.php#L1510-L1525
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Quote/Model/Quote.php#L1564-L1579
 * It does not trigger the `sales_quote_remove_item` event too, and it is callable via a frontend public controller
 * (despite the Lumia theme does not use it and does not provide an ability to clear the shopping cart
 * to a frontend visitor). The call stack:
 * 3.1) \Magento\Checkout\Controller\Cart\UpdatePost::execute():
 *		switch ($updateAction) {
 *			case 'empty_cart':
 *				$this->_emptyShoppingCart();
 *				break;
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Checkout/Controller/Cart/UpdatePost.php#L75-L78
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Checkout/Controller/Cart/UpdatePost.php#L109-L111
 * 3.2) \Magento\Checkout\Controller\Cart\UpdatePost::_emptyShoppingCart():
 * 		$this->cart->truncate()->save();
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Checkout/Controller/Cart/UpdatePost.php#L11-L25
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Checkout/Controller/Cart/UpdatePost.php#L52-L66
 * 3.3) \Magento\Checkout\Model\Cart::truncate():
 * 		$this->getQuote()->removeAllItems();
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Checkout/Model/Cart.php#L584-L594
 * https://github.com/magento/magento2/blob/2.3.3/app/code/Magento/Checkout/Model/Cart.php#L602-L612
 */
final class RemoveItem implements ObserverInterface {
	/**
	 * 2020-02-10 https://sift.com/developers/docs/php/events-api/reserved-events/remove-item-from-cart
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {_P::f(function() use($o) {Event::p('remove_item_from_cart', [
		'item' => OQI::p($o['quote_item'])
	]);});}
}