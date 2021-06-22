<?php

include_once ('./heros/Heros.php');
include_once ('./heros/Mage.php');
include_once ('./heros/Warrior.php');
include_once ('./heros/Rogue.php');

include_once ('./mobs/Monstres.php');
include_once ('./mobs/Goblin.php');
include_once ('./mobs/Ogre.php');
include_once ('./mobs/Dragon.php');

session_start();



error_reporting(E_ALL ^ E_NOTICE);

$targetDir = "img/";
$targetFile = $targetDir.$_FILES['fileTest']['name'];

$upload = true;

$ext = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

if(file_exists($targetFile)){
    //echo "Ce fichier existe déjà";
    $upload = false;
}

if($_FILES['fileTest']['size']>5000000){
    //echo "Fichier supérieur à 5MO";
    $upload = false;
}

if($ext == "jpg" || $ext == "png"){

}else {
    //echo "Veuillez envoyer un fichier jpg ou png";
    $upload = false;
}

if($upload == true){
    if(move_uploaded_file($_FILES['fileTest']['tmp_name'], $targetFile)){
        echo "Ca marche";
    }else {
        echo "Ca marche po";
    }
}

if ($_POST['class'] == 'Mage') {
    $$_POST['name'] = new Mage($_POST['name'], $targetFile);


} elseif ($_POST['class'] == 'Warrior') {
    $$_POST['name'] = new Warrior($_POST['name'], $targetFile);


} elseif ($_POST['class'] == 'Rogue') {
    $$_POST['name'] = new Rogue($_POST['name'], $targetFile);


}

$arrPerso = [];


if(sizeof($arrPerso)<1){
    array_push($arrPerso , $$_POST['name']);
}

$$_POST['name']->setLevel(20);

$$_POST['name']->getLevel();



/* COMBAT 1 */

$goblin = new Gobelin($$_POST['name']->getLevel(), 'img/goblin.jpg', "Jex Vividfingers");

$arrPerso[] = $goblin;

while ($goblin->getHp()>=0 && $$_POST['name']->getHp()>=0){
    print_r($$_POST['name']->attack($goblin)) ;
    print_r($goblin->attack($$_POST['name'])) ;
}

if($$_POST['name']->getHp()>0){
    $$_POST['name']->levelUp();
    $hpRestants = $$_POST['name']->getHp();
    if($hpRestants<$$_POST['name']->getHpMax() && $$_POST['name']->setHp($hpRestants+($hpRestants*0.5))<$$_POST['name']->getHpMax()){

        $$_POST['name']->setHp($hpRestants+($hpRestants*0.5));

    }
    $manaRestants = $$_POST['name']->getMana();
    if($manaRestants<$$_POST['name']->getManaMax() && $$_POST['name']->setMana($manaRestants+($manaRestants*0.5))<$$_POST['name']->getManaMax()){

        $$_POST['name']->setMana($manaRestants+($manaRestants*0.5));
        if(get_class($$_POST['name']) == "Mage"){
            $$_POST['name']->setMana($manaRestants+($manaRestants-$$_POST['name']->getManaMax()*0.5));
        }
    }
    $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 1];
    echo $$_POST['name']->getName()." se repose et regagne ".$hpRestants*0.5." hp "." et ".$manaRestants*0.5." mana "."<br>"."<br>";
   // unset($arrPerso[array_search($goblin, $arrPerso)]);
}else {
    $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 0];
    $name = $_SESSION['hero'][0];
    $level = $_SESSION['hero'][1];
    $hp = $_SESSION['hero'][2];
    $mana = $_SESSION['hero'][3];
    $win = $_SESSION['hero'][4];
    echo "<div class='content'>
            <h2 class='dead'> Vous êtes mort </h2>
             <p class='resume'> $name a sucombé au Goblin. Nombre de combat(s) gagné(s): $win</p> 
          <a href='index.php' class='return'>Créer un nouveau personnage</a> 
          </div>
           ";
}

/* COMBAT 2 */

if($_SESSION['hero'][2]>0) {

    $goblin = new Gobelin($$_POST['name']->getLevel(), 'img/goblin.jpg', "Bet Gigabucket");

    $arrPerso[] = $goblin;

    while ($goblin->getHp() >= 0 && $$_POST['name']->getHp() >= 0) {
        print_r($$_POST['name']->attack($goblin));
        print_r($goblin->attack($$_POST['name']));
    }

    if ($$_POST['name']->getHp() > 0) {
        $$_POST['name']->levelUp();
        $hpRestants = $$_POST['name']->getHp();
        if($hpRestants<$$_POST['name']->getHpMax() && $$_POST['name']->setHp($hpRestants+($hpRestants*0.5))<$$_POST['name']->getHpMax()){

            $$_POST['name']->setHp($hpRestants+($hpRestants*0.5));

        }
        $manaRestants = $$_POST['name']->getMana();
        if($manaRestants<$$_POST['name']->getManaMax() && $$_POST['name']->setMana($manaRestants+($manaRestants*0.5))<$$_POST['name']->getManaMax()){

            $$_POST['name']->setMana($manaRestants+($manaRestants*0.5));
            if(get_class($$_POST['name']) == "Mage"){
                $$_POST['name']->setMana($manaRestants+($manaRestants-$$_POST['name']->getManaMax()*0.5));
            }

        }
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp(), $$_POST['name']->getMana(), 2];
        echo $$_POST['name']->getName()." se repose et regagne ".$hpRestants*0.5." hp "." et ".$manaRestants*0.5." mana "."<br>"."<br>";
        // unset($arrPerso[array_search($goblin, $arrPerso)]);
    } else {
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp(), $$_POST['name']->getMana(), 1];
        $name = $_SESSION['hero'][0];
        $level = $_SESSION['hero'][1];
        $hp = $_SESSION['hero'][2];
        $mana = $_SESSION['hero'][3];
        $win = $_SESSION['hero'][4];
        echo "<div class='content'>
            <h2 class='dead'> Vous êtes mort </h2>
             <p class='resume'> $name a sucombé au Goblin. Nombre de combat(s) gagné(s): $win</p> 
          <a href='index.php' class='return'>Créer un nouveau personnage</a> 
          </div>
    ";
    }
}




/* COMBAT 3 */

if($_SESSION['hero'][2]>0){

    $goblin = new Gobelin($$_POST['name']->getLevel()+1, 'img/goblin.jpg', "Kel Roughdirt");

    $arrPerso[] = $goblin;

    while ($goblin->getHp()>=0 && $$_POST['name']->getHp()>=0){
        print_r($$_POST['name']->attack($goblin)) ;
        print_r($goblin->attack($$_POST['name'])) ;
    }

    if($$_POST['name']->getHp()>0){
        $$_POST['name']->levelUp();
        $hpRestants = $$_POST['name']->getHp();
        if($hpRestants<$$_POST['name']->getHpMax() && $$_POST['name']->setHp($hpRestants+($hpRestants*0.5))<$$_POST['name']->getHpMax()){

            $$_POST['name']->setHp($hpRestants+($hpRestants*0.5));

        }
        $manaRestants = $$_POST['name']->getMana();
        if($manaRestants<$$_POST['name']->getManaMax() && $$_POST['name']->setMana($manaRestants+($manaRestants*0.5))<$$_POST['name']->getManaMax()){

            $$_POST['name']->setMana($manaRestants+($manaRestants*0.5));
            if(get_class($$_POST['name']) == "Mage"){
                $$_POST['name']->setMana($manaRestants+($manaRestants-$$_POST['name']->getManaMax()*0.5));
            }

        }
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 3];
        echo $$_POST['name']->getName()." se repose et regagne ".$hpRestants*0.5." hp "." et ".$manaRestants*0.5." mana "."<br>"."<br>";
        // unset($arrPerso[array_search($goblin, $arrPerso)]);
    }else {
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 2];
        $name = $_SESSION['hero'][0];
        $level = $_SESSION['hero'][1];
        $hp = $_SESSION['hero'][2];
        $mana = $_SESSION['hero'][3];
        $win = $_SESSION['hero'][4];
        echo "<div class='content'>
            <h2 class='dead'> Vous êtes mort </h2>
             <p class='resume'> $name a sucombé au Goblin. Nombre de combat(s) gagné(s): $win</p> 
          <a href='index.php' class='return'>Créer un nouveau personnage</a> 
          </div>
    ";
    }
}



/* COMBAT 4 */


if($_SESSION['hero'][2]>0){

    $ogre = new Ogre($$_POST['name']->getLevel(), 'img/ogre.jpg', "Uruks");

    $arrPerso[] = $ogre;

    while ($ogre->getHp()>=0 && $$_POST['name']->getHp()>=0){
        print_r($$_POST['name']->attack($ogre)) ;
        print_r($ogre->attack($$_POST['name'])) ;
    }

    if($$_POST['name']->getHp()>0){
        $$_POST['name']->levelUp();
        $hpRestants = $$_POST['name']->getHp();
        if($hpRestants<$$_POST['name']->getHpMax() && $$_POST['name']->setHp($hpRestants+($hpRestants*0.5))<$$_POST['name']->getHpMax()){

            $$_POST['name']->setHp($hpRestants+($hpRestants*0.5));

        }
        $manaRestants = $$_POST['name']->getMana();
        if($manaRestants<$$_POST['name']->getManaMax() && $$_POST['name']->setMana($manaRestants+($manaRestants*0.5))<$$_POST['name']->getManaMax()){

            $$_POST['name']->setMana($manaRestants+($manaRestants*0.5));
            if(get_class($$_POST['name']) == "Mage"){
                $$_POST['name']->setMana($manaRestants+($manaRestants-$$_POST['name']->getManaMax()*0.5));
            }

        }
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 4];
        echo $$_POST['name']->getName()." se repose et regagne ".$hpRestants*0.5." hp "." et ".$manaRestants*0.5." mana "."<br>"."<br>";
        //unset($arrPerso[array_search($ogre, $arrPerso)]);

    }else {
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 3];

        $name = $_SESSION['hero'][0];
        $level = $_SESSION['hero'][1];
        $hp = $_SESSION['hero'][2];
        $mana = $_SESSION['hero'][3];
        $win = $_SESSION['hero'][4];

        echo "<div class='content'>
            <h2 class='dead'> Vous êtes mort </h2>
            <p class='resume'> $name a sucombé a l'Ogre. Nombre de combat(s) gagné(s): $win </p>  
          <a href='index.php' class='return'>Créer un nouveau personnage</a> 
          </div>
           ";
    }

}

/* COMBAT 5 */

if($_SESSION['hero'][2]>0){

    $dragon = new Dragon($$_POST['name']->getLevel(), 'img/dragon.jpg', "Mirmulnir");

    $arrPerso[] = $dragon;

    while ($dragon->getHp()>=0 && $$_POST['name']->getHp()>=0){
        print_r($$_POST['name']->attack($dragon)) ;
        print_r($dragon->attack($$_POST['name'])) ;
    }

    if($$_POST['name']->getHp()>0){
        $$_POST['name']->levelUp();
        $hpRestants = $$_POST['name']->getHp();
        if($hpRestants<$$_POST['name']->getHpMax() && $$_POST['name']->setHp($hpRestants+($hpRestants*0.5))<$$_POST['name']->getHpMax()){

            $$_POST['name']->setHp($hpRestants+($hpRestants*0.5));

        }
        $manaRestants = $$_POST['name']->getMana();
        if($manaRestants<$$_POST['name']->getManaMax() && $$_POST['name']->setMana($manaRestants+($manaRestants*0.5))<$$_POST['name']->getManaMax()){

            $$_POST['name']->setMana($manaRestants+($manaRestants*0.5));
            if(get_class($$_POST['name']) == "Mage"){
                $$_POST['name']->setMana($manaRestants+($manaRestants-$$_POST['name']->getManaMax()*0.5));
            }

        }
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 5];
        $name = $_SESSION['hero'][0];
        $level = $_SESSION['hero'][1];
        $hp = $_SESSION['hero'][2];
        $mana = $_SESSION['hero'][3];
        $win = $_SESSION['hero'][4];
        echo $$_POST['name']->getName()." se repose et regagne ".$hpRestants*0.5." hp "." et ".$manaRestants*0.5." mana "."<br>"."<br>";
        //unset($arrPerso[array_search($dragon, $arrPerso)]);
        echo "<div class='content'>
            <h2 class='dead'> Vous êtes maintenant digne d'aller au Valhala </h2>
             <p class='resume'> $name a gagné ses 5 combats!. Nombre de combat(s) gagné(s): $win</p> 
          <a href='index.php' class='return'>Créer un nouveau personnage</a> 
          </div>
           ";

    }else {
        $_SESSION['hero'] = [$$_POST['name']->getName(), $$_POST['name']->getLevel(), $$_POST['name']->getHp() , $$_POST['name']->getMana(), 4];
        $name = $_SESSION['hero'][0];
        $level = $_SESSION['hero'][1];
        $hp = $_SESSION['hero'][2];
        $mana = $_SESSION['hero'][3];
        $win = $_SESSION['hero'][4];
        echo "<div class='content'>
            <h2 class='dead'> Vous êtes mort </h2>
             <p class='resume'> $name a sucombé au Dragon. Nombre de combat(s) gagné(s): $win</p> 
          <a href='index.php' class='return'>Créer un nouveau personnage</a> 
          </div>
           ";
    }

}

//print_r($_SESSION['hero']);

?>

<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="./index.js" defer></script>
    <title>Votre personnage</title>
</head>
<body>

<article>
    <div class="container">

    <?php

    foreach ($arrPerso as $perso){


    ?>

        <div class="card">
            <div class="img" style="background-image: url(<?php echo $perso->getImg() ?>); background-size: cover; background-position: center; width: 400px; height: 600px;">
              <div class="top">
                  <h3><?php echo $perso->getName() ;?></h3>
    <p><?php echo $perso->getLevel() ;?></p>
    </div>
    <div class="content">
        <p class="align"><span class="material-icons"> bookmarks </span><?php if($perso->getName()==$$_POST['name']->getName()){ echo $perso->getAbility(); }else {echo "Basic";} ?></p>
        <p><?php echo $perso->getName() ;?> est un <?php echo get_class($perso) ;?> de la famille des <span class="accent">chasseurs de Blancherive</span>. Il a la compétence de <span class="accent">lancer des tongues</span> après chaque repas composé uniquement de poulet. </p>
        <p>C'est une grosse feignasse qui remet tout au lendemain, même les combats. Attendez-vous à ce qu'il vous pose un lapin et vous sorte des disquettes légendaires à chaque fois que vous essayrez de l'appeler.</p>
    </div>
    <div class="attack">
        <p class="align"><span class="material-icons"> favorite </span><?php echo $perso->getHp()."/".$perso->getHpMax() ;?></p>
        <p class="align"><span class="material-icons"> auto_fix_normal </span><?php echo $perso->getMana()."/".$perso->getManaMax() ;?></p>
    </div>
    </div>
    </div>


     <?php
    }

    ?>
    </div>

</article>

</body>
</html>
