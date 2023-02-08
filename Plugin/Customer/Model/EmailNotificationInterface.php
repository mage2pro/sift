<?php
namespace Dfe\Sift\Plugin\Customer\Model;
use Dfe\Sift\API\B\Event\UpdatePassword as B;
use Magento\Customer\Api\Data\CustomerInterface as ICD;
use Magento\Customer\Model\Data\Customer as CD;
use Magento\Customer\Model\EmailNotification as Sb;
/**
 * 2020-02-10
 * It is for Magento ≥ 2.1.0:
 * https://github.com/magento/magento2/blob/2.1.0/app/code/Magento/Customer/Model/EmailNotification.php
 * The @see \Magento\Customer\Model\EmailNotificationInterface interface
 * and the @see \Magento\Customer\Model\EmailNotification class are absent in Magento < 2.1.0.
 * Magento < 2.1.0 uses @see \Magento\Customer\Model\AccountManagement::sendPasswordResetConfirmationEmail()
 * instead, and I handle it in my @see \Dfe\Sift\Plugin\Customer\Model\AccountManagement plugin.
 */
final class EmailNotificationInterface {
	/**
	 * 2020-02-10
	 * @see \Magento\Customer\Model\EmailNotification::passwordResetConfirmation()
	 * https://github.com/magento/magento2/blob/2.1.0/app/code/Magento/Customer/Model/EmailNotification.php#L301-L323
	 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/EmailNotification.php#L335-L357
	 * @see \Magento\Customer\Model\EmailNotificationInterface::passwordResetConfirmation()
	 * https://github.com/magento/magento2/blob/2.1.0/app/code/Magento/Customer/Model/EmailNotificationInterface.php#L55-L61
	 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/EmailNotificationInterface.php#L61-L68
	 * @param ICD|CD $cd
	 */
	function beforePasswordResetConfirmation(Sb $sb, ICD $cd) {B::reset($cd);}
}