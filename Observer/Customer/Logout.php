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
 */
final class Logout implements ObserverInterface {
	/**
	 * 2020-02-10 https://sift.com/developers/docs/php/events-api/reserved-events/logout 	I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {_P::f(function() {Event::p('logout');});}
}