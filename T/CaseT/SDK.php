<?php
namespace Dfe\Sift\T\CaseT;
use Dfe\Sift\Settings as S;
use SiftClient as C;
use SiftResponse as Res;
// 2020-01-20 https://github.com/SiftScience/sift-php
final class SDK extends \Dfe\Sift\T\CaseT {
	/** 2020-01-20 */
	function t00() {echo __METHOD__;}

	/** @test 2020-01-20 */
	function t01() {
		$s = S::s(); /** @var S $s */
		$c = new C(['account_id' => $s->merchantID(), 'api_key' => $s->backendKey()]); /** @var C $c */
		$r = $c->track('$transaction', [
			'$amount' => 15230000,
			'$currency_code' => 'USD',
			'$seller_user_id' => '2371',
			'$time' => 1327604222,
			'$transaction_id' => '573050',
			'$user_email' => 'buyer@gmail.com',
			'$user_id' => '23056',
			'distance_traveled' => 5.26,
			'seller_user_email' => 'seller@gmail.com',
			'trip_time' => 930
		]); /** @var Res $r */
		echo df_json_prettify($r->rawResponse);
	}
}