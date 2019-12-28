<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 19.12.19
 * Time: 14:00
 */

class ModelsTest extends \PHPUnit\Framework\TestCase
{

    public function testCreateClient()
    {
        $model = new \Photon\Models\PhotonClient(new \GuzzleHttp\Client(), [
            'url'                => 'http://photon.komoot.de',
            'base_auth_username' => 'asd',
            'base_auth_password' => 'asd',
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonClient::class, $model);

        return $model;
    }

    public function testCreateQueryRequest()
    {
        $model = new \Photon\Models\PhotonQueryRequest([
            'query'   => 'Москва, Вавилова 6',
            'osm_tag' => \Photon\Models\Dictionary::OSM_TAG_PLACE,
            'limit'   => 6
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonQueryRequest::class, $model);
    }


    public function testCreateReverseRequest()
    {
        $model = new \Photon\Models\PhotonReverseRequest([
            'latitude'  => 55.630358,
            'longitude' => 37.516776,
            'limit'     => 1
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonReverseRequest::class, $model);
    }

    public function testCreateResponse()
    {
        $model = new \Photon\Models\PhotonResponse();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonResponse::class, $model);
    }
}