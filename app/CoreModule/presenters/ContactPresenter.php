<?php

namespace App\CoreModule\Presenters;

use App\Presenters\BasePresenter;
use Nette\Application\UI\Form;
use Nette\InvalidStateException;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\Utils\ArrayHash;

/**
 * Spracováva kontaktný formulár.
 * @package App\CoreModule\Presenters
 */
class ContactPresenter extends BaseCorePresenter
{
    /** Email administrátora, na ktorý sa budú posielať emaily z kontaktného formulára. */
    const EMAIL = 'admin@localhost.cz';
    
    /**
     * Vytvára a vracia komponent kontaktného formulára.
     * @return Form kontaktný formulár
     */
    protected function createComponentContactForm()
    {
        $form = new Form();
        $form->addText('email', 'Vaša emailová adresa:')->setType('email')->setRequired();
        $form->addText('y', 'Zadajte aktuálny rok:')->setRequired()
                ->addRule(Form::EQUAL, 'Chybne vyplnený antispam.', date("Y"));
        $form->addTextArea('message','Správa:')->setRequired()
                ->addRule(Form::MIN_LENGTH, 'Správa musí obsahovať minimálne %d znakov.', 10);
        $form->addSubmit('submit', 'Odoslať');
        $form->onSuccess[] = [$this, 'contactFormSucceeded'];
        return $form;
    }
    
    /**
     * Funkcia sa vykoná pri úspešnom odoslaní kontaktného formulára a odošle email.
     * @param Form $form kontaktný formulár
     * @param ArrayHash $values odoslané hodnoty formulára
     */
    public function contactFormSucceeded($form, $values)
    {
        try {
            $mail = new Message();
            $mail->setFrom($values->email)
                    ->addTo(self::EMAIL)
                    ->setSubject('Email z webu')
                    ->setBody($values->message);
            $mailer = new SendmailMailer();
            $mailer->send($mail);
            $this->flashMessage('Email bol úspešne odoslaný.');
            $this->redirect('this');
        } catch (InvalidStateException $ex) {
            $this->flashMessage('Email sa nepodarilo odoslať.');
        }
    }
}
