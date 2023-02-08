<?php
namespace Dfe\Sift\Plugin\Customer\Api;
use Dfe\Sift\API\B\Event;
use Dfe\Sift\Observer as _P;
use Magento\Customer\Api\AccountManagementInterface as Sb;
use Magento\Framework\Exception\EmailNotConfirmedException as NotConfirmed;
use Magento\Framework\Exception\State\UserLockedException as Locked;
# 2020-02-06
final class AccountManagementInterface {
	/**
	 * 2020-02-06
	 * @see \Magento\Customer\Api\AccountManagementInterface::authenticate()
	 * @see \Magento\Customer\Model\AccountManagement::authenticate()
	 * @param \Closure $f
	 * @param string $u
	 * @param string $p
	 * @return string
	 */
	function aroundAuthenticate(Sb $sb, \Closure $f, $u, $p) {
		try {return $f($u, $p);}
		catch (\Exception $e) {_P::f(function() use($e, $u) {
			# 2020-02-06 https://sift.com/developers/docs/curl/events-api/reserved-events/login
			Event::p('login', [
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
				'failure_reason' => sift_prefix(
					$e instanceof Locked || $e instanceof NotConfirmed ? 'account_suspended' : 'wrong_password'
				)
				# 2020-02-06
				# «Use `login_status` to represent the success or failure of the login attempt»
				# Allowed values: `$success`, `$failure`.
				,'login_status' => sift_prefix('failure')
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
				,'username' => $u # 2020-02-06 String. «The username entered at the login prompt»
			]);
		}); throw $e;}
	}
}