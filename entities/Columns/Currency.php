<?php

namespace Wame\CurrencyModule\Entities\Columns;

trait Currency
{
    /**
	 * @ORM\ManyToOne(targetEntity="\Wame\CurrencyModule\Entities\CurrencyEntity")
	 * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
	 */
	protected $currency;


	/** get ************************************************************/

	public function getCurrency()
	{
		return $this->currency;
	}


	/** set ************************************************************/

	public function setCurrency($currency)
	{
		$this->currency = $currency;
		
		return $this;
	}

}