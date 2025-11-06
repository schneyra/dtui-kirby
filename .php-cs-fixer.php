<?php

// define which files should be analyzed
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/site')
    ->in(__DIR__ . '/site')->exclude('accounts')
    ->in(__DIR__ . '/site')->exclude('plugins/kirby-fingerprint')
    ->in(__DIR__ . '/site')->exclude('plugins/retour')
;

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
