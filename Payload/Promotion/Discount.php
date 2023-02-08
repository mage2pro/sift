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
 * or on its own using the `add_promotion` event.
 * The promotion object supports both monetary (e.g. $25 coupon on first order)
 * and non-monetary (e.g. "1000 in game points to refer a friend").»
 * https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
 */
final class Discount {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Promotions::p()
	 * @return array(string => mixed)
	 */
	static function p(O $o):array {return !($a = $o->getDiscountAmount()) ? [] : [
		# 2020-02-04 String. «STUB»
		# «The `credit_point` field type generically models monetary and non-monetary rewards
		# (e.g. in-game currency, stored account value, MBs storage, frequent flyer miles, etc.) for a promotion.
		# Most promotions likely require a `credit_point` object or `discount` object to describe them,
		# though both can be set for a given promotion.»
		# https://sift.com/developers/docs/curl/events-api/complex-field-types/credit-point
		'credit_point' => []
		# 2020-02-04 String. «Freeform text to describe the promotion.»
		,'description' => self::desc($o)
		/**
		 * 2020-02-04 Discount: https://sift.com/developers/docs/curl/events-api/complex-field-types/discount
		 * «The `discount` field type generically models monetary discounts that are associated with a promotion
		 * (e.g. $25 off an order of $100 or more, 10% off, etc).
		 * Most promotions likely require a `discount` object or `credit_point` object to describe them,
		 * though both can be set for a given promotion.»
		 */
		,'discount' => [
			# 2020-02-04 String.
			# «The amount of the discount that the promotion offers in micros in the base unit of the `currency_code`.
			# 1 cent = 10,000 micros. $1.23 USD = 123 cents = 1,230,000 micros.
			# For currencies without cents of fractional denominations, like the Japanese Yen,
			# use 1 JPY = 1000000 micros.»
			'amount' => abs(sift_amt($o->getDiscountAmount()))
			# 2020-02-04 String.
			# «ISO-4217 currency code for the amount. e.g., USD, CAD, HKD.
			# If your site uses alternative currencies, like bitcoin or points systems, specify that here.»
			,'currency_code' => $o->getOrderCurrencyCode()
			# 2020-02-04 Integer.
			//«The minimum amount someone must spend in order for the promotion to be applied.
			# The amount should be in micros in the base unit of the `currency_code`.
			# 1 cent = 10,000 micros. $1.23 USD = 123 cents = 1,230,000 micros.
			# For currencies without cents of fractional denominations, like the Japanese Yen,
			# use 1 JPY = 1000000 micros.»
			,'minimum_purchase_amount' => 0
			# 2020-02-04 Float. «The percentage discount. If the discount is 10% off, you would send "0.1".»
			,'percentage_off' => abs($o->getDiscountAmount()) / $o->getGrandTotal()
		]
		# 2020-02-04 String.
		# «When adding a promotion fails, use this to describe why it failed.
		# Allowed values: `already_used`, `expired`, `invalid_code`, `not_applicable`»
		,'failure_reason' => ''
		/**
		 * 2020-02-04 String.
		 * «This ID is ideally unique to the promotion across users (e.g. "BackToSchool2016").
		 * The ID within your system that you use to represent this promotion.»
		 * 2020-02-05
		 * Sift rejects all my values (e.g. `self::desc($o)`) despite it does not state any requirements to values.
		 */
		,'promotion_id' => null
		# 2020-02-04 String.
		# «The unique account ID of the user who referred the user to this promotion.
		# Note: User IDs are case sensitive.»
		,'referrer_user_id' => ''
		# 2020-02-04 String.
		# «The status of the addition of promotion to an account.
		# Best used with the `add_promotion event.`
		# This way you can pass to Sift both successful and failed attempts when using a promotion.
		# May be useful in spotting potential abuse.»
		,'status' => '$success'
	];}

	/**
	 * 2020-02-04
	 * @used-by self::p()
	 * @param O $o
	 * @return string
	 */
	private static function desc(O $o) {return dfcf(function(O $o) {return df_desc(
		$o['coupon_rule_name'], $o->getCouponCode() ?: $o->getDiscountDescription()
	);}, [$o]);}
}