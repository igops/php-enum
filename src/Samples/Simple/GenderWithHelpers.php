<?php


namespace Kugaudo\PhpEnum\Samples\Simple;


use Kugaudo\PhpEnum\Basic\BasicEnum;

/**
 * The "final" modifier provides integrity of static fields
 */
final class GenderWithHelpers
{
    use BasicEnum;

    /**
     * @return self[]
     */
    protected static function init()
    {
        return [
            'MALE' => new self( 'Male', 'M'),
            'FEMALE' => new self( 'Female', 'F'),
        ];
    }

    /** @var string */
    private $title;

    /** @var string */
    private $shortCode;

    /**
     * Private constructor avoids external creation of the instances.
     * @param string $title Title
     * @param string $shortCode Short code
     */
    private function __construct($title, $shortCode)
    {
        $this->title = $title;
        $this->shortCode = $shortCode;
    }

    /**
     * @return static
     */
    public static function MALE()
    {
        return self::values()['MALE'];
    }

    /**
     * @return static
     */
    public static function FEMALE()
    {
        return self::values()['FEMALE'];
    }

    /**
     * @param string $title
     * @return null|self
     */
    public static function findByTitle(string $title)
    {
        return self::values()[strtoupper($title)] ?? null;
    }

    /**
     * @param string $code
     * @return null|self
     */
    public static function findByShortCode(string $code)
    {
        $code2upper = strtoupper($code);
        return self::findOneBy(function($item) use ($code2upper) {
            return self::staticRef($item)->shortCode === $code2upper;
        });
    }

    /**
     * @return bool
     */
    public function isMale()
    {
        return $this === self::MALE();
    }

    /**
     * @return bool
     */
    public function isFemale()
    {
        return $this === self::FEMALE();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}