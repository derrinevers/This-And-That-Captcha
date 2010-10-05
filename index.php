<?
include 'gg_captcha.php';

$captcha		= new GG_Captcha();
$captcha->setColors(array('f00', '0f0', '00f', '000'));
// $captcha->image_size = 18;


//$captcha->removeColors(array('000000'));
//$captcha->dumpObject();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Title</title>
	</head>
	<body>
		<form method="post" action="submit.php">
			<?= $captcha->buildHTML(); ?>
			<input type="submit" value="submit" name="submit" />
		</form>
	</body>
</html>