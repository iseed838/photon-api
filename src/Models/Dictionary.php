<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 28.12.19
 * Time: 13:18
 */

namespace Photon\Models;


class Dictionary
{
    const LANGUAGE_EN           = 'en';
    const LANGUAGE_RU           = 'ru';
    const DEFAULT_URL           = 'http://photon.komoot.de';
    const DEFAULT_QUERY_LIMIT   = 5;
    const DEFAULT_REVERSE_LIMIT = 1;
    const OSM_TAG_STREET        = 'highway';
    const OSM_TAG_PLACE         = 'place';
    const OSM_TAG_HOUSE         = 'place:house';


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

}