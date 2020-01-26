<?php
namespace Dfe\Sift\T\CaseT\API;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Settings as S;
use Exception as E;
// 2020-01-25 https://sift.com/developers/docs/curl/events-api
final class Event extends \Dfe\Sift\T\CaseT {
	/** 2020-01-25 */
	function t00() {echo __METHOD__;}

	/** @test 2020-01-25 https://sift.com/developers/docs/curl/events-api/reserved-events/add-item-to-cart */
	function t01_add_item_to_cart() {
		$s = S::s(); /** @var S $s */
		try {
			$r = F::s()->post([
				// 2020-01-25 «Your Sift REST API key». Required, string.
				'api_key' => $s->backendKey()
				/**
				 * 2020-01-25
				 * «The user's current session ID,
				 * used to tie a user's action before and after log in or account creation.»
				 * Required if no user is provided, string.
				 */
				,'session_id' => \Dfe\Sift\Session::get()
				// 2020-01-25 Required, string.
				,'type' => '$add_item_to_cart'
				,'user_id' => df_customer_id()
			]);
			echo df_json_encode($r);
		}
		catch (E $e) {
			xdebug_break();
		}
	}
}