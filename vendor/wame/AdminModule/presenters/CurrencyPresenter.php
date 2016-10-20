<?php

namespace App\AdminModule\Presenters;

use Wame\CurrencyModule\Entities\CurrencyEntity;
use Wame\CurrencyModule\Repositories\CurrencyRepository;
use Wame\DynamicObject\Vendor\Wame\AdminModule\Presenters\AdminFormPresenter;


class CurrencyPresenter extends AdminFormPresenter
{
	/** @var CurrencyRepository @inject */
	public $repository;

	/** @var CurrencyEntity */
	protected $entity;


    /** renders ***************************************************** */

	public function renderDefault()
	{
		$this->template->siteTitle = _('Currencies');
	}


	public function renderEdit()
	{
		$this->template->siteTitle = $this->entity->getTitle();
	}


    /** abstract methods ***************************************************** */

    /** {@inheritdoc} */
    protected function getFormBuilderServiceAlias()
    {
        return 'Admin.CurrencyFormBuilder';
    }


    /** {@inheritdoc} */
    protected function getGridServiceAlias()
    {
        return 'Admin.CurrencyGrid';
    }

}
