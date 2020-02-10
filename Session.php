<?php
namespace Dfe\Sift;
use Magento\Customer\Model\Session as Sess;
// 2020-01-26
final class Session {
	/**
	 * 2020-01-26
	 * @used-by \Dfe\Sift\API\B\Event::p()
	 * @used-by \Dfe\Sift\Plugin\Customer\CustomerData\Customer::afterGetSectionData()
	 * @return string
	 */
	static function get() {/** @var string $r */
		$m = 'SiftSessionId'; /** @var string $m */
		$sess = df_customer_session(); /** @var Sess $sess */
		if (!($r = $sess->__call("get$m", []))) {
			$sess->__call("set$m", [$r = df_uid()]);
		}
		return $r;
	}
}