# photon-api
Project Photon-api wrapper

Project wrapper of api requests for photon project https://photon.komoot.de/

Allows you to perform a fully contextual search by text template and reverse search by coordinates

* To install with composer try:

composer require --prefer-dist iseed838/photon-api "master"

* Make query request

<pre>
//Make config
$config   = Photon\Factory::getClientConfig([
    'url'                => 'https://photon.komoot.de',
]);
//Make request
$request  = Photon\Factory::getPhotonRequest([
    'query'    => 'Moscow, Vavi',
    'language' => \Photon\Models\PhotonRequest::LANGUAGE_EN,
    'osm_tag'  => \Photon\Models\PhotonRequest::OSM_TAG_PLACE,
    'limit'    => 3
]);
//Execute request
$response = Photon\Factory::getClient($config)->query($request);
</pre>

* Make reverse request

<pre>
//Make config
$config   = Photon\Factory::getClientConfig([
    'url'                => 'https://photon.komoot.de',
]);
//Make request
$request  = Photon\Factory::getPhotonRequest([
    'latitude'  => 55.630358,
    'longitude' => 37.516776,
    'language'  => \Photon\Models\PhotonRequest::LANGUAGE_EN,
    'limit'     => 1
]);
//Execute request
$response = Photon\Factory::getClient($config)->reverse($request);
</pre>

The result returns an array containing the limit of response objects
<pre>
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

</pre>