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

	
    public function __construct(
		\Nette\DI\Container $container, 
		\Kdyby\Doctrine\EntityManager $entityManager, 
		\h4kuna\Gettext\GettextSetup $translator, 
		\Nette\Security\User $user
	) {
        parent::__construct($container, $entityManager, $translator, $user, CurrencyEntity::class);
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

}