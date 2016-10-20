<?php

namespace Wame\CurrencyModule\Vendor\Wame\AdminModule\Grids\Columns;

use Wame\DataGridControl\BaseGridItem;


class Symbol extends BaseGridItem
{
	/** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addColumnText('symbol', _('Symbol'));

		return $grid;
	}

}