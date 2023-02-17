<?php
/**
 * @var App $kirby
 **/

/**
 * Based on https://getkirby.com/docs/cookbook/content/dynamic-og-images
 */

$kirby->response()->type('image/png');

// Define canvas size
$canvas = imagecreatetruecolor(1200, 628);

// Define colors
$colorYellow      = imagecolorallocate($canvas, 255, 204, 0);
$backgroundColor  = imagecolorallocate($canvas, 255, 255, 255);
$titleColor       = imagecolorallocate($canvas, 51, 51, 51);
$siteTitleColor   = imagecolorallocate($canvas, 17, 50, 100);

// Set background
imagefill($canvas, 0, 0, $backgroundColor);

// Draw rectangle
imagefilledrectangle($canvas, 725, 560, 1130, 565, $colorYellow);

// Path to .ttf font file
$fontFile = './assets/fonts/Vollkorn-Bold.ttf';

// Write page title to canvas
$title  = $page->title()->toString();
$title  = wordwrap($title, 30);
imagefttext($canvas, 45, 0, 100, 150, $titleColor, $fontFile, $title);
imagefttext($canvas, 35, 0, 725, 550, $siteTitleColor, $fontFile, strtoupper($site->title()));

// Place logo in the corner
//$logoFile = './assets/kirby-logo.png';
//$logo     = imagecreatefrompng($logoFile);

//imagecopyresampled($canvas, $logo, 975, 400, 0, 0, imagesx($logo), imagesy($logo), imagesx($logo), imagesy($logo));

// Output image to the browser
imagepng($canvas);
imagedestroy($canvas);