# photon-api
Project Photon-api wrapper

Project wrapper of api requests for photon project https://photon.komoot.de/

Allows you to perform a fully contextual search by text template and reverse search by coordinates


* To install with composer try:

composer require iseed838/photon-api "~0.1"

* Make query request

```php
$client   = new \Photon\Models\PhotonClient(new \GuzzleHttp\Client(), [
    'url'                => 'https://http://photon.komoot.de',
]);

$request  = new \Photon\Models\PhotonRequest( [
    'latitude'  => 55.630358,
    'longitude' => 37.516776,
    'language'  => \Photon\Models\PhotonRequest::LANGUAGE_EN,
    'limit'     => 1
]);
$response = $client->reverse($request);
```

* Make reverse request

```php
$client   = new \Photon\Models\PhotonClient(new \GuzzleHttp\Client(), [
    'url'                => 'https://http://photon.komoot.de',
]);
$request  = Photon\Factory::getPhotonRequest([
    'latitude'  => 55.630358,
    'longitude' => 37.516776,
    'language'  => \Photon\Models\PhotonRequest::LANGUAGE_EN,
    'limit'     => 1
]);
$response = $client->reverse($request);
```

The result returns an array containing the limit of response objects
```php
    [0] => Photon\Models\PhotonResponse Object
        (
            [osm_id] => 537247988
            [osm_type] => W
            [extent] => Array
                (
                    [0] => 37.516021
                    [1] => 55.6309387
                    [2] => 37.5177537
                    [3] => 55.6299123
                )

            [osm_key] => building
            [osm_value] => retail
            [postcode] => 117632
            [countrycode] =>
            [country] => Russia
            [state] => Moscow
            [city] => Konkovo District
            [street] => Profsous street
            [housenumber] => 126 c3
            [latitude] => 55.63039825
            [longitude] => 37.516796697274
            [type] => Point
        )
```