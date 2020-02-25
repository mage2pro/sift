<?php
namespace Dfe\Sift\Controller\Index;
use Df\Framework\W\Result\Text;
use Magento\Framework\App\Action\HttpPostActionInterface as IPost;
/**
 * 2020-02-24
 * "Implement decision webhooks": https://github.com/mage2pro/sift/issues/12
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
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
	 * @return Text
	 */
	function execute() {
		/** @var Text $r */
		try {
			// 2020-02-25
			// Sift does not require any specific response and even seems not checking it,
			// so I use a response convenient for debugging.
			$r = Text::i('OK');
		}
		catch (\Exception $e) {
			df_500();
			$r = Text::i(df_ets($e));
			df_log($e, $this);
			if (df_my_local()) {
				throw $e; // 2016-03-27 It is convenient for me to the the exception on the screen.
			}
		}
		return $r;
	}
}