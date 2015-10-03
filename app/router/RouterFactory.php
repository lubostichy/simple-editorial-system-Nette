<?php

namespace App;

use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;

/**
 * Routovacia továrnička.
 * Riadi routovanie v celej aplikácií.
 * @package App
 */
class RouterFactory
{
	/**
         * Vytvára router pre aplikáciu.
	 * @return RouteList výsledný router pre aplikáciu
	 */
	public static function createRouter()
	{
		$router = new RouteList;        
                $router[] = new Route('kontakt/', 'Core:Contact:default');
                //$router[] = new Route('administracia/', 'Core:Administration:default');
                $router[] = new Route('<action>/', array(
                    'presenter' => 'Core:Administration',
                    'action' => array(
                        Route::FILTER_TABLE => array(
                            'administracia' => 'default',
                            'prihlasenie' => 'login',
                            'odhlasit' => 'logout',
                            'registracia' => 'register'
                        ),
                        Route::FILTER_STRICT => true
                    )                    
                ));
                $router[] = new Route('[<action>/][<url>]', array(
                    'presenter' => 'Core:Article',
                    'action' => array(
                        Route::VALUE => 'default',
                        Route::FILTER_TABLE => array(
                            'zoznam-clankov' => 'list',
                            'editor' => 'editor',
                            'odstranit' => 'remove'
                        ),
                        Route::FILTER_STRICT => true
                    ),
                    'url' => null,
                ));                 
		$router[] = new Route('[<url>]', 'Core:Article:default');
		return $router;
	}
}