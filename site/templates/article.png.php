<?php
/**
 * @var App $kirby
 **/

/**
 * Based on https://getkirby.com/docs/cookbook/content/dynamic-og-images
 */

$kirby->response()->type('image/png');

// Define canvas size
$canvas = imagecreatetruecolor(2400, 1200);

// Define colors
$colorYellow      = imagecolorallocate($canvas, 212, 173, 33);
$backgroundColor  = imagecolorallocate($canvas, 249, 249, 251);
$titleColor       = imagecolorallocate($canvas, 22, 26, 34);
$siteTitleColor   = imagecolorallocate($canvas, 25,47,77);

// Set background
imagefill($canvas, 0, 0, $backgroundColor);

// Draw rectangle
imagefilledrectangle($canvas, 1450, 1120, 2260, 1130, $colorYellow);

// Path to .ttf font file
$fontFile = './assets/fonts/Vollkorn-Bold.ttf';

// Write page title to canvas
$title  = $page->title()->toString();
$title  = wordwrap($title, 30);
imagefttext($canvas, 90, 0, 200, 300, $titleColor, $fontFile, $title);
imagefttext($canvas, 70, 0, 1450, 1100, $siteTitleColor, $fontFile, strtoupper($site->title()));

// Place logo in the corner
//$logoFile = './assets/kirby-logo.png';
//$logo     = imagecreatefrompng($logoFile);

//imagecopyresampled($canvas, $logo, 975, 400, 0, 0, imagesx($logo), imagesy($logo), imagesx($logo), imagesy($logo));

// Output image to the browser
imagepng($canvas);
imagedestroy($canvas);
