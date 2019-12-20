<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 14:43
 */

namespace Photon\Models;

use Photon\Exceptions\HttpException;
use Photon\Exceptions\ValidException;
use Photon\Factory;
use Psr\Http\Message\ResponseInterface;

/**
 * Client model
 * Class Client
 * @package Photon
 * @property ClientConfig $config
 * @property \GuzzleHttp\Client $client
 */
class Client extends BaseModel
{
    public    $config = null;
    protected $client = null;

    public function init()
    {
        if (is_null($this->client) || !$this->client instanceof \GuzzleHttp\Client) {
            $this->setClient();
        }
    }

    /**
     * Set up GuzzleHttp client
     */
    private function setClient()
    {
        $options = [];
        if (!empty($this->config->getBaseAuthUsername()) && !empty($this->config->getBaseAuthPassword())) {
            $options['auth'] = [$this->config->getBaseAuthUsername(), $this->config->getBaseAuthPassword()];
        }
        $this->client = new \GuzzleHttp\Client($options);
    }

    /**
     * @throws ValidException
     */
    public function checkConfig()
    {
        if (is_null($this->config) || !$this->config instanceof ClientConfig) {
            throw new ValidException("Client config must be set and instance of ClientConfig");
        }
        $this->config->checkConfig();
    }

    /**
     * Make query string request
     * @param PhotonRequest $request
     * @return array
     * @throws HttpException
     * @throws ValidException
     */
    public function query(PhotonRequest $request): array
    {
        $this->checkConfig();
        $request->checkQuery();
        $url = "{$this->config->getUrl()}/api?{$request->getUrlParameters()}";
        try {
            $response = $this->client->get($url);
            $items    = $this->makeModels($response);
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage());
        }

        return $items;
    }

    /**
     * Make query to coordinates
     * @param PhotonRequest $request
     * @return array
     * @throws HttpException
     * @throws ValidException
     */
    public function reverse(PhotonRequest $request): array
    {
        $this->checkConfig();
        $request->checkReverse();
        $url = "{$this->config->getUrl()}/reverse?{$request->getUrlParameters()}";
        try {
            $response = $this->client->get($url);
            $items    = $this->makeModels($response);
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage());
        }

        return $items;
    }

    /**
     * Make response models
     * @param ResponseInterface $response
     * @return PhotonResponse[]|array
     * @throws HttpException
     */
    private function makeModels(ResponseInterface $response): array
    {
        $result = json_decode($response->getBody()->getContents(), true);
        if (empty($result)) {
            throw new HttpException('The response from the photon system could not be recognized');
        }
        $items = [];
        foreach ($result['features'] as $resultItem) {
            $properties = $resultItem['properties'];
            $geometry   = $resultItem['geometry'];
            $model      = Factory::getPhotonResponse($properties);
            $model->setLongitude($geometry['coordinates'][0]);
            $model->setLatitude($geometry['coordinates'][1]);
            $model->setType($geometry['type']);
            $items[] = $model;
        }

        return $items;
    }
}