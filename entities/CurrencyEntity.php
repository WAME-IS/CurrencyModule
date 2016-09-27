<?php

namespace Wame\CurrencyModule\Entities;

use Doctrine\ORM\Mapping as ORM;
use Wame\Core\Entities\BaseEntity;
use Wame\Core\Entities\Columns;


/**
 * @ORM\Table(name="wame_currency")
 * @ORM\Entity
 */
class CurrencyEntity extends BaseEntity 
{
	use Columns\Identifier;
	use Columns\EditDate;
	use Columns\EditUser;
	use Columns\Status;
	use Columns\Title;
	
	/**
	 * @ORM\Column(name="code", type="string", length=3)
	 */
	protected $code;

	/**
	 * @ORM\Column(name="symbol", type="string", length=5)
	 */
	protected $symbol;
    
    /**
	 * @ORM\Column(name="decimal_separator", type="string", length=1)
	 */
    protected $decimalSeparator;
	
    /**
	 * @ORM\Column(name="grouping_separator", type="string", length=1)
	 */
    protected $groupingSeparator;
    
    /**
	 * @ORM\Column(name="symbol_placement", type="boolean")
	 */
    protected $symbolPlacement;
    
	/**
	 * @ORM\Column(name="coefficient", type="decimal", scale=4)
	 */
	protected $coefficient;
	
	/**
	 * @ORM\Column(name="main", type="boolean")
	 */
	protected $main;
	
	
	/** get ************************************************************/

	public function getCode()
	{
		return $this->code;
	}

	public function getSymbol()
	{
		return $this->symbol;
	}

	public function getCoefficient()
	{
		return $this->coefficient;
	}

	public function getMain()
	{
		return $this->main;
	}


	/** set ************************************************************/

	public function setCode($code)
	{
		$this->code = $code;
		
		return $this;
	}

	public function setSymbol($symbol)
	{
		$this->symbol = $symbol;
		
		return $this;
	}

	public function setCoefficient($coefficient)
	{
		$this->coefficient = $coefficient;
		
		return $this;
	}

	public function setMain($main)
	{
		$this->main = $main;
		
		return $this;
	}

}