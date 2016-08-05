<?php 

namespace Wame\CurrencyModule\Vendor\Wame\SettingsModule\Models;

use Wame\SettingsModule\Registers\Types\SettingsGroup;
use Wame\CurrencyModule\Vendor\Wame\SettingsModule\Components\ICurrencyListControlFactory;


class Currency extends SettingsGroup
{
	/** @var ICurrencyListControlFactory */
	private $ICurrencyListControlFactory;
	
	
	public function __construct(
		ICurrencyListControlFactory $ICurrencyListControlFactory
	) {
		parent::__construct();
		
		$this->ICurrencyListControlFactory = $ICurrencyListControlFactory;
	}
	
	
	public function getComponentServices()
	{
		$this->addService($this->ICurrencyListControlFactory->create(), 'currencyList');
		
		return $this;
	}
	
	
	public function getTitle()
	{
		return _('Currency');
	}

}