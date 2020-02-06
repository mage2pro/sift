<?php
namespace Dfe\Sift\API\B;
use Dfe\Sift\API\Facade\Event as F;
use Dfe\Sift\Payload\Browser as pBrowser;
// 2020-02-06
final class Event {
	/**
	 * 2020-02-06
	 * @used-by \Dfe\Sift\Observer\Customer\RegisterSuccess::execute()
	 * @used-by \Dfe\Sift\Observer\Quote\ProductAddAfter::execute()
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param string $type
	 * @param array(string => mixed) $p
	 */
	static function p($type, array $p) {F::s()->post($p + pBrowser::p() + ['type' => sift_prefix($type)]);}
}