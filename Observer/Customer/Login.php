<?php
namespace Dfe\Sift\Observer\Customer;
use Dfe\Sift\API\B\Event;
use Dfe\Sift\Observer as _P;
use Dfe\Sift\Payload\LoginOrRegister as pLoginOrRegister;
use Magento\Customer\Model\Customer as C;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-02-06 `customer_login`
 * 1) https://sift.com/developers/docs/curl/events-api/reserved-events/login
 * 2.1) @used-by \Magento\Customer\Model\Session::setCustomerAsLoggedIn():
 * 		$this->_eventManager->dispatch('customer_login', ['customer' => $customer]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Model/Session.php#L413
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/Session.php#L438
 * 2.2) @used-by \Magento\Customer\Model\Session::setCustomerDataAsLoggedIn()
 * 		$this->_eventManager->dispatch('customer_login', ['customer' => $customerModel]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Model/Session.php#L432
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/Session.php#L459
 */
final class Login implements ObserverInterface {
	/**
	 * 2020-02-06                                           I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {_P::f(function() use($o) {
		$c = $o['customer']; /** @var C $c */
		// 2020-02-06 https://sift.com/developers/docs/curl/events-api/reserved-events/login
		Event::p('login', pLoginOrRegister::p($c) + [
			/**
			 * 2020-02-06
			 * «Capture the reason for the failure of the login.
			 * Allowed values:
			 * 		$account_unknown: Username never existed on this site.
			 * 		$account_suspended: Username exists, but the account is locked or temporarily deactivated.
			 * 		$account_disabled: Username exists, account was closed or permanently deactivated.
			 * 		$wrong_password: Username exists, but the password is incorrect for this user.
			 * »
			 */
			'failure_reason' => ''
			// 2020-02-06
			// «Use `login_status` to represent the success or failure of the login attempt»
			// Allowed values: `$success`, `$failure`.
			,'login_status' => sift_prefix('success')
			,'username' => $c->getEmail() // 2020-02-06 String. «The username entered at the login prompt»
		]);
	});}
}