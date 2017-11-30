<?php


namespace Kugaudo\PhpEnum\Samples\Simple;


use Kugaudo\PhpEnum\Basic\BasicEnum;

/**
 * The "final" modifier provides integrity of static fields
 */
final class GenderMinimal
{
    use BasicEnum;

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

    /** @var string */
    private $title;

    /**
     * Private constructor avoids external creation of the instances.
     * @param string $title Title
     */
    private function __construct($title)
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