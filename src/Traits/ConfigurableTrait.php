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
     * @param array|object $properties
     */
    public function __construct($properties = null)
    {
        if (!is_null($properties)) {
            $this->loading($properties);
        }
        $this::init();
    }

    /**
     * Loading class
     * @param $properties
     */
    private function loading($properties)
    {
        if (is_object($properties)) {
            $properties = get_object_vars($properties);
        }
        foreach ($properties as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Inicialize class
     */
    public function init()
    {

    }
}