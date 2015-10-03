<?php

namespace App\CoreModule\Presenters;

use App\CoreModule\Model\ArticleManager;
use App\Presenters\BasePresenter;
use Nette\Application\BadRequestException;
use Nette\Application\UI\Form;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Utils\ArrayHash;

/**
 * Zpracováva vykreslovanie článkov.
 * @packege App\CoreModule\Presenters
 */
class ArticlePresenter extends BaseCorePresenter
{
    /** Konštanta s hodnotou URL preddefinovaného článku. */
    const DEFAULT_ARTICLE_URL = 'uvod';
    
    /** @var ArticleManager Instancia triedy modelu pre prácu s článkami. */
    protected $articleManager;
    
    /**
     * Konštruktor s injektovaným modelom pre prácu s článkami.
     * @param ArticleManager $articleManager automaticky injektovaná trieda modelu pre prácu s článkami
     */
    public function __construct(ArticleManager $articleManager)
    {
        parent::__construct();
        $this->articleManager = $articleManager;
    }
    
    /**
     * Načíta a vykreslí článok do šablóny podľa jeho URL.
     * @param string $url URL článok
     * @throws BadRequestException ak sa článok s danou URL nenašiel
     */
    public function renderDefault($url)
    {
        if (!$url)
        {
            $url = self::DEFAULT_ARTICLE_URL;
        }
        
        if (!($article = $this->articleManager->getArticle($url)))
        {
            throw new BadRequestException();
        }
        $this->template->article = $article;
    }
    
    /**
     * Vykreslí zoznam článkov do šablóny.
     */
    public function renderList()
    {
        $this->template->articles = $this->articleManager->getArticles();
    }
    
    /**
     * Odstráni článok.
     * @param string $url
     */
    public function actionRemove($url)
    {
        $this->articleManager->removeArticle($url);
        $this->flashMessage('Článok bol úspešne odstránený.');
        $this->redirect(':Core:Article:list');
    }
    
    /**
     * Vykresluje editáciu článku podľa jeho URL.
     * @param string $url
     */
    public function actionEditor($url)
    {        
        if ($url)
        {
            ($article = $this->articleManager->getArticle($url)) ? $this['editorForm']->setDefaults($article) : $this->flashMessage('Článok sa nenašiel.');
        }
    }
    
    /**
     * Vráti formulár pre editáciu článkov.
     * @return Form formulár pre editáciu článkov
     */
    public function createComponentEditorForm()
    {
        $form = new Form();
        $form->addHidden('article_id');
        $form->addText('title', 'Titulok')->setRequired();
        $form->addText('url','URL')->setRequired();
        $form->addText('description','Popis')->setRequired();
        $form->addTextArea('content','Obsah')->setRequired();
        $form->addSubmit('submit','Uložiť článok');
        $form->onSuccess[] = [$this, 'editorFormSucceeded'];
        return $form;        
    }
    
    /**
     * Funkcia sa vykoná pri úspešnom odoslaní formulára a spracuje hodnoty formulára.
     * @param Form $form formulár editora
     * @param ArrayHash $values odoslané hodnoty formulára
     */
    public function editorFormSucceeded($form, $values)
    {
        try
        {
            $this->articleManager->saveArticle($values);
            $this->flashMessage('Článok bol úspešne uložený.');
            $this->redirect(':Core:Article:', $values->url);
        } catch (UniqueConstraintViolationException $ex) {
            $this->flashMessage('Článok s touto URL už existuje.');
        }
    }
}
