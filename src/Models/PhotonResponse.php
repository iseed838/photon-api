<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 18.12.19
 * Time: 15:19
 */

namespace Photon\Models;

use Photon\Traits\ConfigurableTrait;


/**
 * Photon response model
 * Class PhotonFeatureResponse
 * @package Photon
 * @property null|integer $osm_id
 * @property null|string $osm_type
 * @property null|array $extent
 * @property null|string $osm_key
 * @property null|string $osm_value
 * @property null|string $postcode
 * @property null|string $countrycode
 * @property null|string $country
 * @property null|string $state
 * @property null|string $city
 * @property null|string $street
 * @property null|string $housenumber
 * @property null|string $name
 * @property null|float|integer $latitude
 * @property null|float|integer $longitude
 * @property null|string $type
 */
class PhotonResponse
{
    use ConfigurableTrait;

    // Property section
    protected $osm_id      = null;
    protected $osm_type    = null;
    protected $extent      = null;
    protected $osm_key     = null;
    protected $osm_value   = null;
    protected $postcode    = null;
    protected $countrycode = null;
    protected $country     = null;
    protected $state       = null;
    protected $city        = null;
    protected $street      = null;
    protected $housenumber = null;
    protected $name        = null;

    // Geometry section
    protected $latitude  = null;
    protected $longitude = null;
    protected $type      = null;

    /**
     * @return int|null
     */
    public function getOsmId(): ?int
    {
        return $this->osm_id;
    }

    /**
     * @param int|null $osm_id
     * @return PhotonResponse $this;
     */
    public function setOsmId(?int $osm_id): self
    {
        $this->osm_id = $osm_id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOsmType(): ?string
    {
        return $this->osm_type;
    }

    /**
     * @param null|string $osm_type
     * @return PhotonResponse $this;
     */
    public function setOsmType(?string $osm_type): self
    {
        $this->osm_type = $osm_type;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getExtent(): ?array
    {
        return $this->extent;
    }

    /**
     * @param array|null $extent
     * @return PhotonResponse $this;
     */
    public function setExtent(?array $extent): self
    {
        $this->extent = $extent;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOsmKey(): ?string
    {
        return $this->osm_key;
    }

    /**
     * @param null|string $osm_key
     * @return PhotonResponse $this;
     */
    public function setOsmKey(?string $osm_key): self
    {
        $this->osm_key = $osm_key;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOsmValue(): ?string
    {
        return $this->osm_value;
    }

    /**
     * @param null|string $osm_value
     * @return PhotonResponse $this;
     */
    public function setOsmValue(?string $osm_value): self
    {
        $this->osm_value = $osm_value;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param null|string $postcode
     * @return PhotonResponse $this;
     */
    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountrycode(): ?string
    {
        return $this->countrycode;
    }

    /**
     * @param null|string $countrycode
     * @return PhotonResponse $this;
     */
    public function setCountrycode(?string $countrycode): self
    {
        $this->countrycode = $countrycode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param null|string $country
     * @return PhotonResponse $this;
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param null|string $state
     * @return PhotonResponse $this;
     */
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     * @return PhotonResponse $this;
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param null|string $street
     * @return PhotonResponse $this;
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHouseNumber(): ?string
    {
        return $this->housenumber;
    }

    /**
     * @param null|string $houseNumber
     * @return PhotonResponse $this;
     */
    public function setHouseNumber(?string $houseNumber): self
    {
        $this->housenumber = $houseNumber;

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
     * @return PhotonResponse $this;
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
     * @return PhotonResponse $this;
     */
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     * @return PhotonResponse $this;
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

}