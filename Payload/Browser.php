<?php
namespace Dfe\Sift\Payload;
/**
 * 2020-01-26
 * «The user agent of the browser that is used to add the item to cart.
 * Represented by the `browser` object.
 * Use this field if the client is a browser.
 * Note: cannot be used in conjunction with `app`.»
 * 2020-01-30
 * An empty value leads to the error: «Invalid field value(s) for fields: $.$browser.$user_agent».
 * 2020-02-01 https://sift.com/developers/docs/curl/events-api/complex-field-types/browser
 */
final class Browser {
	/**
	 * 2020-02-01
	 * @used-by \Dfe\Sift\API\B\Event::p()
	 * @return array(string => mixed)
	 */
	static function p() {return ['browser' => ['user_agent' => df_request_ua() ?: 'CLI']];}
}