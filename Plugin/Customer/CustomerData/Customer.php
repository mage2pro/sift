<?php
namespace Dfe\Sift\Plugin\Customer\CustomerData;
use Magento\Customer\CustomerData\Customer as Sb;
# 2020-01-26
final class Customer {
	/**
	 * 2020-01-26
	 * I do not use @see df_customer_session_id() because it is regenerated in many cases (e.g., on login or signup).
	 * @see \Magento\Customer\CustomerData\Customer::getSectionData()
	 * @param array(string => mixed) $r
	 * @return array(string => mixed)
	 */
	function afterGetSectionData(Sb $sb, array $r) {return ['siftSessionId' => \Dfe\Sift\Session::get()] + $r;}
}