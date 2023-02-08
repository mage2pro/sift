<?php
namespace Dfe\Sift\Observer\Customer;
use Dfe\Sift\API\B\Event as B;
use Dfe\Sift\Observer as _P;
use Dfe\Sift\Payload\LoginOrRegister as pLoginOrRegister;
use Magento\Customer\Model\Customer as C;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-02-06 `customer_register_success`
 * @used-by \Magento\Customer\Controller\Account\CreatePost::execute():
 * 		$this->_eventManager->dispatch('customer_register_success', [
 * 			'account_controller' => $this, 'customer' => $customer
 * 		]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Controller/Account/CreatePost.php#L239-L242
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Controller/Account/CreatePost.php#L367-L371
 * https://sift.com/developers/docs/curl/events-api/reserved-events/create-account
 */
final class RegisterSuccess implements ObserverInterface {
	/**
	 * 2020-02-06                                           I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 */
	function execute(O $o) {_P::f(function() use($o) {
		/** 2020-02-06 $o['customer'] is a @see \Magento\Customer\Model\Data\Customer */
		$c = df_customer($o['customer']); /** @var C $c */
		# 2020-02-06 https://sift.com/developers/docs/curl/events-api/reserved-events/create-account
		B::p('create_account', pLoginOrRegister::p($c) + [
			/**
			 * 2020-02-06 String.
			 * 1) «The billing address associated with this user»
			 * https://sift.com/developers/docs/curl/events-api/complex-field-types/address
			 * 2) The standard Magento 2 registration form does not include an address:
			 * a customer can register his address in a separate scenario.
			 * 3) Potentially, Magento 2 is able to register an address alongside a customer:
			 * @see \Magento\Customer\Controller\Account\CreatePost::execute():
			 * 		$address = $this->extractAddress();
			 * 		$addresses = $address === null ? [] : [$address];
			 * 		$customer = $this->customerExtractor->extract('customer_account_create', $this->_request)
			 * 		$customer->setAddresses($addresses);
			 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Controller/Account/CreatePost.php#L352-L355
			 * https://github.com/magento/magento2/blob/2.2.0/app/code/Magento/Customer/Controller/Account/CreatePost.php#L301-L305
			 */
			'billing_address' => []
			# 2020-02-06 String. «The full name of the user»
			,'name' => $c->getName()
			# 2020-02-06 String.
			# 1) «The payment method(s) associated with this account»
			# https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
			# 2) The standard Magento 2 registration flow does not associate the customer with payment methods.
			,'payment_methods' => []
			# 2020-02-06
			# 1) «The primary phone number of the user associated with this account.
			# Provide the phone number as a string starting with the country code.
			# Use E.164 format or send in the standard national format of number's origin.
			# For example: "+14155556041" or "1-415-555-6041" for a U.S. number.
			# If you collect other phone numbers for the account,
			# provide them as additional custom fields, e.g `work_phone`»
			# 2) The standard Magento 2 registration form does not include a phone number:
			# a customer can register his phone number in a separate scenario on an address form.
			,'phone' => ''
			# 2020-02-06 String.
			# «The list of promotions that apply to this account.
			# You can add one or more promotions when creating or updating the account.
			# It is particularly useful to add the promotion with this event
			# if the account is receiving some referral incentive.
			# You can also separately add promotions to the account via the `add_promotion` event.»
			# https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
			# 2) The standard Magento 2 registration flow does not associate the customer with any promotions.
			,'promotions' => []
			# 2020-02-06 String.
			# «The ID of the user that referred the current user to your business.
			# This field is required for detecting referral fraud.
			# Note: User IDs are case sensitive.
			# You may need to normalize the capitalization of your user IDs.
			# Follow our guidelines for `user_id` values.»
			,'referrer_user_id' => ''
			# 2020-02-06 String.
			# 1) «The shipping address associated with this user»
			# https://sift.com/developers/docs/curl/events-api/complex-field-types/address
			# 2) The standard Magento 2 registration form does not include an address:
			# a customer can register his address in a separate scenario.
			,'shipping_address' => []
			# 2020-02-06 String.
			# «Email of the user creating this order.
			# Note: If the user's email is also their account ID in your system,
			# set both the `user_id` and `user_email` fields to their email address.»
			,'user_email' => $c->getEmail()
			/**
			 * 2020-02-06 Required, string.
			 * 1) «The user’s internal account ID.
			 * This field is required on all events performed by the user while logged in.
			 * Users without an assigned $user_id will not show up in the console.
			 * Note: User IDs are case sensitive.
			 * You may need to normalize the capitalization of your user IDs.
			 * Only the following characters may be used:a-z,A-Z,0-9,=, ., -, _, +, @, :, &, ^, %, !, $»
			 * https://sift.com/developers/docs/curl/events-api/fields
			 * 2) I explicitly set it here, because @see df_customer_id()
			 * (called in @see \Dfe\Sift\API\B\Event::p())
			 * does not work in a `customer_register_success` event handler.
			 */
			,B::USER_ID => $c->getId()
		]);
	});}
}