<?php
/**
 * Author: MAERDAN Maimaiti
 * Date: 20/07/2016
 */

class Captcha{


    /**
     * Captcha constructor.
     */
    public function __construct()
    {
        if (file_exists(dirname(__FILE__) . '/configuration.php')) {

            $this->config = include('configuration.php');
        } else {

            throw new Exception('Erreur ouverture de fichier configuration.php!');
        }
    }


    /**
     * Generator contenu de code captcha
     *
     * @return string
     */
    public function charCaptcha(){

        $chiffre = '';
        $lettre  = '';
        $number  = '0123456789';
        $string_majuscule  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string_minicule   = 'abcdefghijklmnopqrstuvwxyz';
        $string_maj_min    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        switch ($this->config['captcha_text']){
            case 1:
                for ($i = 0; $i < $this->config['count_number']; $i++)                {
                    $chiffre .= $number{ mt_rand( 0, strlen($number) - 1 ) };
                }
                break;

            case 2:
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_majuscule{ mt_rand( 0, strlen($string_majuscule) - 1 ) };
                }
                break;

            case 3:
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_minicule{ mt_rand( 0, strlen($string_minicule) - 1 ) };
                }
                break;

            case 4:
                for ($i = 0; $i < $this->config['count_number']; $i++)                {
                    $chiffre .= $number{ mt_rand( 0, strlen($number) - 1 ) };
                }
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_majuscule{ mt_rand( 0, strlen($string_majuscule) - 1 ) };
                }
                break;

            case 5:
                for ($i = 0; $i < $this->config['count_number']; $i++)                {
                    $chiffre .= $number{ mt_rand( 0, strlen($number) - 1 ) };
                }
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_minicule{ mt_rand( 0, strlen($string_minicule) - 1 ) };
                }
                break;

            case 6:
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_maj_min{ mt_rand( 0, strlen($string_maj_min) - 1 ) };
                }
                break;
            case 7:
                for ($i = 0; $i < $this->config['count_number']; $i++)                {
                    $chiffre .= $number{ mt_rand( 0, strlen($number) - 1 ) };
                }
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_maj_min{ mt_rand( 0, strlen($string_maj_min) - 1 ) };
                }
                break;

            default:
                for ($i = 0; $i < $this->config['count_number']; $i++)                {
                    $chiffre .= $number{ mt_rand( 0, strlen($number) - 1 ) };
                }
                for ($j = 0; $j < $this->config['count_string']; $j++)                {
                    $lettre  .= $string_maj_min{ mt_rand( 0, strlen($string_maj_min) - 1 ) };
                }
        }

        return str_shuffle($chiffre.$lettre);

    }


    /**
     * @param $image
     * @param $code.
     */
    public function captchaImgText($image, $code)
    {

        $fonts = glob(dirname(__FILE__).'/fonts/*.ttf');
        $count = $this->config['count_string'] + $this->config['count_number'];
        for ($i = 0; $i < $count; $i++)
        {

            imagettftext(
                $image,
                $this->config['font_size'],  //taille de font
                rand(-$this->config['font_degre'], $this->config['font_degre']),  // la pente de font
                $this->config['font_espace'] * $i,     //espace entre le text
                rand(30, 40),    //hauteur de text
                $this->colorTextCaptcha($image)[array_rand($this->colorTextCaptcha($image))],   //couleur
                $fonts[array_rand($fonts)], substr($code, $i, 1)   //type de font
            );
        }
    }


    /**
     * @param $image
     */
    public function addLine($image)
    {
        if($this->config['add_line'] == 1){

            for($i = 0; $i < 5; $i++) {

                $line_color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
                imageline($image, 0, rand()%80, 200, rand()%80, $line_color);
            }

        }
    }


    /**
     * @param $image
     */
    public function addPixel($image)
    {
        if($this->config['add_pixel'] == 1){

            for($i = 0; $i < $this->config['set_pixel'] ; $i++) {

                $pixel_color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
                imagesetpixel($image, rand()%200, rand()%50, $pixel_color);
            }

        }
    }


    /**
     * @return resource
     */
    public function bgImgCaptcha()
    {
        if(!empty($this->config['bg_image'])){

            return imagecreatefrompng(dirname(__FILE__).'/image/'.$this->config['bg_image']);

        }else{

            return imagecreate($this->config['weight'], $this->config['height']);
        }

    }


    /**
     * @param $image
     * @return array
     */
    public function colorTextCaptcha($image)
    {
        if($this->config['font_color'] == 1){

            $colors = array (
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
                imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255)),
            );

        }else{

            $colors = array(
                imagecolorallocate($image, 0, 0, 0),
            );
        }

        return $colors;
    }


    /**
     * @param $image
     * @return int
     */
    public function bgColorCaptcha($image)
    {
        switch ($this->config['bg_color']){

            case 1:
                return imagecolorallocate($image, 255, 255, 255);
                break;
            case 2:
                $color = explode(",", $this->config['bg_color_set']);
                return imagecolorallocate($image, $color[0], $color[1], $color[2]);
                break;
            default:
                break;
        }
    }

}