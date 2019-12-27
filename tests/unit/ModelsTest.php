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


    public function testCreateRequest()
    {
        $model = new \Photon\Models\PhotonRequest([
            'query'   => 'Москва, Вавилова 6',
            'osm_tag' => \Photon\Models\PhotonRequest::OSM_TAG_PLACE,
            'limit'   => 6
        ]);
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonRequest::class, $model);
    }

    public function testCreateResponse()
    {
        $model = new \Photon\Models\PhotonResponse();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Photon\Models\PhotonResponse::class, $model);
    }
}