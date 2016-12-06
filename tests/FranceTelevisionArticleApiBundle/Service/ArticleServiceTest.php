<?php

namespace FranceTelevision\ArticleApiBundle\Tests\Service;

use Doctrine\ORM\EntityManager;
use FranceTelevision\ArticleApiBundle\Entity\Article;
use FranceTelevision\ArticleApiBundle\Service\ArticleService;
use Phake;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class ServiceControllerTest
 * @package FranceTelevision\ArticleApiBundle\Tests\Controller
 */
class ArticleServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var ArticleService $articleService */
    protected $articleService;

    /** @var EntityManager $em */
    protected $em;

    /** @var ObjectRepository $repository */
    protected $repository;

    /**
     * configure the test
     */
    public function setUp()
    {
        $this->repository = Phake::mock(ObjectRepository::class);
        $this->em = Phake::mock(EntityManager::class);
        $this->articleService = new ArticleService($this->em);
    }

    /**
     * test Remove
     */
    public function testRemove()
    {
        $article = Phake::mock(Article::class);
        $this->articleService->remove($article);
        Phake::verify($this->em, Phake::times(1))->remove(Phake::anyParameters()); //called one time
        Phake::verify($this->em, Phake::times(1))->flush();
    }

    /**
     * test getAll
     */
    public function testGetAll()
    {
        Phake::when($this->em)->getRepository(Phake::anyParameters())->thenReturn($this->repository);
        Phake::when($this->repository)->findBy(Phake::anyParameters())->thenReturn([]);
        $result = $this->articleService->getAll();
        Phake::verify($this->repository, Phake::times(1))->findBy(Phake::anyParameters());
        $this->assertInternalType('array', $result);
    }

    /**
     * test post
     */
    public function testPost()
    {
        $article = Phake::mock(Article::class);
        $this->articleService->post($article);
        Phake::verify($this->em, Phake::times(1))->persist(Phake::anyParameters()); //called one time
        Phake::verify($this->em, Phake::times(1))->flush();
    }
}
