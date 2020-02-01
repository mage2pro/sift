<?php
/**
 * 2020-02-01
 * 1) $39.99 => 39990000 https://sift.com/developers/docs/curl/events-api/reserved-events/add-item-to-cart
 * 2) «1 cent = 10,000 micros.
 * $1.23 USD = 123 cents = 1,230,000 micros.
 * For currencies without cents of fractional denominations, like the Japanese Yen, use 1 JPY = 1000000 micros.»
 * https://sift.com/developers/docs/curl/events-api/reserved-events/create-order
 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
 * @used-by \Dfe\Sift\Payload\OQI::p()
 * @param int|float $v
 * @return int
 */
function sift_amt($v) {return round(10**6 * $v);}
