<?php


namespace Kugaudo\PhpEnum\Samples\Polymorphic;


use Kugaudo\PhpEnum\Basic\StaticTypeHint;

/**
 * Make sure you DO NOT use Enum trait here
 */
class GenderPolymorphicBaseExt extends GenderPolymorphicBase
{
    use StaticTypeHint;

    /**
     * @return self[]
     */
    protected static function init()
    {
        return array_merge(parent::init(), [
            'ALIEN' => new self('Alien'),
        ]);
    }

    /**
     * @return self
     */
    public static function ALIEN()
    {
        return self::values()['ALIEN'];
    }

    /**
     * @return self[]
     */
    public static function getHumans()
    {
        return self::findBy(function($item) {
            return $item !== self::ALIEN();
        });
    }

    /**
     * @return string[]
     */
    public static function getHumanTitles()
    {
        return array_map(
            function($item) {
                // title is visible
                return self::staticRef($item)->title;
            },
            self::getHumans()
        );
    }
}