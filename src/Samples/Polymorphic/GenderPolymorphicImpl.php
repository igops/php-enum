<?php


namespace Kugaudo\PhpEnum\Samples\Polymorphic;


use Kugaudo\PhpEnum\Basic\BasicEnum;

class GenderPolymorphicImpl implements GenderPolymorphicInterface
{
    use BasicEnum;

    /**
     * @return static[]
     */
    protected static function init()
    {
        return [
            'MALE' => new static('Male'),
            'FEMALE' => new static('Female'),
            'ALIEN' => new static('Alien'),
        ];
    }

    /**
     * Protected members might be accessed from child classes
     * @var string
     */
    protected $title;

    /**
     * Protected constructor avoids external creation of the instances.
     * @param string $title Title
     */
    protected function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return static
     */
    public static function MALE()
    {
        return static::values()['MALE'];
    }

    /**
     * @return static
     */
    public static function FEMALE()
    {
        return static::values()['FEMALE'];
    }

    /**
     * @return static
     */
    public static function ALIEN()
    {
        return static::values()['ALIEN'];
    }

    /**
     * Overridden method
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}