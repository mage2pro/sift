<?php
namespace Dfe\Sift;
use Dfe\Sift\Settings as S;
use \Closure as F;
# 2020-02-01
final class Observer {
	/**
	 * 2020-02-01
	 * 2020-02-11
	 * Currently, the $backend argument is always `false`.
	 * A version with a $backend = `true` case: https://github.com/mage2pro/sift/tree/0.2.6-backend
	 * @used-by \Dfe\Sift\API\B\Event\UpdatePassword::p()
	 * @used-by \Dfe\Sift\Observer\Customer\Login::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\Logout::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\RegisterSuccess::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\ProductAddAfter::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\RemoveItem::execute()
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @used-by \Dfe\Sift\Plugin\Customer\Api\AccountManagementInterface::aroundAuthenticate()
	 */
	static function f(F $f, bool $backend = false):void {
		try {$backend xor df_is_backend() or !S::s()->enable() or $f();}
		# 2023-08-03 "Treat `\Throwable` similar to `\Exception`": https://github.com/mage2pro/core/issues/311
		catch (\Throwable $t) {df_log($t);}
	}
}