<?php


namespace Kugaudo\PhpEnum;


trait EnumValuesTrait
{
    /** @var static[] */
    private static $values = [];

    /**
     * @return static[]
     */
    public static function values()
    {
        if (empty(self::$values)) {
            self::$values = self::initValues();
        }
        return self::$values;
    }
}