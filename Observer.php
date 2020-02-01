<?php
namespace Dfe\Sift;
use Closure as F;
use Dfe\Sift\Settings as S;
use Exception as E;
// 2020-02-01
final class Observer {
	/**
	 * 2020-02-01
	 * @used-by \Dfe\Sift\Observer\Quote\ProductAddAfter::execute()
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param F $f
	 */
	static function f(F $f) {
		try {
			$s = S::s(); /** @var S $s */
			if ($s->enable()) {
				$f();
			}
		}
		catch (E $e) {df_log($e, __CLASS__);}
	}
}