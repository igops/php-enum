<?php


namespace Kugaudo\PhpEnum\Samples;


require_once __DIR__.'/../vendor/autoload.php';

(new UsageSample)
    ->minimalisticSample()
    ->primaryKeySample()
    ->helperMethodsSample()
    ->polymorphicSample()
;

die('Execution of UsageSample completed without exceptions');