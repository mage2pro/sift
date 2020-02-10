<?php
namespace Dfe\Sift;
use Closure as F;
use Dfe\Sift\Settings as S;
use Exception as E;
// 2020-02-01
final class Observer {
	/**
	 * 2020-02-01
	 * @used-by \Dfe\Sift\Observer\Customer\Login::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\Logout::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\RegisterSuccess::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\ProductAddAfter::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\RemoveItem::execute()
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @used-by \Dfe\Sift\Plugin\Customer\Api\AccountManagementInterface::aroundAuthenticate()
	 * @param F $f
	 */
	static function f(F $f) {
		try {df_is_backend() || !S::s()->enable() || $f();}
		catch (E $e) {df_log($e, __CLASS__);}
	}
}