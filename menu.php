<?php
include('connect.php');
$style_cl='';
$style_pr='';
$style_cmd='';
$class='';
if ($menu=='client') {
    $style_cl='color: red;';
    $class='o';
}else if ($menu=='produit') {
    $style_pr='color: red;';
    $class='o';
}else if ($menu=='commande') {
    $style_cmd='color: red;';
    $class='o';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AdminPanel</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link href="design.css" rel="stylesheet"/>
</head>
<body>

<header>
  <div class="logo"><a href="menu.php" id="st">Admin<span>Panel</span></a></div>
  <div class="badge">MySQL Connected</div>
</header>
<nav>
  <a href="produit.php" style="<?= $style_pr ?>  "class='<?= $class ?>'>📦 Produits</a>
  <a href="client.php" style="<?= $style_cl ?>   "class='<?= $class ?>'>👤 Clients</a>
  <a href="commande.php" style="<?= $style_cmd ?>"class='<?= $class ?>'>🧾 Commandes</a>
</nav>
<main>
  
</main>
</body>
</html>