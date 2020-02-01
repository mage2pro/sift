<?php
namespace Dfe\Sift\Payload;
use Magento\Sales\Api\Data\OrderAddressInterface as IA;
use Magento\Sales\Model\Order\Address as A;
/**
 * 2020-02-01 https://sift.com/developers/docs/curl/events-api/complex-field-types/address
 * «Address field type represents a physical address, such as a billing or shipping address.
 * The value must be a nested object with the appropriate address subfields.
 * We extract many geolocation features from these values.
 * An address is represented as a nested JSON object.»
 */
final class Address {
	/**
	 * 2020-02-01
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param IA|A|null $a
	 * @return array(string => mixed)
	 */
	static function p(IA $a = null) {return !$a ? [] : [
		// 2020-02-01 String. «Address first line, e.g., "2100 Main Street".»
		'address_1' => $a->getStreetLine(1)
		// 2020-02-01 String. «Address second line, e.g., "Apt 3B".»
		,'address_2' => $a->getStreetLine(2)
		// 2020-02-01 String. «The city or town name.»
		,'city' => $a->getCity()
		// 2020-02-01 String. «The ISO-3166 country code for the address.»
		,'country' => $a->getCountryId()
		// 2020-02-01 String.
		// «Provide the full name associated with the address here.
		// Concatenate first name and last name together if you collect them separately in your system.»
		,'name' => $a->getName()
		// 2020-02-01 String.
		// «The phone number associated with this address.
		// Provide the phone number as a string starting with the country code.
		// Use E.164 format or send in the standard national format of number's origin.
		// For example: "+14155556041" or "1-415-555-6041" for a U.S. number.»
		,'phone' => df_phone_format_clean($a, $a->getTelephone())
		// 2020-02-01 String. «The region portion of the address. In the USA, this corresponds to the state.»
		,'region' => $a->getRegion()
		// 2020-02-01 String.
		// «The postal code associated with the address, e.g., "90210".
		// Send +4 postal codes with a '-', e.g. "90210-3344"»
		,'zipcode' => $a->getPostcode()
	];}
}