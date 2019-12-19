<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 06.06.19
 * Time: 17:29
 */

namespace Photon\Traits;

/**
 * Arrayble methods
 * Trait Configurable
 */
trait ArrayableTrait
{

    /**
     * Convert object properties to array
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }


}