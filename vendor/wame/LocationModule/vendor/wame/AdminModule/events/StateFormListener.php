<?php

namespace Wame\CurrencyModule\Vendor\Wame\LocationModule\Vendor\Wame\AdminModule\Events;

use Nette\Object;
use Wame\CurrencyModule\Repositories\CurrencyRepository;
use Wame\LocationModule\Repositories\StateRepository;


class StateFormListener extends Object 
{
	/** @var CurrencyRepository */
	private $currencyRepository;
	
	/** @var StateRepository */
	private $stateRepository;


	public function __construct(
		CurrencyRepository $currencyRepository,
		StateRepository $stateRepository
	) {
		$this->currencyRepository = $currencyRepository;
		$this->stateRepository = $stateRepository;
		
		$stateRepository->onCreate[] = [$this, 'onCreate'];
		$stateRepository->onUpdate[] = [$this, 'onUpdate'];
	}

	
	public function onCreate($form, $values, $stateEntity) 
	{
		$currencyEntity = $this->currencyRepository->get(['id' => $values['currency']]);
		
		$stateEntity->setCurrency($currencyEntity);
	}
	
	
	public function onUpdate($form, $values, $stateEntity)
	{
		$currencyEntity = $this->currencyRepository->get(['id' => $values['currency']]);
		
		$stateEntity->setCurrency($currencyEntity);
	}

}
