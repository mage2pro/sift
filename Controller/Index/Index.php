<?php
namespace Dfe\Sift\Controller\Index;
use Df\Framework\W\Result\Text;
use Dfe\Sift\Settings as S;
use Magento\Framework\App\Action\HttpPostActionInterface as IPost;
/**
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * 2020-02-24 "Implement decision webhooks": https://github.com/mage2pro/sift/issues/12
 * 2020-02-25
 * A payload example:
 * 	{
 * 		"decision": {"id": "watch_payment_abuse"},
 * 		"entity": {"id": "000001411", "type": "order"},
 * 		"time": 1582594290717
 * 	}
 */
class Index extends \Df\Framework\Action implements IPost {
	/**
	 * 2020-02-24
	 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
	 * @override
	 * @see \Magento\Framework\App\Action\Action::execute()
	 * @used-by \Magento\Framework\App\Action\Action::dispatch():
	 * 		$result = $this->execute();
	 * https://github.com/magento/magento2/blob/2.2.1/lib/internal/Magento/Framework/App/Action/Action.php#L84-L125
	 */
	function execute():Text {
		/** @var Text $r */
		try {
			$this->checkSignature();
			$d = df_request_body_json(); /** @var array(string => mixed) $d */
			# 2020-02-25
			# Sift does not require any specific response and even seems not checking it,
			# so I use a response convenient for debugging.
			$r = Text::i('OK');
		}
		catch (\Exception $e) {
			df_500();
			$r = Text::i(df_xts($e));
			df_log($e, $this);
			if (df_my_local()) {
				throw $e; # 2016-03-27 It is convenient for me to the the exception on the screen.
			}
		}
		return $r;
	}

	/**
	 * 2020-02-25 https://sift.com/developers/docs/php/decisions-api/decision-webhooks/authentication
	 * @used-by self::execute()
	 */
	private function checkSignature():void {
		# 2020-02-25
		# 1) A signature looks like «sha1=c85f8e483b5343ae073b88d4311252b77bdc8ecd»
		# 2) @todo "Provide an ability to set different Sift credentials for each Magento store
		# inside a single Magento installation": https://github.com/mage2pro/sift/issues/17
		$h = 'X-Sift-Science-Signature'; /** @const string $h */
		$setting = '«Signature Key»'; /** @const string $setting */
		if (!($s1 = df_request_header($h))) { /** @var string $s1 */
			df_error(
				"Sift requests this URL when an administrator makes a decision in the Sift console.\nThe current request is rejected by the Magento's Sift module because the request lacks the `$h` HTTP header (https://sift.com/developers/docs/php/decisions-api/decision-webhooks/authentication).");
		}
		if ($s1 !== ($s2 = 'sha1=' . hash_hmac('sha1', df_request_body(), S::s()->signatureKey()))) {
			df_error("The $setting value (https://mage2.pro/t/6099) in the Sift module's settings in your Magento backend is invalid (it does not match the decision notification).\nThe signature of the notification is «{$s1}» (it is provided in the `$h` HTTP header).\nThe expected signature (calculated using the $setting value from you Magento backend) is «{$s2}».");
		}
	}
}