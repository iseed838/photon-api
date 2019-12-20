<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 19.12.19
 * Time: 12:59
 */

namespace Photon\Models;

/**
 * Class ClientConfig
 * @package Photon\Models
 * @property string $url
 * @property string|null $base_auth_username
 * @property string|null $base_auth_password
 */
class ClientConfig extends BaseModel
{
    protected $url                = null;
    protected $base_auth_username = null;
    protected $base_auth_password = null;

    public function checkConfig()
    {
        return [
            'url'                => 'required|url',
            'base_auth_username' => 'alpha_num',
            'base_auth_password' => 'alpha_num',
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return ClientConfig $this;
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBaseAuthUsername(): ?string
    {
        return $this->base_auth_username;
    }

    /**
     * @param null|string $base_auth_username
     * @return ClientConfig $this;
     */
    public function setBaseAuthUsername(?string $base_auth_username): self
    {
        $this->base_auth_username = $base_auth_username;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBaseAuthPassword(): ?string
    {
        return $this->base_auth_password;
    }

    /**
     * @param null|string $base_auth_password
     * @return ClientConfig $this;
     */
    public function setBaseAuthPassword(?string $base_auth_password): self
    {
        $this->base_auth_password = $base_auth_password;

        return $this;
    }


}