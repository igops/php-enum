<?php


namespace Kugaudo\PhpEnum\Basic;


trait BasicEnumHelpers
{
    use StaticTypeHint;

    /**
     * @return static[]
     */
    public static function values()
    {
        return [];
    }

    /**
     * @param callable $filter
     * @return array
     */
    public static function findBy(callable $filter)
    {
        return array_filter(static::values(), $filter);
    }

    /**
     * @param callable $filter
     * @return null|static
     */
    public static function findOneBy(callable $filter)
    {
        foreach (static::values() as $value) {
            if ($filter($value)) {
                return $value;
            }
        }
        return null;
    }
}