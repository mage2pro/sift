<?php
namespace Dfe\Sift\Payload;
use Magento\Customer\Model\Customer as C;
final class LoginOrRegister {
	/**
	 * 2020-02-06
	 * @used-by \Dfe\Sift\Observer\Customer\Login::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\RegisterSuccess::execute()
	 * @param C $c
	 * @return array(string => mixed)
	 */
	static function p(C $c) {return [
		# 2020-02-06 Array Of Strings.
		# «Capture the type(s) of the account: "merchant" or "shopper", "regular" or "premium", etc.
		# The array supports multiple types for a single account, e.g. ["merchant", "premium"].»
		'account_types' => [df_customer_group_name($c)]
		/**
		 * 2020-02-06 String.
		 * 1) «If the user logged in with a social identify provider, give the name here.
		 * Allowed values: $amazon, $facebook, $google, $linkedin, $microsoft, $other, $twitter, $yahoo».
		 * 2) Magento 2 does not provide any built-in single sign on modules.
		 * 3) @todo "Implement specific adapters for popular third-party single sign-on modules
		 * to fill the `$social_sign_on_type` field of the `$create_account` event":
		 * https://github.com/mage2pro/sift/issues/3
		 */
		,'social_sign_on_type' => ''
	];}
}