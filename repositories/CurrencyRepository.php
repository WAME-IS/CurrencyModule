<?php

namespace Wame\CurrencyModule\Repositories;

use Wame\Core\Repositories\BaseRepository;
use Wame\CurrencyModule\Entities\CurrencyEntity;


class CurrencyRepository extends BaseRepository
{
	const STATUS_REMOVE = 0;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;

	const MAIN_DISABLED = 0;
	const MAIN_ENABLED = 1;


    public function __construct()
    {
        parent::__construct(CurrencyEntity::class);
    }


	/**
	 * Update currency
	 *
	 * @param CurrencyEntity $currencyEntity
	 * @return CurrencyEntity
	 */
	public function update($currencyEntity)
	{
		return $currencyEntity;
	}


    /**
     * Get currency list
     *
     * @return array
     */
    public function getCurrencyList()
    {
        $return = [];

		$currencyEntity = $this->find([], ['code' => 'ASC']);

		foreach ($currencyEntity as $currency) {
			$return[$currency->getId()] = $currency->getCode() . ' - ' . $currency->getTitle() . ' - ' . $currency->getSymbol();
		}

		return $return;
    }

}