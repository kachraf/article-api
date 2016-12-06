<?php

namespace FranceTelevision\ArticleApiBundle\Service;

use FranceTelevision\ArticleApiBundle\Entity\Article;
use JMS\Serializer\Serializer;

class ArticleSerializer
{
    /**
     * @var Serializer $serializer
     */
    protected $serializer;

    /**
     * ArticleSerializer constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serializeArticle($jsonData)
    {
        /** @var Article $article */
        $article = $this->serializer->deserialize($jsonData, Article::class, 'json');
        return $article->setCreatedAt();
    }
}