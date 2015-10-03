<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;

/**
 * Základný presenter pre všetky ostatné presentery v aplikácií.
 * @package App\Presenters
 */
class BasePresenter extends Presenter
{
    /** @var null|string Adresa presenteru pre logovanie používateľa. */
    protected $loginPresenter = null;
    
    /**
     * Volá sa na začiatku každej akcie a kontroluje používateľská oprávnenia. 
     */
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isAllowed($this->getName(), $this->getAction()))
        {
            $this->flashMessage('Nie ste prihlásený alebo nemáš dostatočné oprávanenia.');
            if ($this->loginPresenter)
            {
                $this->redirect($this->loginPresenter);
            }
        }
    }
    
    /**
     * Volá sa pred každým vyrenderovaním presenteru a predáva spoločné premenné do celého layoutu webu.
     */
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->admin = $this->getUser()->isInRole('admin');
    }
}