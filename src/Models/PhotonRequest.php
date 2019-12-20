<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 14:51
 */

namespace Photon\Models;


use Photon\Exceptions\ValidException;

/**
 * Make request to photon system
 * Class PhotonRequest
 * @package Photon
 * @property null|string $query
 * @property null|float|integer $latitude
 * @property null|float|integer $longitude
 * @property string $language
 * @property integer $limit
 * @property string|null $osm_tag
 */
class PhotonRequest extends BaseModel
{

    const LANGUAGE_EN            = 'en';
    const LANGUAGE_RU            = 'ru';
    const DEFAULT_RESPONSE_LIMIT = 5;
    const OSM_TAG_STREET         = 'highway';
    const OSM_TAG_PLACE          = 'place';
    const OSM_TAG_HOUSE          = 'place:house';

    public $query     = null;
    public $longitude = null;
    public $latitude  = null;
    public $language  = self::LANGUAGE_RU;
    public $limit     = self::DEFAULT_RESPONSE_LIMIT;
    public $osm_tag   = null;

    /**
     * Check query rules
     * @throws ValidException
     */
    public function checkQuery()
    {
        $this->validateOrExcept([
            'query'     => 'required|min:3',
            'longitude' => 'between:-180,180',
            'latitude'  => 'between:-180,180',
            'language'  => 'required|in:' . implode(',', self::getLanguageDictionary()),
            'limit'     => 'required|integer|min:1',
            'osm_tag'   => 'min:3'
        ]);
    }

    /**
     * Check reverse ruesl
     * @throws ValidException
     */
    public function checkReverse()
    {
        $this->validateOrExcept([
            'longitude' => 'required|between:-180,180',
            'latitude'  => 'required|between:-180,180',
            'language'  => 'required|in:' . implode(',', self::getLanguageDictionary()),
            'limit'     => 'required|integer|min:1',
            'query'     => [
                function ($value) {
                    return empty($value);
                }
            ],
            'osm_tag'   => [
                function ($value) {
                    return empty($value);
                }
            ]
        ]);
    }

    /**
     * Get Language Dictionary
     * @return array
     */
    public static function getLanguageDictionary()
    {
        return [
            self::LANGUAGE_EN,
            self::LANGUAGE_RU
        ];
    }

    /**
     * Get url parameters
     * @return string
     */
    public function getUrlParameters(): string
    {
        $parameters = [
            'limit' => $this->getLimit(),
            'lang'  => $this->getLanguage(),
        ];
        if (!empty($this->getQuery())) {
            $parameters['q'] = $this->query;
        }
        if (!empty($this->getLatitude()) && !empty($this->getLongitude())) {
            $parameters['lon'] = $this->getLongitude();
            $parameters['lat'] = $this->getLatitude();
        }
        if (!empty($this->getOsmTag())) {
            $parameters['osm_tag'] = $this->getOsmTag();
        }

        return http_build_query($parameters);
    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return PhotonRequest $this;
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return float|integer|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float|integer $latitude
     * @return PhotonRequest $this;
     */
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float|integer|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float|integer $longitude
     * @return PhotonRequest $this;
     */
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return PhotonRequest $this;
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return PhotonRequest $this;
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOsmTag(): ?string
    {
        return $this->osm_tag;
    }

    /**
     * @param null|string $osm_tag
     * @return PhotonRequest
     */
    public function setOsmTag(?string $osm_tag): self
    {
        $this->osm_tag = $osm_tag;

        return $this;
    }

}