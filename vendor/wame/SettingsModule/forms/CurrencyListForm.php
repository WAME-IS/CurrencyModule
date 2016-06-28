<?php

namespace Wame\CurrencyModule\Vendor\Wame\SettingsModule\Forms;

use Nette\Application\UI\Form;
use Nette\Security\User;
use Kdyby\Doctrine\EntityManager;
use Wame\Utils\Form\Helpers;
use Wame\Core\Forms\FormFactory;
use Wame\CurrencyModule\Repositories\CurrencyRepository;
use Wame\UserModule\Repositories\UserRepository;


class CurrencyListForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var User */
	private $user;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var CurrencyRepository */
	private $currencyRepository;
	
	/** @var array */
	private $currencies = [];
	
	
	public function __construct(
		User $user,
		EntityManager $entityManager, 
		CurrencyRepository $currencyRepository,
		UserRepository $userRepository
	) {
		parent::__construct();

		$this->user = $user;
		$this->entityManager = $entityManager;
		$this->currencyRepository = $currencyRepository;
		$this->userRepository = $userRepository;
	}

	
	protected function attached($object) {
		parent::attached($object);
	}
	
	
	public function build()
	{
		$form = $this->createForm();
		
		$currencies = $this->currencyRepository->find(['status !=' => CurrencyRepository::STATUS_REMOVE]);
		
		foreach ($currencies as $currency) {
			$form->addCheckbox('status_' . $currency->id, $currency->code);
			
			if ($currency->status == '1') {
				$form['status_' . $currency->id]->setDefaultValue(true);
			}
			
			$form->addText('coefficient_' . $currency->id)
					->setDefaultValue($currency->coefficient)
					->setRequired(_('Coefficient must be fill.'));
			
			$this->currencies[$currency->id] = $currency;
		}

		$form->addSubmit('submit', _('Save'));
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$this->update($form, $values);

			$presenter->flashMessage(_('The currencies has been successfully updated.'), 'success');
			$presenter->redirect('this');
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}

	
	/**
	 * Update currencies
	 * 
	 * @param Form $form
	 * @param array $values
	 */
	private function update($form, $values)
	{
		$editDate = \Wame\Utils\Date::toDateTime('now');
		$editUser = $this->userRepository->get(['id' => $this->user->id]);
		
		foreach ($this->currencies as $currencyId => $currency) {
			$coefficient = $values['coefficient_' . $currencyId];
			
			if (Helpers::getCheckboxData($form, 'status_' . $currencyId) == 1) {
				$status = 1;
			} else {
				$status = 2;
			}
			
			if ($coefficient != $currency->getCoefficient() || $status != $currency->getStatus()) {
				$currencyEntity = $this->currencies[$currencyId];
				$currencyEntity->setCoefficient($coefficient);
				$currencyEntity->setStatus($status);
				$currencyEntity->setEditDate($editDate);
				$currencyEntity->setEditUser($editUser);
		
				$currencyNew = $this->currencyRepository->update($currencyEntity);
				
				$this->currencyRepository->onUpdate($form, $values, $currencyNew);
			}
		}
	}

}
