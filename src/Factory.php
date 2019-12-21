<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 14:27
 */

namespace Photon;


use Photon\Models\Client;
use Photon\Models\ClientConfig;
use Photon\Models\PhotonRequest;
use Photon\Models\PhotonResponse;

class Factory
{

    /**
     * Create client config
     * @param array $params
     * @return ClientConfig
     */
    public static function getClientConfig(array $params): ClientConfig
    {
        $item = new ClientConfig($params);

        return $item;
    }

    /**
     * Create client
     * @param ClientConfig $config
     * @return Client
     */
    public static function getClient(ClientConfig $config): Client
    {
        $item = new Client([
            'config' => $config
        ]);

        return $item;
    }

    /**
     * Create request
     * @param array $params
     * @return PhotonRequest
     */
    public static function getPhotonRequest(array $params = [])
    {
        $item = new PhotonRequest($params);

        return $item;
    }

    /**
     * Create response
     * @param array $params
     * @return PhotonResponse
     */
    public static function getPhotonResponse(array $params = [])
    {
        $item = new PhotonResponse($params);

        return $item;
    }

}