<?php
include('connect.php');
$menu='client';
include('menu.php');
$page=isset($_GET['page']) ? $_GET['page']: 'list';

if ($page=='ajouter_cl' && isset($_GET['nom'])&& $_GET['nom']!='' &&
 isset($_GET['ville'])&& $_GET['ville']!=''&& 
 isset($_GET['telephone'])&& $_GET['telephone']!=''&& 
 isset($_GET['email'])&& $_GET['email']!='')
 {
  $nom=$_GET['nom'];
  $ville=$_GET['ville'];
  $email=$_GET['email'];
  $telephone=$_GET['telephone'];
  $sql="INSERT INTO clients (nom,ville,telephone,email)
    VALUES ('$nom','$ville','$telephone','$email')";
  mysqli_query($connexion,$sql);
  header("location:client.php?page=ajouter_cl&status=success");
}
if ($page=='edit_cl'&& isset($_GET['id_ed']) && $_GET['id_ed']!='') {
  $id_ed=$_GET['id_ed'];
  $sql="SELECT * FROM clients WHERE id =$id_ed";
  $res=mysqli_query($connexion,$sql);
  $data=mysqli_fetch_array($res);
  $nom=$data['nom'];
  $ville=$data['ville'];
  $email=$data['email'];
  $telephone=$data['telephone'];
}
if ($page=='edit_cl'&&
  isset($_GET['nom_new']) && $_GET['nom_new']!=''&&
  isset($_GET['telephone_new']) && $_GET['telephone_new']!=''&&
  isset($_GET['email_new']) && $_GET['email_new']!=''&&
  isset($_GET['ville_new']) && $_GET['ville_new']!='') {
  $id_ed=$_GET['id_ed'];
  $nom_new=$_GET['nom_new'];
  $ville_new=$_GET['ville_new'];
  $telephone_new=$_GET['telephone_new'];
  $email_new=$_GET['email_new'];
  $sql="UPDATE clients SET nom='$nom_new' ,ville='$ville_new',telephone='$telephone_new',email='$email_new' WHERE id ='$id_ed'";
  mysqli_query($connexion,$sql);
  header("location:client.php?page=list");
}
if (isset($_GET['id_del']) && $_GET['id_del']!='') {
  $id_del=$_GET['id_del'];
  $sql="DELETE FROM clients WHERE id='$id_del'";
  mysqli_query($connexion,$sql);
  header("location:client.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<main>
<div class="content">
  <?php if ($page=='list') {?>
  <!-- CLIENTS -->
    <section class="section">
      <div class="section-header">
        <div class="section-title"><span class="dot dot-c"></span> Clients</div>
        <a href="client.php?page=ajouter_cl" class="btn-add btn-add-c">＋ Ajouter Client</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>ID</th><th>Nom</th><th>Ville</th><th>Email</th><th>Telephone</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php 
            $res=mysqli_query($connexion,"SELECT * FROM clients");
            while ($data=mysqli_fetch_array($res)){ ?>
              <tr>
                <td><?= $data['id']; ?></td>
                <td><?= $data['nom']; ?></td>
                <td><?= $data['ville']; ?></td>
                <td><?= $data['email']; ?></td>
                <td><?= $data['telephone']; ?></td>
                <td>
                <a href="client.php?page=edit_cl&id_ed=<?= $data['id'] ?>" class="btn-mod">Edit</a>
                <a href="client.php?id_del=<?= $data['id']; ?>" class="btn-del">Supprimer</a>
                <a href="commande.php?id=<?= $data['id']; ?>" class="btn-mod">Commande</a></td>
              </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  <hr class="divider"/>
  <?php } elseif ($page=='ajouter_cl') { ?>
  <section class="section">
      <div class="section-header">
          <div class="section-title"><span class="dot dot-c"></span> Nouveau Client</div>
      </div>
      <div class="form-card" style="max-width: 500px;">
          <form action="client.php" method="get">
              <input type="hidden" name="page" value="ajouter_cl">
              <label>Nom</label><input type="text" name="nom" required>
              <label>Ville</label><input type="text" name="ville" required>
              <label>Email</label><input type="text" name="email" required autocomplete="email">
              <label>Telephone</label><input type="number" name="telephone" required>
              <button type="submit" class="btn-add btn-add-c">Enregistrer</button>
              <a href="client.php" class="btn-add btn-add-c">Annuler</a>
          </form>
        </div>
    </section> 
      <hr class="divider"/>
     <?php } elseif ($page=='edit_cl') { ?>
  <section class="section">
      <div class="section-header">
          <div class="section-title"><span class="dot dot-c"></span> Nouveau Client</div>
      </div>
      <div class="form-card" style="max-width: 500px;">
          <form action="client.php" method="get">
              <input type="hidden" name="id_ed" value="<?= $id_ed ?>">
              <input type="hidden" name="page" value="edit_cl">
              <label>Nom</label><input type="text" name="nom_new" value="<?= $nom ?>" required>
              <label>Ville</label><input type="text" name="ville_new" value="<?= $ville ?>" required>
              <label>Email</label><input type="text" name="email_new" value="<?= $email ?>" required autocomplete="email">
              <label>Telephone</label><input type="text" name="telephone_new" value="<?= $telephone ?>" required>
              <button type="submit" class="btn-add btn-add-c">Enregistrer</button>
              <a href="client.php" class="btn-add btn-add-c">Annuler</a>
          </form>
        </div>
    </section>
      <?php }  ?>
</div>
</main>
</body>
</html>
