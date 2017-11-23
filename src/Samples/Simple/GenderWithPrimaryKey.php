<?php


namespace Kugaudo\PhpEnum\Samples\Simple;


use Kugaudo\PhpEnum\Basic\BasicPrimaryKeyEnum;

/**
 * The "final" modifier provides integrity of static fields
 */
final class GenderWithPrimaryKey
{
    use BasicPrimaryKeyEnum;

    /**
     * @return self[]
     */
    protected static function init()
    {
        return [
            'MALE' => new self(1, 'Male'),
            'FEMALE' => new self(2, 'Female'),
        ];
    }

    /** @var string */
    private $title;

    /**
     * Private constructor avoids external creation of the instances.
     * @param int $pk Primary key
     * @param string $title Title
     */
    private function __construct($pk, $title)
    {
        $this->title = $title;
        $this->pk = $pk;
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
     * @return int
     */
    public function getPk(): int
    {
        return $this->pk;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}