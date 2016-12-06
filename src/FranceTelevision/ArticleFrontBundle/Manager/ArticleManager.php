<?php
namespace FranceTelevision\ArticleFrontBundle\Manager;

use GuzzleHttp\ClientInterface;

/**
 * Class ArticleManager
 * @package FranceTelevision\ArticleFrontBundle\Manager
 */
class ArticleManager
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**²
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $response = $this->client->get('./articles', ['headers' => ['Accept' => 'application/json']]);
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

    /**
     * @param $uri
     * @return mixed
     */
    public function get($uri)
    {
        $response = $this->client->request('GET', $uri, ['headers' => ['Accept' => 'application/json']]);
        $body = $response->getBody()->getContents();

        return json_decode($body, true);
    }

    /**
     * @param $uri
     */
    public function delete($uri)
    {
        $this->client->request('DELETE', $uri, ['headers' => ['Accept' => 'application/json']]);
    }

    /**
     * {@inherit doc}.
     */
    public function post(array $data)
    {
        $this->client->request('POST', '/articles', ['headers' => ['Accept' => 'application/json'], 'body' => json_encode($data)]);
    }
}
