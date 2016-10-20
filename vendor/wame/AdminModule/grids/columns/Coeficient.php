<?php

namespace Wame\CurrencyModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;


class Coefficient extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('coefficient', _('Coefficient'));

		return $grid;
	}

}