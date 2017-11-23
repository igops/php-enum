<?php


namespace Kugaudo\PhpEnum\Basic;


trait BasicPrimaryKeyEnum
{
    use BasicEnum;

    /** @var mixed */
    protected $pk;

    /**
     * @param mixed $pk Primary key
     * @return null|static
     */
    public static function find($pk)
    {
        return static::findOneBy(function($item) use ($pk) {
            return static::staticRef($item)->pk === $pk;
        });
    }

    /**
     * @return mixed
     */
    public function getPk()
    {
        return $this->pk;
    }
}