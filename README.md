# 🛒 Market Admin Panel

Panel d'administration pour gérer les clients, produits et commandes — construit en **PHP + MySQL + HTML/CSS**.

---

## 📁 Structure des fichiers

| Fichier | Rôle |
|---|---|
| `menu.php` | Page d'accueil — dashboard avec stats |
| `client.php` | Gestion des clients |
| `produit.php` | Gestion des produits |
| `commande.php` | Gestion des commandes par client |
| `commande_detail.php` | Détails des produits dans une commande |
| `connect.php` | Connexion à la base de données |
| `setting.php` | Configuration du menu actif |
| `design.css` | Style global (dark theme) |

---

## 🗄️ Base de données — `market`

### `clients`
| Colonne | Type |
|---|---|
| id | INT AUTO_INCREMENT |
| nom | VARCHAR |
| ville | VARCHAR |
| email | VARCHAR |
| telephone | VARCHAR |

### `produits`
| Colonne | Type |
|---|---|
| id | INT AUTO_INCREMENT |
| nom | VARCHAR |
| prix | DECIMAL |

### `commandes`
| Colonne | Type |
|---|---|
| id | INT AUTO_INCREMENT |
| client_id | INT (FK → clients) |
| total | DECIMAL |
| statut | VARCHAR |
| date_commande | DATE |

### `commandes_details`
| Colonne | Type |
|---|---|
| id | INT AUTO_INCREMENT |
| commande_id | INT (FK → commandes) |
| produit_id | INT (FK → produits) |
| prix_unitaire | DECIMAL |
| quantite | INT |

---

## 🔗 Relations

```
clients ──< commandes ──< commandes_details >── produits
```

---

## ⚙️ Installation

1. Importer la base de données dans **phpMyAdmin**
2. Configurer `connect.php` avec tes infos :
```php
$server_db = "localhost";
$user_db   = "root";
$pass_db   = "";
$name_db   = "market";
```
3. Lancer avec **XAMPP** ou **WAMP**
4. Ouvrir `menu.php` dans le navigateur

---

## 🚀 Fonctionnalités

### 👤 Clients
- Afficher la liste des clients
- Ajouter un client (nom, ville, email, téléphone)
- Modifier un client
- Supprimer un client
- Accéder aux commandes d'un client via bouton **＋ Commande**

### 📦 Produits
- Afficher la liste des produits
- Ajouter / Modifier / Supprimer un produit

### 🧾 Commandes
- Afficher les commandes d'un client
- Ajouter une commande (total, statut, date)
- Modifier / Supprimer une commande
- Après ajout → redirection automatique vers les détails

### 📋 Détails Commande
- Ajouter des produits à une commande (produit, prix unitaire, quantité)
- Afficher les produits ajoutés
- Supprimer un produit de la commande

---

## 🎨 Design

- Dark theme custom (pas de Bootstrap)
- Font : **Syne** + **DM Sans**
- Couleurs : bleu `#5b6af0` / rose `#e05a7a` / vert `#38c98e`
