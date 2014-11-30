<?php
namespace Utilities;

class Sorter
{
    private static $_instance;
    private $_key;
    private $_natural;
    private function __construct() {}

    public static function get_instance()
    {
        if(!isset(self::$_instance)) {
            self::$_instance = new Sorter();
        }
        return self::$_instance;
    }

    /**
     * Sorts array by key value in the direction specified.
     *
     * @param Array  $array     array to be sorted
     * @param String $key       sorting key
     * @param String $direction direction to sort
     * @param bool   $natural   natural sort
     *
     * @return mixed
     * @throws \Exception
     */
    public function sort($array, $key, $direction, $natural = false)
    {
        $this->_key = $key;
        $this->_natural = $natural;
        switch(strtolower($direction)) {
            case'asc':
                usort($array, array($this,'array_sort_asc'));
            break;
            case'desc':
                usort($array, array($this,'array_sort_desc'));
            break;
            default:
                throw new \Exception('Invalid Sort Direction!');
        }
        return $array;
    }


    private function array_sort_desc($a, $b)
    {
        if($this->_natural) {
            return strnatcasecmp($b[$this->_key], $a[$this->_key]);
        } else {
            return ($a[$this->_key] > $b[$this->_key]) ? -1 : 1;
        }

    }

    private function array_sort_asc($a, $b) {
        if($this->_natural) {
            return strnatcasecmp($a[$this->_key], $b[$this->_key]);
        } else {
            return ($a[$this->_key] < $b[$this->_key]) ? -1 : 1;
        }
    }
}
