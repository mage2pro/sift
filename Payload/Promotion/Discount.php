<?php
namespace Dfe\Sift\Payload\Promotion;
use Magento\Sales\Model\Order as O;
/**
 * 2020-02-04
 * «The Promotion field type generically models different kinds of promotions
 * such as referrals, coupons, free trials, etc.
 * The value must be a nested JSON object
 * which you populate with the appropriate information to describe the promotion.
 * Not all sub-fields will likely apply to a given promotion. Populate only those that apply.
 * A promotion can be added when creating or updating an account, creating or updating an order,
 * or on its own using the `$add_promotion` event.
 * The promotion object supports both monetary (e.g. $25 coupon on first order)
 * and non-monetary (e.g. "1000 in game points to refer a friend").»
 * https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
 */
final class Discount {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Promotions::p()
	 * @param O $o
	 * @return array(string => mixed)
	 */
	static function p(O $o) {return [
		// 2020-02-04 String. «STUB»
		// «The `credit_point` field type generically models monetary and non-monetary rewards
		// (e.g. in-game currency, stored account value, MBs storage, frequent flyer miles, etc.) for a promotion.
		// Most promotions likely require a `credit_point` object or `discount` object to describe them,
		// though both can be set for a given promotion.»
		// https://sift.com/developers/docs/curl/events-api/complex-field-types/credit-point
		'credit_point' => []
		// 2020-02-04 String. «Freeform text to describe the promotion.»
		,'description' => ''
		// 2020-02-04 String.
		// «The `discount` field type generically models monetary discounts that are associated with a promotion
		// (e.g. $25 off an order of $100 or more, 10% off, etc).
		// Most promotions likely require a `discount` object or `credit_point` object to describe them,
		// though both can be set for a given promotion.»
		// https://sift.com/developers/docs/curl/events-api/complex-field-types/discount
		,'discount' => []
		// 2020-02-04 String.
		// «When adding a promotion fails, use this to describe why it failed.
		// Allowed values: `already_used`, `expired`, `invalid_code`, `not_applicable`»
		,'failure_reason' => ''
		// 2020-02-04 String.
		// «The ID within your system that you use to represent this promotion.
		// This ID is ideally unique to the promotion across users (e.g. "BackToSchool2016").»
		,'promotion_id' => ''
		// 2020-02-04 String.
		// «The unique account ID of the user who referred the user to this promotion.
		// Note: User IDs are case sensitive.»
		,'referrer_user_id' => ''
		// 2020-02-04 String.
		// «The status of the addition of promotion to an account.
		// Best used with the `$add_promotion event.`
		// This way you can pass to Sift both successful and failed attempts when using a promotion.
		// May be useful in spotting potential abuse.»
		,'status' => '$success'
	];}
}