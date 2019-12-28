<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 14:51
 */

namespace Photon\Models;

use Photon\Traits\ConfigurableTrait;
use Photon\Traits\ValidatorTrait;


/**
 * Make query request to photon system
 * Class PhotonQueryRequest
 * @package Photon
 * @property string $query
 * @property null|float|integer $latitude
 * @property null|float|integer $longitude
 * @property string $language
 * @property integer $limit
 * @property string|null $osm_tag
 */
class PhotonQueryRequest
{
    use ConfigurableTrait, ValidatorTrait;

    protected $query     = null;
    protected $longitude = null;
    protected $latitude  = null;
    protected $language  = Dictionary::LANGUAGE_EN;
    protected $limit     = Dictionary::DEFAULT_QUERY_LIMIT;
    protected $osm_tag   = null;

    /**
     * @throws \Photon\Exceptions\ValidException
     */
    public function check()
    {
        $this->validateOrExcept([
            'query'     => 'required|min:3',
            'longitude' => 'between:-180,180',
            'latitude'  => 'between:-180,180',
            'language'  => 'required|in:' . implode(',', Dictionary::getLanguageDictionary()),
            'limit'     => 'required|integer|min:1',
            'osm_tag'   => 'min:3'
        ]);
    }

    /**
     * Get url parameters
     * @return string
     */
    public function getUrlParameters(): string
    {
        $parameters = [
            'q'     => $this->getQuery(),
            'limit' => $this->getLimit(),
            'lang'  => $this->getLanguage(),
        ];
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
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return PhotonQueryRequest $this;
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float|int|null $latitude
     * @return PhotonQueryRequest $this;
     */
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float|int|null $longitude
     * @return PhotonQueryRequest $this;
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
     * @return PhotonQueryRequest $this;
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
     * @return PhotonQueryRequest $this;
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
     * @return PhotonQueryRequest $this;
     */
    public function setOsmTag(?string $osm_tag): self
    {
        $this->osm_tag = $osm_tag;

        return $this;
    }

}