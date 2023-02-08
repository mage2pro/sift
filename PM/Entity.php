<?php
namespace Dfe\Sift\PM;
# 2020-02-02
/** @used-by \Dfe\Sift\Settings::pm() */
final class Entity extends \Df\Config\ArrayItem {
	/**
	 * 2020-02-02
	 * @override
	 * @see \Df\Config\ArrayItem::id()
	 * @used-by \Df\Config\A::get()
	 */
	function id():string {return $this->v(null, self::mCode);}

	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Payment::p()
	 * @return string|null
	 */
	function sGateway() {return $this->v0();}

	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Payment::p()
	 */
	function sType():string {return $this->v0();}

	/**
	 * 2020-02-02     
	 * @used-by self::id()
	 * @used-by \Dfe\Sift\PM\FE::onFormInitialized()
	 */
	const mCode = 'mCode';
	/**
	 * 2020-02-02
	 * @used-by self::sGateway()
	 * @used-by \Dfe\Sift\PM\FE::onFormInitialized()
	 */
	const sGateway = 'sGateway';
	/**
	 * 2020-02-02
	 * @used-by \Dfe\Sift\PM\FE::onFormInitialized()
	 */
	const sType = 'sType';
}