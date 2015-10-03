<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Object;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Nette\Utils\ArrayHash;

/**
 * Továrnička pre registračné a prihlasovacie formuláre.
 * @package App\Forms
 */
class UserForms extends Object
{
    /** @var User uživateľ */
    private $user;
    
    /**
     * Konštruktor s injektovanou triedou používateľa.
     * @param User $user automaticky injektovaná trieda používateľa.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * 
     * @param Form $form                    formulár, z ktorého sa volá metóda
     * @param null|ArrayHash $instructions  používateľské inštrukcie
     * @param bool $register                registrovaný
     */
    private function login($form, $instructions, $register = false)
    {
        $presenter = $form->getPresenter();
        try 
        {
            $username = $form->getValues()->username;
            $password = $form->getValues()->password;
            
            if ($register) $this->user->getAuthenticator()->register($username, $password);
            
            $this->user->login($username, $password);
            
            if ($instructions && $presenter)
            {
                if (isset($instructions->message)) $presenter->flashMessage($instructions->message);  
                if (isset($instructions->redirection)) $presenter->redirect($instructions->redirection);
            }
        } 
        catch (AuthenticationException $ex) {
            if ($presenter)
            {
                $presenter->flashMessage($ex->getMessage());
                $presenter->redirect('this');
            }
            else
            {
                $form->addError($ex->getMessage());
            }
        }
    }
    
    /**
     * Vracia formulár so spoločným základom.
     * @param null|Form $form formulár, ktorý sa má vytvoriť o spoločné prvky alebo null, ak sa ma vytvoriť nový formulár
     * @return Form formulár so spoločným základom
     */
    private function createBasicForm(Form $form = null)
    {
        $form = $form ? $form : new Form();
        $form->addText('username', 'Meno:')->setRequired();
        $form->addPassword('password', 'Heslo:')->setRequired();
        return $form;
    }
    
    /**
     * Vracia komponent formulára s prihlasovacími prvkami a spracovanie inštrukcií podľa používateľských inštrukcii.
     * @param null|ArrayHash $instructions  používateľské inštrukcie pre spracovanie registrácie
     * @param null|Form $form               komponent formulára, ktorá sa rozšíri o prihlasovacie prvky alebo null, ak sa vytvára nový formulár
     * @return Form                         komponent formulára s prihlasovacími prvkami
     */
    public function createLoginForm($instructions = null, Form $form = null)
    {
        $form = $this->createBasicForm($form);
        $form->addSubmit('submit', 'Prihlásiť');
        $form->onSuccess[] = 
                function (Form $form) use ($instructions)
                {
                    $this->login($form, $instructions);
                };
        return $form;    
    }
    
    /**
     * Vracia komponent formulára s registračnými prvkami a spracuje registráciu podľa používateľských inštrukcii.
     * @param null|ArrayHash $instructions  používateľské inštrukcie pre spracovanie formulára
     * @param null|Form $form               komponent formulára, ktorý sa má rozšíriť o registračné prvky
     * @return Form                         komponent formulára s registračnými prvkami
     */
    public function createRegisterForm($instructions = null, Form $form = null)
    {
        $form = $this->createBasicForm($form);
        $form->addPassword('password_repeat', 'Heslo znovu:')
                ->addRule(Form::EQUAL, 'Heslá sa nezhodujú.', $form['password']);
        $form->addText('y', 'Zadajte aktuálny rok (antispam):')->setType('number')->setRequired()
                ->addRule(Form::EQUAL, 'Zle vyplnený antispam.', date('Y'));
        $form->addSubmit('register', 'Registrovať');
        $form->onSuccess[] =
                function (Form $form) use ($instructions)
                {
                    $this->login($form, $instructions, true);
                };
        return $form;        
    }
}
