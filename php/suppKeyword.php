<?
session_start();
if (isset($_GET['motscles_id'])&& $_GET['motscles_id'] == "all"){
    $_SESSION['question'] = [];
    $_SESSION['mots_cles'] = 0;
}

else if (isset($_GET['motscles_id']) && intval($_GET['motscles_id']) >= 0) {

    if ($_SESSION['question'][$_GET['motscles_id']]["qte"] == 1){
        $_SESSION['panier']--;
        array_splice($_SESSION['panier'], $_GET['id'], 1);
    }else{
        $_SESSION['panier'][$_GET['id']]["qte"] --;
    }
    $_SESSION['nbArticle']--;
}
header('location: ./dashboard/mots_cles.php');
?>



$bdd = new PDO('mysql:host=localhost;dbname=rhtab;charset=utf8', 'root', '');
 
  $sql='DELETE FROM typeabsencetab WHERE id = ?';
  $req = $bdd ->prepare($sql);
  $r = $req->execute([$id]);