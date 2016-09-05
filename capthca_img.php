<?php
/**
 * Author: MAERDAN Maimaiti
 * Date: 20/07/2016
 */
session_start();

require_once('captcha.class.php');

$Capthca = new Captcha();

$code = $Capthca->charCaptcha();
$_SESSION['session_code_captcha_check'] = $code;

$image = $Capthca->bgImgCaptcha();

$Capthca->bgColorCaptcha($image);
$Capthca->captchaImgText($image, $code);
$Capthca->addLine($image);
$Capthca->addPixel($image);

header('Content-Type: image/png');
         
imagepng($image);

imagedestroy($image);