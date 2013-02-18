<?php
namespace Mokos;
/**
 * Mokos
 *
 * LICENCE
 *   The MIT License
 *
 * @author derhaa 
 * @category   Translator
 * @package    Mokos
 * @copyright  Copyright (c) 2012 Tomas Cejka (http://mokos.tomascejka.eu)
 * @license    http://opensource.org/licenses/mit-license.php - The MIT License
 * 
 * Base interface for generate process
 */
class Translator {
    /**
     * @var array 
     */
    private static $translations;
    /**
     * @param array $translations
     */
    public function __construct(array $translations) 
    {
        self::$translations = array_merge($translations, array());
    }
    public static function translate($key)
    {
        self::$translations = array(
            'actor_id' => 'actor',
            'film_id'  => 'film',
        );
        if(is_null($key)) return $key;
        if(array_key_exists($key, self::$translations)) return self::$translations[$key];
        return $key;
    }
}
