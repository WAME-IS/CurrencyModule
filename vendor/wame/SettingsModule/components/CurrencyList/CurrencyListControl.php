<?php 

namespace Wame\CurrencyModule\Vendor\Wame\SettingsModule\Components;

use Nette\DI\Container;
use Wame\Core\Components\BaseControl;
use Wame\CurrencyModule\Repositories\CurrencyRepository;
use Wame\CurrencyModule\Vendor\Wame\SettingsModule\Forms\CurrencyListForm;


interface ICurrencyListControlFactory
{
	/** @return CurrencyListControl */
	public function create();	
}


class CurrencyListControl extends BaseControl
{
	/** @var CurrencyRepository */
	private $currencyRepository;
	
	/** @var CurrencyListForm */
	public $currencyListForm;
	
	/** @var array */
	private $currencies = [];	
	
	
	public function __construct(
    Container $container,
		CurrencyRepository $currencyRepository,
		CurrencyListForm $currencyListForm
	) {
		parent::__construct($container);
		
		$this->currencyRepository = $currencyRepository;
		$this->currencyListForm = $currencyListForm;
	}
	
	
	protected function createComponentCurrencyListForm()
	{
		$form = $this->currencyListForm->build();
		
		return $form;
	}
	
	
	public function render()
	{
		$this->template->currencies = $this->currencyRepository->find(['status !=' => CurrencyRepository::STATUS_REMOVE]);
	}

}