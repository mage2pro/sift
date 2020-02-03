<?php
namespace Dfe\Sift\Observer\Sales;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Payload\Address as pAddress;
use Dfe\Sift\Payload\Browser as pBrowser;
use Dfe\Sift\Payload\OQI as pOQI;
use Dfe\Sift\Payload\Payment as pPayment;
use Magento\Framework\Event\Observer as Ob;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Item as I;
/**
 * 2020-02-01 `sales_order_place_after`
 * @used-by \Magento\Sales\Model\Order::place():
 * 		$this->_eventManager->dispatch('sales_order_place_after', ['order' => $this]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Sales/Model/Order.php#L1061
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Sales/Model/Order.php#L1191
 */
final class OrderPlaceAfter implements ObserverInterface {
	/**
	 * 2020-02-01                                          I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param Ob $ob
	 */
	function execute(Ob $ob) {\Dfe\Sift\Observer::f(function() use($ob) {
		$o = $ob['order']; /** @var O $o */
		// 2020-02-01 https://sift.com/developers/docs/curl/events-api/reserved-events/create-content/review
		F::s()->post([
			// 2020-02-01 Integer. «Total transaction amount in micros in the base unit of the `$currency_code`»
			'amount' => sift_amt($o->getGrandTotal())
			// 2020-02-01
			// 1) Address: https://sift.com/developers/docs/curl/events-api/complex-field-types/address
			// 2) «The billing address as entered by the user.»
			,'billing_address' => pAddress::p($o->getBillingAddress())
			// 2020-02-01 String.
			// «ISO-4217 currency code for the amount. If your site uses alternative currencies, specify them here.»
			,'currency_code' => $o->getOrderCurrencyCode()
			// 2020-02-01 Boolean. «Whether the user requested priority/expedited shipping on their order.»
			,'expedited_shipping' => false
			/**
			 * 2020-02-01
			 * 1) Array of items: https://sift.com/developers/docs/curl/events-api/complex-field-types/item
			 * 2) «The list of items ordered.
			 * This may include physical products, gift cards, in-app purchases etc.
			 * Travel (Flights, Hotels, Rideshare, etc) and Event Ticketing customers
			 * should use `$bookings` instead of `$items`.
			 * `$bookings` supports specialized fields for modeling specific to Travel, Ticketing,
			 * and other cases where users make bookings.»
			 * 3) «Note: cannot be used in conjunction with `$bookings`.»
			 */
			,'items' => df_oqi_leafs($o, function(I $i) {return pOQI::p($i);})
			// 2020-02-01 String. «The ID for tracking this order in your system»
			,'order_id' => $o->getIncrementId()
			// 2020-02-01
			// 1) Array Of Payment Methods:
			// https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
			// 2) «The payment information associated with this order.»
			// 3) «Note: As opposed to `$transaction`, `$create_order` takes an array of `$payment_method` objects,
			// so you can record orders that are paid for using multiple payments.»
			,'payment_methods' => [pPayment::p($o->getPayment())]
			// 2020-02-01
			// 1) Array Of Promotions: https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
			// 2) «The list of promotions that apply to this order.
			// You can add one or more promotions when creating or updating an order.
			// You can also separately add promotions to the account via the `$add_promotion` event.»
			,'promotions' => []
			// 2020-02-01 String
			// «For marketplace businesses, this is the seller's user ID, typically a database primary key.
			// Follow our guidelines for `$user_id values`: https://sift.com/developers/docs/curl/events-api/fields»
			,'seller_user_id' => ''
			 /**
			  * 2020-02-01 «Indicates the method of delivery to the user. Allowed values: `$electronic`, `$physical`».
			  * 2020-02-03
			  * If an order consist of virtual products only, then it does not have a shipping address,
			  * and @uses \Magento\Sales\Model\Order::getShippingAddress() returns null
			  * https://github.com/mage2pro/core/blob/5.9.4/Quote/lib/oq.php#L174-L176
			  */
			,'shipping_method' => $o->getShippingAddress() ? '$physical' : '$electronic'
			// 2020-02-01
			// 1) Address: https://sift.com/developers/docs/curl/events-api/complex-field-types/address
			// 2) «The shipping address as entered by the user.»
			,'shipping_address' => pAddress::p($o->getShippingAddress())
			// 2020-01-25 Required, string.
			,'type' => '$create_order'
			// 2020-02-01 String.
			// «Email of the user creating this order.
			// Note: If the user's email is also their account ID in your system,
			// set both the `$user_id` and `$user_email` fields to their email address.»
			,'user_email' => $o->getCustomerEmail()
		] + pBrowser::p());
	});}
}