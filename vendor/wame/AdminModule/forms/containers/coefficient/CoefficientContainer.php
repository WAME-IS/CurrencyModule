<?php

namespace Wame\CurrencyModule\Vendor\Wame\AdminModule\Forms\Containers;

use Wame\DynamicObject\Registers\Types\IBaseContainer;
use Wame\DynamicObject\Forms\Containers\BaseContainer;


interface ICoefficientContainerFactory extends IBaseContainer
{
    /** @return CoefficientContainer */
    public function create();
}


class CoefficientContainer extends BaseContainer
{
    /** {@inheritDoc} */
    public function configure()
    {
        $this->addText('coefficient', _('Coefficient'))
				->setRequired(_('Please enter coefficient'));
    }


    /** {@inheritDoc} */
    public function setDefaultValues($entity, $langEntity = null)
    {
        $this['coefficient']->setDefaultValue($entity->getCoefficient());
    }


    /** {@inheritDoc} */
    public function create($form, $values)
    {
        $form->getEntity()->setCoefficient($values['coefficient']);
    }


    /** {@inheritDoc} */
    public function update($form, $values)
    {
        $form->getEntity()->setCoefficient($values['coefficient']);
    }

}
