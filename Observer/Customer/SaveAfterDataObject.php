<?php
namespace Dfe\Sift\Observer\Customer;
use Dfe\Sift\API\B\Event;
use Dfe\Sift\Observer as _P;
use Dfe\Sift\Payload\LoginOrRegister as pLoginOrRegister;
use Magento\Customer\Model\Customer as C;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-02-10 `customer_save_after_data_object`
 * @used-by \Magento\Customer\Model\ResourceModel\CustomerRepository::save():
 * 		$savedCustomer = $this->get($customer->getEmail(), $customer->getWebsiteId())
 * 		$this->eventManager->dispatch('customer_save_after_data_object', [
 * 			'customer_data_object' => $savedCustomer,
 * 			'orig_customer_data_object' => $prevCustomerData,
 * 			'delegate_data' => $delegatedNewOperation ? $delegatedNewOperation->getAdditionalData() : []
 * 		]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Model/ResourceModel/CustomerRepository.php#L226-L230
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/ResourceModel/CustomerRepository.php#L274-L282
 */
final class SaveAfterDataObject implements ObserverInterface {
	/**
	 * 2020-02-10 https://sift.com/developers/docs/php/events-api/reserved-events/update-password
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {!df_request('change_password') || _P::f(function() {Event::p('update_password', [
		/**
		 * 2020-02-10 Required, string.
		 * «The reason the password was updated or an update was attempted. 
		 * The process may trigger a `verification` (with `$verified_event = $update_password`).
		 * Allowed values:
		 * 	`$forced_reset`:
		 * 		The service provider reset the password following suspicious account behavior or a support ticket.
		 * 		The old password becomes invalid once the process is initiated (`status` is `$pending`).
		 * 	`$forgot_password`:
		 * 		The user forgot the password and initiates a self-service process to create a new password.
		 * 		The old password becomes invalid only once the process is complete (`status` is `$success`).
		 * 	`$user_update`:
		 * 		The user updates the password on their own while logged into the account.
		 * 		The update can be motivated by, e.g., desire to use a stronger password from a password manager
		 * 		or because the password expired after 90 days.
		 * »
		 */
		'reason' => sift_prefix('user_update')
		/**
		 * 2020-02-10 Required, string.
		 * «The status of the password update event.
		 * Allowed values:
		 * 	`$failure`: User clicks an expired password link.
		 * 	`$pending`: Password change initiated, waiting for user to act.
		 * 	`$success`:
		 * 		New password was set.
		 * 		This is the only status needed for password updates from within the account (`reason` is `$user_update`).
		 * »
		 */
		,'status' => sift_prefix('success')
	]);});}
}