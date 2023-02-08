<?php
namespace Dfe\Sift\Observer\Customer;
use Dfe\Sift\API\B\Event\UpdatePassword as B;
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
	 */
	function execute(O $o) {!df_request('change_password') || B::p(B::R__USER_UPDATE, B::S__SUCCESS);}
}