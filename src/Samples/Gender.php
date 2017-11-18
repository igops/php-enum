<?php


namespace Kugaudo\PhpEnum\Samples;


use Kugaudo\PhpEnum\EnumValuesTrait;

class Gender
{
    use EnumValuesTrait;

    private static function initValues()
    {
        return [
            'MALE' => new self(1, 'Male'),
            'FEMALE' => new self(2, 'Female'),
        ];
    }

    /** @var int */
    private $id;
    /** @var string */
    private $title;

    /**
     * Private constructor avoids external creation of the instances.
     * @param int $id
     * @param string $title
     */
    private function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * @return Gender
     */
    public static function MALE()
    {
        return self::values()['MALE'];
    }

    /**
     * @return Gender
     */
    public static function FEMALE()
    {
        return self::values()['FEMALE'];
    }

    /**
     * @param string $title
     * @return null|Gender
     */
    public static function getByTitle(string $title)
    {
        $title2upper = mb_strtoupper($title);
        foreach (self::values() as $value) {
            if (mb_strtoupper($value->title) === $title2upper) {
                return $value;
            }
        }
        return null;
    }

    // Helper methods...
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
        return $this->title . '(' . $this->id . ')';
    }

    // Getters...
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}