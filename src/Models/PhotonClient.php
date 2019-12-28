<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 14:43
 */

namespace Photon\Models;

use GuzzleHttp\Client;
use Photon\Exceptions\HttpException;
use Photon\Exceptions\ValidException;
use Photon\Traits\ConfigurableTrait;
use Photon\Traits\ValidatorTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * Client model
 * Class QueryClient
 * @package Photon
 * @property string $url
 * @property null|string $base_auth_username
 * @property null|string $base_auth_password
 * @property Client $client
 */
class PhotonClient
{
    use ConfigurableTrait, ValidatorTrait;

    public $url                = Dictionary::DEFAULT_URL;
    public $base_auth_username = null;
    public $base_auth_password = null;
    public $client             = null;

    public function __construct(Client $client, array $properties = [])
    {
        $this->client = $client;
        if (!empty($properties)) {
            $this->configure($properties);
        }
    }

    /**
     * Check parameters
     * @throws ValidException
     */
    protected function check()
    {
        $this->validateOrExcept([
            'url'                => 'required|url',
            'base_auth_username' => 'regex:/[A-z0-9\-_]+/u',
            'base_auth_password' => 'regex:/[A-z0-9\-_]+/u',
            'client'             => 'required',
        ]);
    }

    /**
     * Make query string request
     * @param PhotonQueryRequest $request
     * @return array
     * @throws HttpException
     * @throws ValidException
     */
    public function query(PhotonQueryRequest $request): array
    {
        $this->check();
        $request->check();
        $url     = "{$this->getUrl()}/api?{$request->getUrlParameters()}";
        $options = [];
        if (!empty($this->getBaseAuthUsername()) && !empty($this->getBaseAuthPassword())) {
            $options = [
                'auth' => [$this->getBaseAuthUsername(), $this->getBaseAuthPassword()]
            ];
        }
        try {
            $response = $this->getClient()->request('GET', $url, $options);
            $items    = $this->makeModels($response);
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage());
        }

        return $items;
    }

    /**
     * Make query to coordinates
     * @param PhotonReverseRequest $request
     * @return array
     * @throws HttpException
     * @throws ValidException
     */
    public function reverse(PhotonReverseRequest $request): array
    {
        $this->check();
        $request->check();
        $options = [];
        if (!empty($this->getBaseAuthUsername()) && !empty($this->getBaseAuthPassword())) {
            $options = [
                'auth' => [$this->getBaseAuthUsername(), $this->getBaseAuthPassword()]
            ];
        }
        $url = "{$this->getUrl()}/reverse?{$request->getUrlParameters()}";
        try {
            $response = $this->getClient()->request('GET', $url, $options);
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
            $model      = new PhotonResponse($properties);
            $model->setLongitude($geometry['coordinates'][0]);
            $model->setLatitude($geometry['coordinates'][1]);
            $model->setType($geometry['type']);
            $items[] = $model;
        }

        return $items;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return PhotonClient $this;
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBaseAuthUsername(): ?string
    {
        return $this->base_auth_username;
    }

    /**
     * @param null|string $base_auth_username
     * @return PhotonClient $this;
     */
    public function setBaseAuthUsername(?string $base_auth_username): self
    {
        $this->base_auth_username = $base_auth_username;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBaseAuthPassword(): ?string
    {
        return $this->base_auth_password;
    }

    /**
     * @param null|string $base_auth_password
     * @return PhotonClient $this;
     */
    public function setBaseAuthPassword(?string $base_auth_password): self
    {
        $this->base_auth_password = $base_auth_password;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return PhotonClient $this;
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}