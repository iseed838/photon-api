<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 19.12.19
 * Time: 14:00
 */

class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return \Photon\Models\ClientConfig
     */
    public function testCreateConfig()
    {
        $model = Photon\Factory::getClientConfig([
            'url'                => 'https://photon.flowwow.com',
            'base_auth_username' => 'asd',
            'base_auth_password' => 'asd',
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\ClientConfig::class, $model);

        return $model;
    }

    /**
     * @depends testCreateConfig
     * @param \Photon\Models\ClientConfig $config
     * @return \Photon\Models\Client
     */
    public function testCreateClient($config)
    {
        $model = Photon\Factory::getClient($config);
        $this->assertNotEmpty($config);
        $this->assertInstanceOf(\Photon\Models\Client::class, $model);

        return $model;
    }


    public function testCreateRequest()
    {
        $model = Photon\Factory::getPhotonRequest([
            'query'   => 'Москва, Вавилова 6',
            'osm_tag' => \Photon\Models\PhotonRequest::OSM_TAG_PLACE,
            'limit'   => 6
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonRequest::class, $model);
    }

    public function testCreateResponse()
    {
        $model = Photon\Factory::getPhotonResponse();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonResponse::class, $model);
    }
}