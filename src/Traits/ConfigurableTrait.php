<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 06.06.19
 * Time: 17:29
 */

namespace Photon\Traits;

/**
 * Base constructor
 * Trait Configurable
 */
trait ConfigurableTrait
{
    /**
     * Replace base constructor
     * ConfigurableTrait constructor.
     * @param array $properties
     */
    public function __construct($properties = [])
    {
        if (is_array($properties) && !empty($properties)) {
            $this->configure($properties);
        }
        $this->init();
    }

    /**
     * Loading class
     * @param $properties
     */
    public function configure($properties)
    {
        foreach ($properties as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Initialization class
     */
    public function init()
    {

    }
}