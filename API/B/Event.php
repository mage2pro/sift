<?php
namespace Dfe\Sift\API\B;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Payload\Browser as pBrowser;
use Dfe\Sift\Settings as S;
// 2020-02-06
final class Event {
	/**
	 * 2020-02-06
	 * 1) https://sift.com/developers/docs/curl/events-api/fields
	 * 2) $p should be places on the left side of the `+` expression
	 * because @see \Dfe\Sift\Observer\Customer\RegisterSuccess::execute() provides a custom `user_id`
	 * (@see df_customer_id() does not work correctly in this scenario).
	 * @used-by \Dfe\Sift\Observer\Customer\Login::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\Logout::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\RegisterSuccess::execute()
	 * @used-by \Dfe\Sift\Observer\Customer\SaveAfterDataObject::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\ProductAddAfter::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\RemoveItem::execute()
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @used-by \Dfe\Sift\Plugin\Customer\Api\AccountManagementInterface::aroundAuthenticate()
	 * @param string $type
	 * @param array(string => mixed) $p [optional]
	 */
	static function p($type, array $p = []) {F::s()->post($p + pBrowser::p() + [
		// 2020-01-25 «Your Sift REST API key». Required, string.
		'api_key' => S::s()->backendKey()
	   /**
		* 2020-01-26
		* Optional, string.
		* «IP address of the request made by the user.
		* Recommended for historical backfills and customers with mobile apps.»
		*/
		,'ip' => df_visitor_ip()
		/**
		 * 2020-01-25
		 * «The user's current session ID,
		 * used to tie a user's action before and after log in or account creation.»
		 * Required if no user is provided, string.
		 */
		,'session_id' => \Dfe\Sift\Session::get()
	   /**
		* 2020-01-26
		* Optional, integer.
		* «Represents the time the event occurred in your system.
		* Send as a UNIX timestamp in milliseconds as shown in the historical backfill tutorial.»
		* https://sift.com/resources/tutorials/sending-historical-data
		*/
		,'time' =>  time()
		,'type' => sift_prefix($type)
		/**
		 * 2020-01-26
		 * Required, string.
		 * «The user’s internal account ID.
		 * This field is required on all events performed by the user while logged in.
		 * Users without an assigned $user_id will not show up in the console.
		 * Note: User IDs are case sensitive.
		 * You may need to normalize the capitalization of your user IDs.
		 * Only the following characters may be used:a-z,A-Z,0-9,=, ., -, _, +, @, :, &, ^, %, !, $»
		 * https://sift.com/developers/docs/curl/events-api/fields
		 */
		,'user_id' => df_customer_id()
	]);}
}