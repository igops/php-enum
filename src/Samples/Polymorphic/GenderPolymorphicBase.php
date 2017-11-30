<?php


namespace Kugaudo\PhpEnum\Samples\Polymorphic;


use Kugaudo\PhpEnum\Basic\BasicPolymorphicEnum;


class GenderPolymorphicBase
{
    use BasicPolymorphicEnum;

    /**
     * @return self[]
     */
    protected static function init()
    {
        return [
            'MALE' => new self('Male'),
            'FEMALE' => new self('Female'),
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
     * @return self
     */
    public static function MALE()
    {
        return self::values()['MALE'];
    }
    /**
     * @return self
     */
    public static function FEMALE()
    {
        return self::values()['FEMALE'];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}