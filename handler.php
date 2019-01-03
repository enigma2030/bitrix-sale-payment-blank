<?php
namespace Sale\Handlers\PaySystem;

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Sale;

Loc::loadMessages(__FILE__);

class BlankPaymentHandler extends PaySystem\ServiceHandler
{
	/**
 	* @return array
 	*/
	static public function getIndicativeFields()
	{
		return ['PAYMENT_STATUS'];
	}

	/**
 	* @param Request $request
 	* @param $paySystemId
 	* @return bool
 	*/
	static protected function isMyResponseExtended(Main\Request $request, $paySystemId)
	{
		return true;
	}

	/**
	* @param Payment $payment
 	* @param Request|null $request
 	* @return PaySystem\ServiceResult
 	*/
	public function initiatePay(Sale\Payment $payment, Main\Request $request = null)
	{
		$params = [
			'PROPERTY_2' => 'PROPERTY_2_VALUE'
		];

    	$this->setExtraParams($params);

		return $this->showTemplate($payment, 'template');
	}

	/**
 	* @param Payment $payment
 	* @param Request $request
 	* @return PaySystem\ServiceResult
	*/
	public function processRequest(Sale\Payment $payment, Main\Request $request)
	{
		$result = new Sale\PaySystem\ServiceResult();
		$status = $request->get('PAYMENT_STATUS');

		$data = [
			'PAYED' => true
		];

		switch ($status) {
			case 'SUCCESS':
			 	$result->setData($data);
				break;
			
			default:
				$result->addError(new Main\Error(Loc::getMessage('PAYMENT_PROCESS_ERROR')));
				break;
		}

		if (!$result->isSuccess()) {
	        Sale\PaySystem\ErrorLog::add([
	            'ACTION' => 'processRequest',
	            'MESSAGE' => join('\n', $result->getErrorMessages())
	        ]);
	    }

		return $result;
	}

	/**
 	* @param Request $request
 	* @return mixed
 	*/
	public function getPaymentIdFromRequest(Main\Request $request)
	{
		return $request->get('PAYMENT_ID');
	}

	/**
 	* @return array
 	*/
	public function getCurrencyList()
	{
		return array('KZT');
	}
}