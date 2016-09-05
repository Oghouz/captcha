<?php session_start(); ?>

<img src="capthca_img.php"
     id="captcha"
     onclick="document.images.captcha.src='capthca_img.php?id='+Math.round(Math.random(0)*1000)"
/>

<img src="image/reload.png"
     alt="Recharger l'image" title="Recharger l'image"
     onclick="document.images.captcha.src='capthca_img.php?id='+Math.round(Math.random(0)*1000)"
     height="30"
     width="30"
/>
<form action="test.php" method="post">
    <input type="text" name="captcha" placeholder="Entre contenu d'image"  required>
    <input type="submit" value="OK" name="valide">
</form>

<?php

if(isset($_POST['valide'])){

    echo "<br>";
    if($_SESSION['session_code_captcha_check'] == $_POST['captcha'])
    {
        echo "<h2><font color='#006400'>Saisiz Captcha OK</font></h2>";
    }else{
        echo "Erreur<br>";
        echo "Captcha: ".$_SESSION['session_code_captcha_check']."<br>";
        echo "Votre saisiz: ".$_POST['captcha'];
    }

}

?>

