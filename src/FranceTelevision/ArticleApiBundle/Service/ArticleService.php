<?php

namespace FranceTelevision\ArticleApiBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use FranceTelevision\ArticleApiBundle\Entity\Article;

/**
 * Class ArticleService
 * @package FranceTelevision\ArticleApiBundle\Service
 */
class ArticleService
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * persist a new Article
     * @param Article $article
     */
    public function post(Article $article)
    {
        $this->om->persist($article);
        $this->om->flush();
    }

    /**
     * Get the list of Articles
     *
     * @return array
     */
    public function getAll()
    {
        return $this->getRepository()->findBy(array());
    }

    /**
     * Remove article.
     *
     * @param Article $article
     */
    public function remove(Article $article)
    {
        $this->om->remove($article);
        $this->om->flush();
    }


    /**
     * Get article Repository.
     */
    private function getRepository()
    {
        return $this->om->getRepository('FranceTelevisionArticleApiBundle:Article');
    }
}
