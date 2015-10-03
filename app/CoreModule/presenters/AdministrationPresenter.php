<?php

namespace App\CoreModule\Presenters;

use App\Presenters\BasePresenter;
use App\Forms\UserForms;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

/**
 * Spracováva vykreslovanie administračnej sekcie.
 * @package App\CoreModule\Presenters
 */
class AdministrationPresenter extends BaseCorePresenter
{
    /** @var UserForms továrnička pre používateľské formuláre */    
    private $userFormsFactory;
    
    /** @var array spoločné inštrukcie pre prihlasovacie a registračné formuláre */
    private $instructions;
    
    /**
     * Konštruktor s injektovanou továrničkou pre používateľské formuláre.
     * @param UserForms $userForms automaticky injektovaná trieda továrničky pre používateľské formuláre
     */
    public function __construct(UserForms $userForms)
    {
        parent::__construct();
        $this->userFormsFactory = $userForms;
    }
    
    /**
     * Volá sa pred každou akciou presenteru a inicializuje spoločné premenné.
     */
    public function startup()
    {
        parent::startup();
        $this->instructions = array(
            'message' => null,
            'redirection' => ':Core:Administration:'
        );
    }
    
    /**
     * Presmerovanie do administrácie, ak je používateľ prihlásený.
     */
    public function actionLogin()
    {
        if ($this->getUser()->isLoggedIn())
        {
            $this->redirect(':Core:Administration:');
        }
    }
    
    /**
     * Odhlásí používateľa.
     */
    public function actionLogout()
    {
        $this->getUser()->logout();
        $this->redirect($this->loginPresenter);
    }
    
    /**
     * Vyrenderuje administračnú stránku.
     */
    public function renderDefault()
    {
        $identity = $this->getUser()->getIdentity();
        if ($identity)
        {
            $this->template->username = $identity->getData()['username'];
        }
    }
    
    /**
     * Vracia komponent prihlasovacieho formulára z továrničky.
     * @return Form prihlasovací formulár
     */
    protected function createComponentLoginForm()
    {
        $this->instructions['message'] = 'Boli ste úspešne prihlásený.';
        return $this->userFormsFactory->createLoginForm(ArrayHash::from($this->instructions));
    }
    
    /**
     * Vracia komponent registračného formulára z továrničky.
     * @return Form registračný formulár
     */
    protected function createComponentRegisterForm()
    {
        $this->instructions['message'] = 'Boli ste úspešne zaregistrovaný.';
        return $this->userFormsFactory->createRegisterForm(ArrayHash::from($this->instructions));
    }
}
