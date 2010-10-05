<?

//Set some scope variables.
$shape			= @$_GET['s'];
$color			= @$_GET['c'];
$width			= @$_GET['w'];

//Set a default width if it doesn't exist.
if(!$width) {
	$w_h			= 18;
}
else {
	$w_h			= $width;
}

//Convert the HEX color to RGB
$color_array 	= convert_color($color);

//Set the header to a png.
header('Content-type: image/png');

//Build base image
$image 			= ImageCreate($w_h, $w_h);
imageAntialias($image, true);
$imageColor 	= ImageColorAllocateAlpha($image, 255, 255, 255, 127);
$shapeColor 	= ImageColorAllocate($image, $color_array['r'], $color_array['g'], $color_array['b']);
// $borderColor 	= ImageColorAllocateAlpha($image, $color_array['r'], $color_array['g'], $color_array['b'], 30);



//Add shape to image
switch ($shape) {
	case 'square':
		ImageFilledRectangle($image, 0, 0, $w_h, $w_h, $shapeColor);
		// ImageRectangle($image, 0, 0, $w_h, $w_h, $borderColor);
		break;
	
	case 'circle':
		imageFilledEllipse($image, ($w_h / 2), ($w_h / 2), $w_h - 2, $w_h - 2, $shapeColor);
		// imageCircleAA($image, ($w_h / 2), ($w_h / 2), $w_h - 2, $w_h - 2, 0, 0, $color_array);
		// imageEllipse($image, ($w_h / 2), ($w_h / 2), $w_h, $w_h, $borderColor);
		break;
	
	case 'triangle':
		$tri_points		= array(	
									($w_h / 2), 0,
									$w_h, $w_h,
									0, $w_h
									);
		imageFilledPolygon($image, $tri_points, 3, $shapeColor);
		// imagePolygon($image, $tri_points, 3, $borderColor);
		break;
	case 'diamond':
		$di_points		= array(	
									($w_h / 2), 0,
									$w_h, ($w_h / 2),
									($w_h / 2), $w_h,
									0, ($w_h / 2),
									);
		imageFilledPolygon($image, $di_points, 4, $shapeColor);
		// imagePolygon($image, $tri_points, 4, $borderColor);
		break;
	default:
		# code...
		break;
}

//Output image
imagepng($image);
imagedestroy($image);

function convert_color($hex) {
	//See if the HEX number is 6 characters
	if(strlen($hex) == 6) {
		//Grab the red values (first two chars)
		$r			= substr($hex, 0, 2);
		//Grab the green values (second two chars)
		$g			= substr($hex, 2, 2);
		//Grab the blue values (last two chars)
		$b			= substr($hex, -2);
		
		// echo $r . '<br />' . $g . '<br />' . $b;
		
		$rgb_array 	= array(	'r' => hexdec($r),
								'g' => hexdec($g),
								'b' => hexdec($b)
							);
		
		return $rgb_array;
	}
	elseif(strlen($hex) == 3) {
		
		//Grab the red values (first two chars)
		$r			= substr($hex, 0, 1) . substr($hex, 0, 1);
		//Grab the green values (second two chars)
		$g			= substr($hex, 1, 1) . substr($hex, 1, 1);
		//Grab the blue values (last two chars)
		$b			= substr($hex, -1) . substr($hex, -1);
		
		$rgb_array 	= array(	'r' => hexdec($r),
								'g' => hexdec($g),
								'b' => hexdec($b)
							);
		
		return $rgb_array;
		
	}
	else {
		return false;
	}
	
}

// image, centerX, centerY, radius, stroke width, aa width, tightness, color
function imageCircleAA($img, $cx, $cy, $r, $w, $s, $t, $color) {
	
	// echo "\n<strong>" . __FILE__ . " Line: " . __LINE__ . "</strong>\n";
	// echo "\n<pre style=\"text-align:left; line-height:1.1em;\">\n";
	// print_r($color);
	// echo "</pre>\n";
	
	
	$adj = $w + $s;
	$sCol = imagecolorallocate($img, $color['r'], $color['g'], $color['b']);
	for($x = -$r - $adj; $x <= $r + $adj; $x++) {
		for($y = -$r - $adj; $y <= $r + $adj; $y++) {
			$d = sqrt($x * $x + $y * $y); // distance from pixel to center
			$err = abs($d - $r); // absolute distance from pixel to circle edge
			if($err <= $w / 2 + $s) // within the stroke width + smoothing radius
			{
				if($err <= $w / 2) // inside the stroke width so make it solid color
				{
					$aaCol = $sCol;
				}
				else // in the antialisaing region so make it a blended color
				{
					$err -= $w / 2; // adjust to the aliased part
					$err = 1 - $err / $s; // adjust to between 0 and 1
					$err = ($err - 0.5) * $t * 2; // adjust to -$t to +$t for tightness
					$err = ($err / sqrt(1 + $err * $err) + 1) / 2; // sigmoid curve to smooth edges
					$rgb = imagecolorat($img, $x + $cx, $y + $cy); // Get current background color
					$rB = ($rgb >> 16) & 0xFF;
					$gB = ($rgb >> 8) & 0xFF;
					$bB = $rgb & 0xFF;
					$rDelta = ($rB - $color['r']); // change in Red from background
					$rComp = $rB - $rDelta * $err; // mix Red
					$gDelta = ($gB - $color['g']); // change in Red from background
					$gComp = $gB - $gDelta * $err; // mix Red
					$bDelta = ($bB - $color['b']); // change in Red from background
					$bComp = $bB - $bDelta * $err; // mix Red
					$aaCol = imagecolorallocate($img, $rComp, $gComp, $bComp);
				}
				imagesetpixel($img, $x + $cx, $y + $cy, $aaCol);
			}
		}
	}
}

?>