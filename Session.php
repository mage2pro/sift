<?php
namespace Dfe\Sift;
use Magento\Backend\Model\Auth\Session as SessionB;
use Magento\Customer\Model\Session as SessionC;
# 2020-01-26
final class Session {
	/**
	 * 2020-01-26
	 * @used-by \Dfe\Sift\API\B\Event::p()
	 * @used-by \Dfe\Sift\Plugin\Customer\CustomerData\Customer::afterGetSectionData()
	 * @return string
	 */
	static function get() {/** @var string $r */
		$m = 'SiftSessionId'; /** @var string $m */
		$s = df_session(); /** @var SessionB|SessionC $s */
		if (!($r = $s->__call("get$m", []))) {
			$s->__call("set$m", [$r = df_uid()]);
		}
		return $r;
	}
}