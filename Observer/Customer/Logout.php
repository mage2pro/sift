<?php
namespace Dfe\Sift\Observer\Customer;
use Dfe\Sift\API\B\Event;
use Dfe\Sift\Observer as _P;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-02-10 `customer_logout`
 * @used-by \Magento\Customer\Model\Session::logout():
 * 	if ($this->isLoggedIn()) {
 * 		$this->_eventManager->dispatch('customer_logout', ['customer' => $this->getCustomer()]);
 * 		$this->_logout();
 * 	}
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Model/Session.php#L455-L469
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/Session.php#L482-L496
 * 
 * 2020-02-12
 * A response with `score_response`:
 *	{
 *		"status": 0,
 *		"error_message": "OK",
 *		"time": 1581443232,
 *		"request": "...",
 *		"score_response": {
 *			"status": 0,
 *			"error_message": "OK",
 *			"scores": {
 *				"payment_abuse": {
 *					"score": 0.017345397550705105,
 *					"reasons": [
 *						{"name": "Estimated email domain age", "value": "2937.95 days"},
 *						{"name": "Network", "value": "N92.243"},
 *						{"name": "Latest order amount in USD", "value": "460.00 USD"},
 *						{"name": "Latest status", "value": "$pending"},
 *						{"name": "Browser/OS", "value": "WINDOWS_7-CHROME8"}
 *					]
 *				}
 *			},
 *			"user_id": "1",
 *			"latest_labels": {},
 *			"workflow_statuses": []
 *		}
 *	}
 */
final class Logout implements ObserverInterface {
	/**
	 * 2020-02-10 https://sift.com/developers/docs/php/events-api/reserved-events/logout 	I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 */
	function execute(O $o):void {_P::f(function() {Event::p('logout');});}
}