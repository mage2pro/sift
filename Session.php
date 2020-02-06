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
	static function get() {
		$k = 'siftSessionId'; /** @var string $k */
		$m = ucfirst($k); /** @var string $m */
		$sess = df_customer_session(); /** @var Sess $sess */
		if (!($r = $sess->__call("get$m", []))) { /** @var string $r */
			$sess->__call("set$m", [$r = df_uid()]);
		}
		return $r;
	}
}