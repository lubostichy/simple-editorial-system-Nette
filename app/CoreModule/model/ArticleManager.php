<?php

namespace App\CoreModule\Model;

use App\Model\BaseManager;
use Nette\Database\Table\IRow;
use Nette\Database\Table\Selection;
use Nette\Utils\ArrayHash;

/**
 * Trieda poskytuje metódy pre správu článkov v redakčnom systéme.
 * @package App\CoreModule\Model
 */
class ArticleManager extends BaseManager
{
    /** Konštanty pre manipuláciu s modelom. */
    const
            TABLE_NAME = 'article',
            COLUMN_ID = 'article_id',
            COLUMN_URL = 'url';
    
    /**
     * Vráti zoznam článkov v databáze.
     * @return Selection zoznam článkov
     */
    public function getArticles()
    {
        return $this->database->table(self::TABLE_NAME)->order(self::COLUMN_ID . ' DESC');
    }
    
    /**
     * Vráti článok z databáze podľa jeho URL.
     * @url string $url URI článku
     * @return bool|mixed|IRow prvý článok, ktorý zodpovedá URL alebo false pri neúspechu
     */    
    public function getArticle($url)
    {
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_URL, $url)->fetch();
    }
       
    /**
     * Uloží článok do systému. Ak nie je nastavené ID, tak vloží nový, inak vykoná editáciu.
     * @param array|ArrayHash $article článok
     */
    public function saveArticle($article)
    {
        if (!$article[self::COLUMN_ID])
        {
            $this->database->table(self::TABLE_NAME)->insert($article);
        } 
        else
        {
            $this->database->table(self::TABLE_NAME)->where(self::COLUMN_ID, $article[self::COLUMN_ID])->update($article);
        }
    }
    
    /**
     * Odstrání článok.
     * @param string $url URL článku
     */
    public function removeArticle($url)
    {
        $this->database->table(self::TABLE_NAME)->where(self::COLUMN_URL, $url)->delete();
    }    
}