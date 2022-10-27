<?php
namespace Dfe\Sift\API;
# 2020-01-25 https://sift.com/developers/docs/curl
final class Client extends \Df\API\Client {
	/**
	 * 2020-01-25
	 * @used-by self::responseValidatorC()
	 * @used-by \Dfe\Sift\API\Facade::adjustClient()
	 * @param bool|null|string $v [optional]
	 * @return self|IClientConfiguration
	 */
	function cfg($v = DF_N) {return df_prop($this, $v);}

	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Client::_construct()
	 * @used-by \Df\API\Client::__construct()
	 */
	protected function _construct() {
		parent::_construct();
		# 2020-02-05 Sift forbids empty keys.
		$this->addFilterReq('df_clean_r'); /** @uses df_clean_r() */;
		$this->addFilterReq(function(array $p) {return dfak_prefix($p, '$', true);});
		$this->reqJson();
		$this->resJson();
	}

	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Client::responseValidatorC()
	 * @used-by \Df\API\Client::_p()
	 */
	protected function responseValidatorC():string {return $this->cfg()->responseValidatorC();}

	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::url()
	 */
	protected function urlBase():string {return 'https://api.sift.com';}
}