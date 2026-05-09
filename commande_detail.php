<?php 
include("connect.php");

$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : '';
$commande_id = isset($_GET['commande_id']) ? $_GET['commande_id'] : '';

if (isset($_GET['id_del']) && $_GET['id_del'] != '') {
    $id_del = $_GET['id_del'];
    $id = $_GET['id'];
    mysqli_query($connexion, "DELETE FROM commandes WHERE id='$id_del'");
    header("location:commande.php?id=$id");
    exit();
}

if (isset($_GET['prix_unitaire']) && $_GET['prix_unitaire'] != '' &&
    isset($_GET['produit_id']) && $_GET['produit_id'] != '' &&
    isset($_GET['quantite']) && $_GET['quantite'] != '' &&
    isset($_GET['commande_id']) && $_GET['commande_id'] != '') {
    $p_id = $_GET['produit_id'];
    $c_id = $_GET['commande_id'];
    $prix = $_GET['prix_unitaire'];
    $qte  = $_GET['quantite'];
    $cl_id = $_GET['client_id'];

    $sql = "INSERT INTO commandes_details (produit_id, commande_id, prix_unitaire, quantite) VALUES ('$p_id', '$c_id', '$prix', '$qte')";
    mysqli_query($connexion, $sql);
    header("location:commande_detail.php?client_id=$cl_id&commande_id=$c_id");
    exit();
}
include('menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Détails Commande</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<main>
    <div class="dashboard-grid">
        <section class="section">
            <div class="section-header">
                <div class="section-title"><span class="dot dot-p"></span> Nouveau Detail</div>
            </div>
            <div class="form-card">
                <form action="commande_detail.php" method="GET">
                    <input type="hidden" name="client_id" value="<?= $client_id ?>">
                    <input type="hidden" name="commande_id" value="<?= $commande_id ?>">

                    <label>Choisir le Produit</label>
                    <select name="produit_id" required>
                        <?php 
                        $prods = mysqli_query($connexion, "SELECT * FROM produits");
                        while($p = mysqli_fetch_array($prods)) {
                            echo "<option value='".$p['id']."'>".$p['nom']."</option>";
                        }
                        ?>
                    </select>

                    <label>Prix Unitaire</label>
                    <input type="number" name="prix_unitaire" required>
                    
                    <label>Quantite</label>
                    <input type="number" name="quantite" required>
                    
                    <br><br>
                    <button type="submit" class="btn-add btn-add-p">＋ Enregistrer</button><br><br>
                    <a href="commande.php?id=<?= $client_id ?>" class="btn-add" style="background:#444; color:#fff; text-decoration:none; text-align:center;">Annuler / Retour</a>                
                </form>
            </div>
        </section>

        <section class="section">
            <div class="section-header"><div class="section-title">Produits ajoutés</div></div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th>Prix</th><th>Qte</th><th>Produit</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($commande_id != '') {
                            $res = mysqli_query($connexion, "SELECT * FROM commandes_details WHERE commande_id='$commande_id'");
                            while ($data = mysqli_fetch_array($res)) { 
                                $p_id = $data['produit_id'];
                                $resu = mysqli_query($connexion, "SELECT * FROM produits WHERE id='$p_id'");
                                $data_p = mysqli_fetch_assoc($resu);
                                ?>
                                <tr>
                                    <td><?= $data['prix_unitaire'] ?></td>
                                    <td><?= $data['quantite'] ?></td>
                                    <td><?= $data_p['nom'] ?></td>
                                    <td><a href="commande_detail.php?id_delete=<?= $data['id'] ?>&client_id=<?= $client_id ?>&commande_id=<?= $commande_id ?>" class="btn-mod">Supprimer</a></td>
                                </tr>
                                <?php 
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
</body>
</html>