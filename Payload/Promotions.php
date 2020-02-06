<?php
namespace Dfe\Sift\Payload;
use Magento\Sales\Model\Order as O;
use Dfe\Sift\Payload\Promotion\Discount as pDiscount;
/**
 * 2020-02-04
 * 1) Array Of Promotions: https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
 * 2) «The list of promotions that apply to this order.
 * You can add one or more promotions when creating or updating an order.
 * You can also separately add promotions to the account via the `add_promotion` event.»
 * https://sift.com/developers/docs/curl/events-api/reserved-events/create-order
 * 3) «The Promotion field type generically models different kinds of promotions
 * such as referrals, coupons, free trials, etc.
 * The value must be a nested JSON object
 * which you populate with the appropriate information to describe the promotion.
 * Not all sub-fields will likely apply to a given promotion. Populate only those that apply.
 * A promotion can be added when creating or updating an account, creating or updating an order,
 * or on its own using the `add_promotion` event.
 * The promotion object supports both monetary (e.g. $25 coupon on first order)
 * and non-monetary (e.g. "1000 in game points to refer a friend").»
 * https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
 */
final class Promotions {
	/**
	 * 2020-02-04
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param O $o
	 * @return array(string => mixed)
	 */
	static function p(O $o) {return df_clean([pDiscount::p($o)]);}
}