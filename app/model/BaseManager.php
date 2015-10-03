<?php

namespace App\Model;

use Nette\Database\Context;
use Nette\Object;

/**
 * Základná trieda modelu pre všetky modely aplikácie.
 * Predáva prístup k práci s databázou.
 * @package App\Model
 */
abstract class BaseManager extends Object
{
    /** @var Context Instancia triedy pre prácu s databázou. */
    protected $database;
    
    /**
     * Konštruktor s injektovanou triedou pre prácu s databázou.
     * @param Context $database injektovaná trieda pre prácu s databázou
     */
    public function __construct(Context $database)
    {
        $this->database = $database;
    }
}