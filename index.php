<?php

include_once ('./heros/Heros.php');
include_once ('./heros/Mage.php');
include_once ('./heros/Warrior.php');
include_once ('./heros/Rogue.php');



/*while ($goblin->getHp()>=0 && $merlin->getHp()>=0){
   print_r($merlin->attack($goblin)) ;
   print_r($goblin->attack($merlin)) ;
};*/



/*$error = $_GET['error'];

if($error == "pasDeClasse"){
    echo "<p>Selectionner une classe</p>";
}

if($error == "pasDeNom"){
    echo "<p>Veuillez entrer votre nom</p>";
}

if($error == "pasDeNiveau"){
    echo "<p>Veuillez entrer votre niveau</p>";
}*/

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="./index.js" defer></script>
    <title>Cards Arena</title>
</head>
<body>

<h1 class="stats">Cards Arena</span></h1>

<form action="./form.php" method="post" enctype="multipart/form-data">

    <select name="class" id="class" required>
        <option value="">-- Select your class --</option>
        <option value="Mage">Mage</option>
        <option value="Warrior">Warrior</option>
        <option value="Rogue">Rogue</option>
    </select>

    <label for="name"></label>
    <input type="text" name="name" id="name" placeholder="Enter your name" required>

    <label for="fileTest" id="labelFileTest">Enter your character</label>
    <input type="file" name="fileTest" id="fileTest">

    <input type="submit" id="submit">
</form>

<!-- <article>
    <div class="container">
        <div class="card" id="merlin">
            <div class="title">
            <h2><?php echo$merlin->getName()?></h2>
                    
            <div class="circle">
            <p><?php echo$merlin->getLevel()?></p>
            </div>
                    
            </div>
            
                <div class="img-merlin">
                    
                </div>
                <div class="title">
                <p>Merlin, Enchanteur de Bretagne, Grand vainqueur de la belette de Winchester.</p>
                </div>
                <div class="content">
                    <h4 class="stats"><span class="material-icons"> favorite </span> <?php echo $merlin->getHp()."/" . $merlin->getHpMax()?></h4>
                    <h4 class="stats"><span class="material-icons"> auto_fix_high </span> <?php echo $merlin->getMana()."/" . $merlin->getManaMax()?></h4>
                    <h4>Stats:</h4>
                    <p class="stats"> <span class="material-icons">colorize</span> <?php echo$merlin->getStrength()?></p>
                    <p class="stats"><span class="material-icons">accessibility</span> <?php echo$merlin->getAgility()?></p>
                    <p class="stats"><span class="material-icons">flare</span> <?php echo$merlin->getIntelligence()?></p>
                    <p class="stats"><span class="material-icons">shield</span> <?php echo$merlin->getDefence()?></p>
                </div>
        </div>

</article> -->

</body>
</html>


