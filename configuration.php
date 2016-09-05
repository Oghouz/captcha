<?php
/**
 * Author: MAERDAN Maimaiti
 * Date: 20/07/2016
 */

return array(
    'captcha_text'  => 7,   //contenu de captcha. 1->chiffre,  2->lettre majuscul,  3->lettre miniscule,  4->1+2,  5->1+3,  6->2+3,  7->1+2+3
    'count_string'  => 3,   //nombre de lettre
    'count_number'  => 3,   //nombre de chiffire
    'add_line'      => 0,   //ajouter des lines dans image de captha
    'add_pixel'     => 0,   //ajouter de pixel dans image de captcha 0->Non  1->Oui
    'set_pixel'     => 1500, // nobmre de point pour pixel, il faut add_pixel => 1
    'font_color'    => 1,   //couleur de contenu captcha 0->noir  1->couleur
    'font_size'     => 30,  //taille de text
    'font_degre'    => 30,  //la pente de text, par degré Ex: 30 pour entre -30° à +30°
    'font_espace'   => 30,  //espace entre chaque caractère
    'weight'        => 200, //largeur d'image
    'height'        => 60,  //hauteur d'image
    'bg_image'      => '',  //le nom d'image pour plan arrière de captcha, si null applique font_color
    'bg_color'      => 1,    // bgColor d'image captcha si pas de bgImage, 1-> blanc  2->personalisr(avec valeur -> bg_color_set)  3->aléatoir (random)
    'bg_color_set'  => '55,155,205' //set bgColor de captcha. il faut bg_color => 2  et sans bgImage
);