<?php


namespace Kugaudo\PhpEnum\Basic;


trait BasicEnum
{
    use BasicEnumHelpers;

    /** @var null|static[] */
    private static $values = null;

    /**
     * @return static[]
     */
    protected static function init()
    {
        return [];
    }

    /**
     * @return static[]
     */
    public static function values()
    {
        if (static::$values === null) {
            static::$values = static::init();
        }
        return static::$values;
    }
}