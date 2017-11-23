<?php


namespace Kugaudo\PhpEnum\Basic;


trait BasicPolymorphicEnum
{
    use BasicEnumHelpers;

    /** @var array */
    protected static $values = [];

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
        $class = get_called_class();
        if (!isset(static::$values[$class])) {
            static::$values[$class] = static::init();
        }
        return static::$values[$class];
    }
}