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
        $client = new \Photon\Models\PhotonClient(new GuzzleHttp\Client());
        $this->assertNotEmpty($client);
        $request = new \Photon\Models\PhotonQueryRequest([
            'query'    => 'Moscow Vavil',
            'language' => \Photon\Models\Dictionary::LANGUAGE_EN,
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
        $client  = new \Photon\Models\PhotonClient(new GuzzleHttp\Client());
        $request = new \Photon\Models\PhotonReverseRequest([
            'latitude'  => 55.630358,
            'longitude' => 37.516776,
            'language'  => \Photon\Models\Dictionary::LANGUAGE_EN,
            'limit'     => 1
        ]);
        $this->assertNotEmpty($request);
        $response = $client->reverse($request);
        $this->assertNotEmpty($response);
        $this->assertCount(1, $response);
    }
}