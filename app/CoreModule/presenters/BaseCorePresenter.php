<?php

namespace App\CoreModule\Presenters;

use App\Presenters\BasePresenter;

/**
 * Základný presenter pre všetky ostatné presentery v CoreModule.
 * @package App\CoreModule\Presenters
 */
abstract class BaseCorePresenter extends BasePresenter
{
    /** @var null|string Adresa presenteru pre logovanie používateľa v rámci CoreModule. */
    protected $loginPresenter = ':Core:Administration:login';
}