<?php

namespace Wame\CurrencyModule\Vendor\Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\CurrencyModule\Repositories\CurrencyRepository;


interface ICurrencyFormContainerFactory
{
	/** @return CurrencyFormContainer */
	public function create();
}


class CurrencyFormContainer extends BaseFormContainer
{
	/** @var CurrencyRepository */
	private $currencyRepository;
	
	/** @var array */
	private $currencyList;
	
	
	public function __construct(
		CurrencyRepository $currencyRepository
	) {
		parent::__construct();

		$this->currencyRepository = $currencyRepository;

		$this->currencyList = $this->getCurrencies();
	}
	
	
	private function getCurrencies()
	{
		$return = [];
		
		$currencyEntity = $this->currencyRepository->find(['status !=' => CurrencyRepository::STATUS_REMOVE], ['code']);

		foreach ($currencyEntity as $currency) {
			$return[$currency->getId()] = $currency->getCode() . ' - ' . $currency->getTitle() . ' - ' . $currency->getSymbol();
		}
		
		return $return;
	}
	
	
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();

		$form->addSelect('currency', _('Currency'), $this->currencyList)
				->setPrompt('- ' . _('Select currency') . ' -')
				->setRequired(_('Please select currency'));
    }
	
	
	public function setDefaultValues($stateForm)
	{
		$form = $this->getForm();
		
		if (isset($this->currencyList[$stateForm->stateEntity->currency->id])) {
			$form['currency']->setDefaultValue($stateForm->stateEntity->currency->id);
		}
	}

}