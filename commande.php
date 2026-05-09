<?php
include('connect.php');

$page=isset($_GET['page']) ? $_GET['page']: 'list';
$id=isset($_GET['id']) ? $_GET['id']: '';

if (isset($_GET['id']) && $_GET['id']!='') {
  $client_id=$_GET['id'];
} else {
  header("location:client.php");
}

if ($page=='ajouter_cm'&&
isset($_GET['id']) && $_GET['id']!=''&&
isset($_GET['date_commande']) && $_GET['date_commande']!=''&&
isset($_GET['total']) && $_GET['total']!=''&&
isset($_GET['statut']) && $_GET['statut']!='') {
    $id=$_GET['id'];
    $statut=$_GET['statut'];
    $date_commande=$_GET['date_commande'];
    $total=$_GET['total'];
    $sql="INSERT INTO commandes (client_id,total,statut,date_commande) VALUES ($id,$total,'$statut','$date_commande')";
    mysqli_query($connexion,$sql);
    $id_new = mysqli_insert_id($connexion);
    header("location:commande_detail.php?client_id=$client_id&commande_id=$id_new");
    exit();
}
if (isset($_GET['id_del'])&& $_GET['id_del']) {
  $id_del=$_GET['id_del'];
  $sql="DELETE FROM commandes WHERE id ='$id_del'";
  mysqli_query($connexion,$sql);
  header("location:commande.php?id=$client_id");
  exit();
}
if ($page=='edit_cm'&& isset($_GET['id_cmd']) && $_GET['id_cmd']!='') {
  $id_cmd=$_GET['id_cmd'];
  $sql="SELECT * FROM commandes WHERE id ='$id_cmd'";
  $res=mysqli_query($connexion,$sql);
  $data=mysqli_fetch_array($res);
  $total=$data['total'];
  $date_commande=$data['date_commande'];
  $statut=$data['statut'];
}
if ($page=='edit_cm' && isset($_GET['total_new'])) {
  $id_cmd=$_GET['id_cmd'];
  $id_cl=$_GET['id'];
  $total_new=$_GET['total_new'];
  $date_commande_new=$_GET['date_commande_new'];
  $statut_new=$_GET['statut_new'];
  
  $sql="UPDATE commandes SET total='$total_new' ,date_commande='$date_commande_new',statut='$statut_new' WHERE id ='$id_cmd'";
  mysqli_query($connexion,$sql);
  header("location:commande.php?id=$id_cl");
  exit();
}
$menu = 'commande'; 
include('menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<main>
<div class="content">
  <?php if ($page=='list') {?>
    <section class="section">
      <div class="section-header">
        <div class="section-title"><span class="dot dot-c"></span> Commandes</div>
        <a href="commande.php?page=ajouter_cm&id=<?= $id ?>" class="btn-add btn-add-c">＋ Ajouter commande</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>ID</th><th>Total</th><th>Statut</th><th>Date</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php 
            $res=mysqli_query($connexion,"SELECT * FROM commandes WHERE client_id='$id'");
            while ($data=mysqli_fetch_array($res)){ ?>
              <tr>
                <td><?= $data['id']; ?></td>
                <td><?= $data['total']; ?></td>
                <td><?= $data['statut']; ?></td>
                <td><?= date('d-m-Y', strtotime($data['date_commande'])) ?></td>
                <td class="actions">
                    <a href="commande.php?page=edit_cm&id_cmd=<?= $data['id']; ?>&id=<?= $id ?>" class="btn-mod">Edit</a>
                    <a href="commande.php?id_del=<?= $data['id']; ?>&id=<?= $id ?>" class="btn-del" onclick="return confirm('Supprimer?')">Supprimer</a>
                </td>
              </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </section>

  <?php } elseif ($page=='ajouter_cm') { ?>
    <section class="section">
      <div class="form-card" style="max-width: 500px;">
          <form action="commande.php" method="get">
              <input type="hidden" name="id" value="<?= $id ?>">
              <input type="hidden" name="page" value="ajouter_cm">
              <label>Total</label><input type="number" name="total" required>
              <label>Status</label>
              <select name="statut">
                <option value="En cours">En cours</option>
                <option value="Livré">Livré</option>
              </select>
              <label>Date</label><input type="date" name="date_commande" required><br><br>
              <button type="submit" class="btn-add btn-add-c">Enregistrer</button>
              <a href="commande.php" class="btn-add btn-add-c">Annuler</a>
          </form>
      </div>
    </section>

  <?php } elseif ($page=='edit_cm') { ?>
    <section class="section">
      <div class="form-card" style="max-width: 500px;">
          <form action="commande.php" method="get">
              <input type="hidden" name="id" value="<?= $client_id ?>">
              <input type="hidden" name="id_cmd" value="<?= $id_cmd ?>">
              <input type="hidden" name="page" value="edit_cm">
              
              <label>Total</label>
              <input type="number" name="total_new" value="<?= $total ?>" required>
              
              <label>Status</label>
              <select name="statut_new">
                <option value="<?= $statut ?>"><?= $statut ?></option>
                <option value="En cours">En cours</option>
                <option value="Livré">Livré</option>
              </select><br><br>
              
              <label>Date</label>
              <input type="date" name="date_commande_new" value="<?= $date_commande ?>" required><br><br>
              
              <button type="submit" class="btn-add btn-add-c">Sauvegarder</button>
              <a href="commande.php?id=<?= $id ?>" class="btn-add">Annuler</a>
          </form>
      </div>
    </section>
  <?php } ?>
</div>
</main>
</body>
</html>