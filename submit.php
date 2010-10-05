<?
	include 'gg_captcha.php';
	$captcha		= new GG_Captcha();
	$captcha->validate($_POST, 'test', array('THIS IS A TEST ARRRRRRGGG!'));
	$captcha->dumpObject('validation');
	
	function test($args) {
		echo $args[0];
	}
?>