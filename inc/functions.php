<?php
require_once("./inc/pdo.php");
// function requetes MySQl
function selectAllVinyles($order)
{
    global $pdo;
    //$order servira a laisser le choix du classement pour mes users
    $rq = " SELECT * from vinyles order by $order";
    $query = $pdo->prepare($rq);
    // $query->bindValue(':order', $order, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}
function selectVinylesForPaginator($order, $index, $limite)
{
    global $pdo;
    //$order servira a laisser le choix du classement pour mes users
    $rq = " SELECT * from vinyles order by $order limit $index,$limite";
    $query = $pdo->prepare($rq);
    // $query->bindValue(':order', $order, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    $rq2 = " SELECT * from vinyles order by $order ";
    $query2 = $pdo->prepare($rq2);
    // $query->bindValue(':order', $order, PDO::PARAM_STR);
    $query2->execute();
    $nbPage = ceil(count($query2->fetchAll()) / 4);
    // var_dump(ceil($nbPage));

    return [$result, $nbPage];
}

function selectVinyleById($id)
{
    global $pdo;
    // var_dump($id);
    $rq = "SELECT * from vinyles where id =:id";
    $query = $pdo->prepare($rq);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    return $result;
}

function insertUser($tbUSer)
{
    global $pdo;
    $rq = "INSERT INTO user(nom,prenom, login, pwd, role, email, addr1, addr2, cp, ville, tel )
            VALUES (:nom,:prenom, :login, :pwd, 'role_user', :email, :addr1, :addr2, :cp, :ville, :tel)";
    $query = $pdo->prepare($rq);
    $query->bindValue(':nom', $tbUSer['nom'], PDO::PARAM_STR);
    $query->bindValue(':prenom', $tbUSer['prenom'], PDO::PARAM_STR);
    $query->bindValue(':login', $tbUSer['login'], PDO::PARAM_STR);
    $query->bindValue(':pwd', $tbUSer['pwd'], PDO::PARAM_STR);
    $query->bindValue(':email', $tbUSer['email'], PDO::PARAM_STR);
    $query->bindValue(':addr1', $tbUSer['addr1'], PDO::PARAM_INT);
    $query->bindValue(':addr2', $tbUSer['addr2'], PDO::PARAM_STR);
    $query->bindValue(':cp', $tbUSer['cp'], PDO::PARAM_INT);
    $query->bindValue(':ville', $tbUSer['ville'], PDO::PARAM_STR);
    $query->bindValue(':tel', $tbUSer['tel'], PDO::PARAM_INT);
    $query->execute();
}

function selectUserBy($field, $value, $type)
{
    global $pdo;
    // var_dump($id);
    $rq = "SELECT * from user where " . $field . "=:" . $field;
    $query = $pdo->prepare($rq);
    $query->bindValue(':' . $field, $value, $type);
    $query->execute();
    $result = $query->fetch();
    return $result;
}
function selectUserForLogin($login, $pwd)
{
    global $pdo;
    //var_dump($login, $pwd);
    $rq = "SELECT login, nom, prenom,pwd,role from user where login=:login ";
    $query = $pdo->prepare($rq);
    $query->bindValue(':login', $login, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch();
    if ($result) {
        if (password_verify($pwd, $result['pwd'])) {
            //var_dump($result);
            return $result;
        } else {
            $result = [];
            echo "mot de passe incorrect";
        }
    } else {
        $result = [];
        echo 'login incorrect';
    }
}
// functions courantes 
function protectUrl($role)
{
    //admin
    switch ($role) {
        case 'role_admin':
            if (!empty($_SESSION['role'])) {
                if ($_SESSION['role'] !== $role) {
                    header("Location:index.php");
                    die();
                }
            } else {
                header("Location:index.php");
                die();
            }
            break;
        case 'role_user':
            if (empty($_SESSION['role'])) {
                header("Location:index.php");
                die();
            }
            break;

        default:
            # code...
            break;
    }
}

function verifInput($input, $txtErreur)
{   // pour poiuvoir utiliser mon tableau d'erreur a l'interieur de ma fonction
    // je le déclare en global 
    global $erreur;
    // strlen me permet de verifier que ma chaine $input (string)
    //contient bien au moins 1 caractere
    if (strlen($_POST[$input]) > 0) {
        //trim() supprime tous les caracteres invisible 
        return  trim(strip_tags($_POST[$input]));
    } else {
        //j'ajoute une nouvelle erreur a mon tableau en cas de champs vide 
        $erreur[$input] = $txtErreur;
        //array_push($erreur,$input $txtErreur);
    }
}


function verifNum($input, $nb, $txtErreur)
{   // pour poiuvoir utiliser mon tableau d'erreur a l'interieur de ma fonction
    // je le déclare en global 
    global $erreur;
    //mon patern ne comprendra que des chiffres de 0 a 9 et $nb caractere;
    $patern = "@[0-9]{" . $nb . "}@";
    // var_dump($_POST[$input]);
    if (preg_match($patern, $_POST[$input])) {
        //je m'assure que la valeur renvoyé sera un int pour ma requetes sql avec intVal
        return intval($_POST[$input]); // ici 0235000000 devient 235000000 supprimer le premier zero
    } else {
        $erreur[$input] = $txtErreur;
    }
}
