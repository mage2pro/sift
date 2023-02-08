<?php
namespace Dfe\Sift\API\B\Event;
use Dfe\Sift\API\B\Event as B;
use Dfe\Sift\Observer as _P;
use Magento\Customer\Api\Data\CustomerInterface as ICD;
use Magento\Customer\Model\Data\Customer as CD;
# 2020-02-11
final class UpdatePassword {
	/**
	 * 2020-02-11
	 * @used-by \Dfe\Sift\Observer\Customer\SaveAfterDataObject::execute()
	 */
	const R__USER_UPDATE = 'user_update';

	/**
	 * 2020-02-11
	 * @used-by \Dfe\Sift\Observer\Customer\SaveAfterDataObject::execute()
	 */
	const S__SUCCESS = 'success';

	/**
	 * 2020-02-11
	 * 1) @see \Magento\Customer\Controller\Adminhtml\Index\ResetPassword::execute()
	 * does not resets the customer's password: it just reminds it to the customer:
	 *		$this->customerAccountManagement->initiatePasswordReset(
	 *			$customer->getEmail(),
	 *			\Magento\Customer\Model\AccountManagement::EMAIL_REMINDER,
	 *			$customer->getWebsiteId()
	 *		);
	 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Controller/Adminhtml/Index/ResetPassword.php#L28-L32
	 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Controller/Adminhtml/Index/ResetPassword.php#L42-L46
	 * 2) Actually, Magento 2 does not have a built-in ability to force a customer to change his password.
	 * 3) A version with a backend handler: https://github.com/mage2pro/sift/tree/0.2.6-backend
	 * @used-by \Dfe\Sift\Plugin\Customer\Model\AccountManagement::afterPasswordResetConfirmation()
	 * @used-by \Dfe\Sift\Plugin\Customer\Model\EmailNotificationInterface::afterPasswordResetConfirmation()
	 * @param ICD|CD $cd
	 */
	static function reset(ICD $cd):void {self::p('forgot_password', 'pending', $cd);}

	/**
	 * 2020-02-11
	 * @used-by self::reset()
	 * @used-by \Dfe\Sift\Observer\Customer\SaveAfterDataObject::execute()
	 * @param string $rs
	 * @param string $st
	 * @param ICD|CD $cd|null [optional]
	 */
	static function p(string $rs, $st, ICD $cd = null) {_P::f(function() use($rs, $st, $cd) {B::p('update_password', [
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
		'reason' => sift_prefix($rs)
		/**
		 * 2020-02-10 Required, string.
		 * «The status of the password update event.
		 * Allowed values:
		 * 	`$failure`: User clicks an expired password link.
		 * 	`$pending`: Password change initiated, waiting for user to act.
		 * 	`$success`:
		 * 		New password was set.
		 * 		This is the only status needed for password updates from within the account
		 * 		(`reason` is `$user_update`).
		 * »
		 */
		,'status' => sift_prefix($st)
	] + (!$cd ? [] : [B::USER_ID => $cd->getId()]));});}
}