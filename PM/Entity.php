<?php
namespace Dfe\Sift\PM;
// 2020-02-02
final class Entity extends \Df\Config\ArrayItem {
	/**
	 * 2020-02-02
	 * @override
	 * @see \Df\Config\ArrayItem::id()
	 * @used-by \Df\Config\A::get()
	 * @return int
	 */
	function id() {return $this->v(null, self::mCode);}

	/**
	 * 2020-02-02     
	 * @used-by id()
	 * @used-by \Dfe\Sift\PM\FE::onFormInitialized()
	 */
	const mCode = 'mCode';
	/**
	 * 2020-02-02
	 * @used-by \Dfe\Sift\PM\FE::onFormInitialized()
	 */
	const sGateway = 'sGateway';
	/**
	 * 2020-02-02
	 * @used-by \Dfe\Sift\PM\FE::onFormInitialized()
	 */
	const sType = 'sType';
}