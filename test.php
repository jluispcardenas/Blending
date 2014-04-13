<?php
//
// Ejemplo Blending con GD + PHP
// 
// author: Jose Luis Cardenas
// email: jluis.pcardenas@gmail.com
//
//

$path = "liz.jpg";
$path2 = "liz2.jpg";

$img = imagecreatefromjpeg($path);
$img2 = imagecreatefromjpeg($path2);

list($x1, $y1) = getimagesize($path);
list($x2, $y2) = getimagesize($path2);

$img3 = imagecreatetruecolor($x1, $y1);
$alpha = 0.3;

for ($i = 0; $i < $x1; $i++) {
	for ($i2 = 0; $i2 < $y1; $i2++) {
		list($r1, $g1, $b1) = get_rgb($img, $i, $i2);
		list($r2, $g2, $b2) = get_rgb($img2, $i, $i2);
		
		$r3 = round(($r2 * $alpha) + ($r1 * (1.0 - $alpha))); 
		$g3 = round(($g2 * $alpha) + ($g1 * (1.0 - $alpha))); 
		$b3 = round(($b2 * $alpha) + ($b1 * (1.0 - $alpha))); 

		$color = imagecolorallocate($img3, $r3, $g3, $b3);
		imagesetpixel($img3, $i, $i2, $color);
	}
}

header('Content-type: image/png');
imagejpeg($img3);

function get_rgb(&$im, $x, $y) {
	$rgb = imagecolorat($im, $x, $y);
	$r = ($rgb >> 16) & 0xFF;
	$g = ($rgb >> 8) & 0xFF;
	$b = $rgb & 0xFF;
	
	return array($r, $g, $b);
}