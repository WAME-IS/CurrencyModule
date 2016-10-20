<?php

namespace Wame\CurrencyModule\Vendor\Wame\LocationModule\Vendor\Wame\AdminModule\Forms\State\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;
use Wame\CurrencyModule\Repositories\CurrencyRepository;


interface ICurrencyContainerFactory extends IBaseContainer
{
    /** @return CurrencyContainer */
    public function create();
}


class CurrencyContainer extends BaseContainer
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
		$this->currencyList = $currencyRepository->getCurrencyList();
	}


    /** {@inheritDoc} */
    public function configure()
    {
        $this->addSelect('currency', _('Currency'), $this->currencyList)
				->setPrompt('- ' . _('Select currency') . ' -')
				->setRequired(_('Please select currency'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['currency']->setDefaultValue($entity->getCurrency()->getId());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $currencyEntity = $this->currencyRepository->get(['id' => $values['currency']]);

        $form->getEntity()->setCurrency($currencyEntity);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $currencyEntity = $this->currencyRepository->get(['id' => $values['currency']]);

        $form->getEntity()->setCurrency($currencyEntity);
    }

}
