<?php

/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 20.12.19
 * Time: 10:24
 */
class QueryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Photon\Exceptions\HttpException
     * @throws \Photon\Exceptions\ValidException
     */
    public function testQuery()
    {
        $config = \Photon\Factory::getClientConfig([
            'url' => 'http://photon.komoot.de'
        ]);
        $this->assertNotEmpty($config);
        $client = \Photon\Factory::getClient($config);
        $this->assertNotEmpty($client);
        $request = \Photon\Factory::getPhotonRequest([
            'query'    => 'Moscow Vavil',
            'language' => \Photon\Models\PhotonRequest::LANGUAGE_EN,
            'limit'    => 2
        ]);
        $this->assertNotEmpty($request);
        $response = $client->query($request);
        $this->assertNotEmpty($response);
        $this->assertCount(2, $response);
    }

    /**
     * @throws \Photon\Exceptions\HttpException
     * @throws \Photon\Exceptions\ValidException
     */
    public function testReverse()
    {
        $config = \Photon\Factory::getClientConfig([
            'url' => 'http://photon.komoot.de'
        ]);
        $this->assertNotEmpty($config);
        $client = \Photon\Factory::getClient($config);
        $this->assertNotEmpty($client);
        $request = \Photon\Factory::getPhotonRequest([
            'latitude'  => 55.630358,
            'longitude' => 37.516776,
            'language'  => \Photon\Models\PhotonRequest::LANGUAGE_EN,
            'limit'     => 1
        ]);
        $this->assertNotEmpty($request);
        $response = $client->reverse($request);
        $this->assertNotEmpty($response);
        $this->assertCount(1, $response);
    }
}