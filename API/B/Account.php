<?php
namespace Dfe\Sift\API\B;
use Df\API\Operation as Op;
use Dfe\Sift\API\Facade\Account as F;
use Dfe\Sift\Settings as S;
// 2020-02-27
final class Account {
	/**
	 * 2020-02-27
	 * 1) "Retrieve decisions configuration from Sift": https://github.com/mage2pro/sift/issues/19
	 * 2) https://sift.com/developers/docs/curl/decisions-api/decisions-list
	 * @used-by \Dfe\Sift\Test\CaseT\API\Account\Decisions::t01()
	 * @return Op
	 */
	static function decisions() {return F::s()->get(S::s()->merchantID(), 'decisions');}
}