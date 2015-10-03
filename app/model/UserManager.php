<?php

namespace App\Model;

use Nette\Database\UniqueConstraintViolationException;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\Passwords;

/**
 * Správca použivateľov redakčného systému.
 * @package App\Model
 */
class UserManager extends BaseManager implements IAuthenticator
{
    /** Konštanty pre manipuláciu s modelom. */
    const
            TABLE_NAME = 'user',
            COLUMN_ID = 'user_id',
            COLUMN_NAME = 'username',
            COLUMN_PASSWORD_HASH = 'password',
            COLUMN_ROLE = 'role';
    
    /**
     * Prihlási použivateľa do systému.
     * @param array $credentials meno a heslo použivateľa
     * @return Identity identita prihláseného použivateľa pre ďalšiu manipuláciu
     * @throws AuthenticationException ak dôjde k chybe pri prihlasovaní - nesprávne použivateľské meno alebo heslo
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        
        $user = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();
        
        if (!$user)
        {
            throw new AuthenticationException('Zadané používateľské meno neexistuje.', self::IDENTITY_NOT_FOUND);
        }
        elseif (!Passwords::verify($password, $user[self::COLUMN_PASSWORD_HASH]))
        {
            throw new AuthenticationException('Zadané heslo je nesprávne.',  self::INVALID_CREDENTIAL);
        }
        elseif (Passwords::needsRehash($user[self::COLUMN_PASSWORD_HASH]))
        {
            $user->update(array(self::COLUMN_PASSWORD_HASH => Passwords::hash($password)));
        }
        
        $userData = $user->toArray();
        unset($userData[self::COLUMN_PASSWORD_HASH]); // kvôli bezpečnosti sa odstráni heslo z dát
        
        return new Identity($user[self::COLUMN_ID], $user[self::COLUMN_ROLE], $userData);
    }
    
    /**
     * Registruje nového používateľa do systému.
     * @param string $username používateľské meno
     * @param string $password heslo
     * @throws DuplicateNameException ak používateľ s daným menom už existuje
     */
    public function  register($username, $password)
    {
        try
        {
            $this->database->table(self::TABLE_NAME)->insert(array(
                self::COLUMN_NAME => $username,
                self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
            ));
        } catch (UniqueConstraintViolationException $ex) 
        {
            throw new DuplicateNameException;
        }
    }
}

/**
 * Výnimka pre duplicitné používateľské meno.
 * @package App\Model
 */
class  DuplicateNameException extends AuthenticationException
{
    /**
     * Konštruktor definujúci preddefinované chybné správy.
     */
    public function __construct()
    {
        parent::__construct();
        $this->message = 'Používateľ s týmto menom je už zaregistrovaný.';
    }
}