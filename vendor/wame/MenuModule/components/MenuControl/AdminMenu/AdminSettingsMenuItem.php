<?php

namespace Wame\CurrencyModule\Vendor\Wame\MenuModule\Components\MenuControl\AdminMenu;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\Item;

interface IAdminSettingsMenuItem
{
	/** @return AdminSettingsMenuItem */
	public function create();
}


class AdminSettingsMenuItem implements \Wame\MenuModule\Models\IMenuItem
{	
    /** @var LinkGenerator */
	private $linkGenerator;
	
	
	public function __construct(
		LinkGenerator $linkGenerator
	) {
		$this->linkGenerator = $linkGenerator;
	}

	
	public function addItem()
	{
		$item = new Item();
		$item->setName('settings');
        
        $item->addNode($this->settingsCurrency(), 'currency');
		
		return $item->getItem();
	}
    
    
    private function settingsCurrency()
    {
        $item = new Item();
        $item->setName('settings-currency');
        $item->setTitle(_('Currency'));
        $item->setLink($this->linkGenerator->link('Admin:Settings:default', ['id' => 'Currency']));
        
        return $item->getItem();
    }

}
