<?php
namespace Dfe\Sift\PM;
use Dfe\Sift\PM\Entity as O;
/**
 * 2020-02-02
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * This class is not a singleton:
 * @see \Magento\Framework\Data\Form\AbstractForm::addField():
 * 		$element = $this->_factoryElement->create($type, ['data' => $config]);
 * https://github.com/magento/magento2/blob/2.2.0-RC1.8/lib/internal/Magento/Framework/Data/Form/AbstractForm.php#L137-L159
 */
class FE extends \Df\Framework\Form\Element\Fieldset {
	/**
	 * 2020-02-02
	 * @override
	 * @see \Df\Framework\Form\Element\Fieldset::onFormInitialized()
	 * @used-by \Df\Framework\Plugin\Data\Form\Element\AbstractElement::afterSetForm()
	 */
	final function onFormInitialized() {
		parent::onFormInitialized();
		$this->addClass('dfe-sift-pm'); // 2016-07-30 This CSS class will be applied to the <fieldset> DOM node.
		$this->select(O::mCode, 'Magento Payment Method', dfp_methods_o(), [], [self::EMPTY => 1]);
		$this->select(O::sType, 'Sift Payment Type', df_module_enum($this, 'payment/type'), [], [self::EMPTY => 1]);
		$this->select(
			O::sGateway, 'Sift Payment Gateway', df_module_enum($this, 'payment/provider'), [], [self::EMPTY => 1]
		);
		df_fe_init($this, __CLASS__, [], [], 'partner');
	}
}