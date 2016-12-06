<?php

namespace FranceTelevision\ArticleFrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ArticleController
 * @package FranceTelevision\ArticleFrontBundle\Controller
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name = "index")
     */
    public function indexAction()
    {
        $articles = $this->get('france_television_article_front.manager')->getAll();
        return $this->render('FranceTelevisionArticleFrontBundle::index.html.twig', ['articles' => $articles]);
    }

    /**
     * get single article.
     *
     * @Route("/articles/{slug}", name = "get_article")
     * @Method({"GET"})
     */
    public function getAction(Request $request)
    {
        $article = $this->get('france_television_article_front.manager')->get($request->getPathInfo());

        return $this->render('article/article.html.twig', ['article' => $article]);
    }

    /**
     * Delete article.
     *
     * @Route("/articles/{slug}", name = "delete_article")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request)
    {
        $this->get('france_television_article_front.manager')->delete($request->getPathInfo());

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * Create new Article.
     *
     * @Route("/create", name = "add_article")
     */
    public function postAction(Request $request)
    {
    }

}
