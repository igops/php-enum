<?php


namespace Kugaudo\PhpEnum\Basic;


trait StaticTypeHint
{
    /**
     * Workaround for hinting type of static ref
     * @param $reference
     * @return static
     */
    private static function staticRef($reference)
    {
        return $reference;
    }
}