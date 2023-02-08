<?php
namespace Dfe\Sift\API\B;
use Df\API\Operation as Op;
use Dfe\Sift\API\Facade\GetDecisions as F;
use Dfe\Sift\Settings as S;
# 2020-02-27
final class GetDecisions {
	/**
	 * 2020-02-27
	 * 1) "Retrieve decisions configuration from Sift": https://github.com/mage2pro/sift/issues/19
	 * 2) https://sift.com/developers/docs/curl/decisions-api/decisions-list
	 * @used-by \Dfe\Sift\Test\CaseT\API\Account\Decisions::t01()
	 * 2020-02-29
	 * 1) «Entity type to which this Decision is applicable.
	 * Possible values:
	 * 		`content`: The Decision should be applied to content.
	 * 		`order`: This Decision should be applied to orders.
	 * 		`session`: The Decision should be applied to sessions.
	 * 		`user`: This Decision should be applied to users.»
	 * https://sift.com/developers/docs/curl/decisions-api/decisions-list
	 * 3) «The type of entity on which the Decision was taken.
	 * Possible values:
	 * 		`content`: This entity is a content.
	 * 		`order`: This entity is an order.
	 * 		`session`: This entity is a session.
	 * 		`user`: This entity is a user.»
	 * https://sift.com/developers/docs/curl/decisions-api/decision-webhooks/message-body
	 * @return Op
	 */
	static function decisions(string $type = ''):Op {return F::s()->get(null);}
}