<?php

// define which files should be analyzed
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/site')
;

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
