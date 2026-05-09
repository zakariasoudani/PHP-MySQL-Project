<?php
include('connect.php');
$menu = 'produit';
include('menu.php');

if (isset($_GET['id_delete'])) {
  $id=$_GET['id_delete'];
  mysqli_query($connexion, "DELETE FROM produits WHERE id = $id");
  header("location:produit.php");
}
if (isset($_GET['nom']) && $_GET['nom']!=''&&
  isset($_GET['prix']) && $_GET['prix']!=''&&
  isset($_GET['categorie']) && $_GET['categorie']!=''&&
  isset($_GET['stock']) && $_GET['stock']!='') {
    $nom=$_GET['nom'];
    $prix=$_GET['prix'];
    $categorie=$_GET['categorie'];
    $stock=$_GET['stock'];
    $sql="INSERT INTO produits (nom, prix, categorie, stock) VALUES ('$nom', '$prix', '$categorie', '$stock')";
    mysqli_query($connexion, $sql);
    header("location:produit.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion Produits</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<main>
    <div class="dashboard-grid">
        
<section class="section">
<div class="section-header">
          <div class="section-title"><span class="dot dot-p"></span> Nouveau Produit</div>
      </div>
      <div class="form-card">
          <form action="produit.php" method="GET">
              <label>Nom de Produit</label>
              <input type="text" name="nom" required>
              
              <label>Prix</label>
              <input type="number" name="prix" required>
              
              <label>Catégorie</label>
              <input type="text" name="categorie" required>
              
              <label>Stock</label>
              <input type="number" name="stock" value="1" required>
              
              <br><br>
              <button type="submit" name="save_pr" class="btn-add btn-add-p" style="width:100%; justify-content:center;">
                  ＋ Enregistrer Produit
              </button>
          </form>
      </div>
  </section>
  <section class="section">
      <div class="section-header">
          <div class="section-title"><span class="dot dot-p"></span> Inventaire</div>
      </div>
      <div class="table-wrap">
          <table>
              <thead>
    <tr><th>ID</th><th>Nom</th><th>Prix</th><th>Categorie</th><th>Stock</th><th>Actions</th></tr>
  </thead>
<tbody>
             <?php 
          $res=mysqli_query($connexion,"SELECT * FROM produits");
          while ($data=mysqli_fetch_array($res)) { ?>
          <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['nom'] ?></td>
            <td><?= $data['prix'] ?></td>
            <td><?= $data['categorie'] ?></td>
            <td><?= $data['stock'] ?></td>
            <td><a href="produit.php?id_delete=<?= $data['id'] ?>"class="btn-mod">Supprimer</a></td>
          </tr>
          <?php } ?>
</tbody>
          </table>
      </div>
</section>
 </div>
</main>
</body>
</html>