<?php

namespace FranceTelevision\ArticleApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FranceTelevision\ArticleApiBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 * @package FranceTelevision\ArticleApiBundle\Controller
 */
class ArticleController extends FOSRestController
{
    /**
     * Get All Articles
     *
     * @Get("/articles")
     * @View(serializerGroups={"getAll"})
     */
    public function getAllAction()
    {
        return $this->get('france_television_article_api.service')->getAll();
    }

    /**
     * Get Article by id
     *
     * @Get("/articles/{id}")
     * @ParamConverter("article", options={"id" = "id"})
     * @View(serializerGroups={"getOne"})
     *
     * @param Article $article
     * @return \FOS\RestBundle\View\View
     */
    public function getAction(Article $article)
    {
        return $this->view($article, Response::HTTP_OK);
    }

    /**
     * Add a new Article
     * <code>
    {
    "title": "this is an Article",
    "leading": "news",
    "body": "lorem ipsum",
    "created_by": "ashraf"
    }
    </code>
     *
     * @Post("/articles")
     *
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        $article = $this->get('france_television_article_api.serializer')
            ->serializeArticle($request->getContent());

        $validator = $this->get('validator');
        $errors = $validator->validate($article);

        if (count($errors) > 0) {
            return $this->view($errors, Response::HTTP_NOT_FOUND);
        }

        $this->get('france_television_article_api.service')->post($article);
        $message = "Article successfully added!";
        return $this->view($message, Response::HTTP_CREATED);
    }

    /**
     * Delete Article by id.
     *
     * @Delete("/articles/{id}")
     * @ParamConverter("article", options={"id" = "id"})
     * @return \FOS\RestBundle\View\View
     */
    public function deleteAction(Article $article)
    {
        $this->get('france_television_article_api.service')->remove($article);
        $message = "Article successfully deleted!";
        return $this->view($message, Response::HTTP_OK);
    }
}
