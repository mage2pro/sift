<?php
namespace Dfe\Sift\Payload;
use Magento\Sales\Model\Order as O;
/**
 * 2020-02-03
 * 1) Array Of Promotions: https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
 * 2) «The list of promotions that apply to this order.
 * You can add one or more promotions when creating or updating an order.
 * You can also separately add promotions to the account via the `$add_promotion` event.»
 * https://sift.com/developers/docs/curl/events-api/reserved-events/create-order
 */
final class Promotions {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param O $o
	 * @return array(string => mixed)
	 */
	static function p(O $o) {return [];}
}