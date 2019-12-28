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
 * Make reverse request to photon system
 * Class PhotonReverseRequest
 * @package Photon
 * @property float|integer $latitude
 * @property float|integer $longitude
 * @property string $language
 * @property integer $limit
 */
class PhotonReverseRequest
{
    use ConfigurableTrait, ValidatorTrait;

    protected $longitude = null;
    protected $latitude  = null;
    protected $language  = Dictionary::LANGUAGE_EN;
    protected $limit     = Dictionary::DEFAULT_REVERSE_LIMIT;

    /**
     * @throws \Photon\Exceptions\ValidException
     */
    public function check()
    {

        $this->validateOrExcept([
            'longitude' => 'required|between:-180,180',
            'latitude'  => 'required|between:-180,180',
            'language'  => 'required|in:' . implode(',', Dictionary::getLanguageDictionary()),
            'limit'     => 'required|integer|min:1',
        ]);
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
            'lon'   => $this->getLongitude(),
            'lat'   => $this->getLatitude(),
        ];

        return http_build_query($parameters);
    }

    /**
     * @return float|int
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float|int $latitude
     * @return PhotonReverseRequest $this;
     */
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float|int $longitude
     * @return PhotonReverseRequest $this;
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
     * @return PhotonReverseRequest $this;
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
     * @return PhotonReverseRequest $this;
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

}