<?php
namespace Dfe\Sift\Plugin\Customer\Model;
use Dfe\Sift\API\B\Event\UpdatePassword as B;
use Magento\Customer\Api\Data\CustomerInterface as ICD;
use Magento\Customer\Model\Data\Customer as CD;
use Magento\Customer\Model\EmailNotification as Sb;
/**
 * 2020-02-10
 * It is for Magento < 2.1.0:
 * For Magento ≥ 2.1.0 I use the @see \Dfe\Sift\Plugin\Customer\Model\EmailNotificationInterface plugin.
 */
final class AccountManagement {
	/**
	 * 2020-02-10
	 * @see \Magento\Customer\Model\AccountManagement::sendPasswordResetConfirmationEmail()
	 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Model/AccountManagement.php#L1055-L1079
	 * Actally, the method still exists in the latest Magento version (2.3.4),
	 * but it is deprecated and is not used:
	 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Model/AccountManagement.php#L1493-L1520
	 * @param ICD|CD $cd
	 */
	function beforePasswordResetConfirmation(Sb $sb, ICD $cd):void {B::reset($cd);}
}