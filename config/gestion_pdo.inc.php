<?php
/****************************************************
 * Ce Fichier contient des fonctions nécessaire à   *
 * l'interaction avec une base de données par PDO.  * 
 ****************************************************/

/* Permet d'initialiser une connexion avec une base de données 
 * Prend en argument la description de la bdd (hote,nom,port,...)
 * et renvoie  */
function
ouvrir_connexion_bdd ($dsn,$user,$pass)
{
    try
    {
        $dbh = new PDO($dsn,$user,$pass);
    } 
    catch (PDOException $error)
    {
        print "Erreur de connexion à la bdd : ".$error->getMessage(). "<br/>\n";
        die ();
    }	

    return $dbh;	
}

/* Permet de fermer proprement la connexion avec la bdd 
 * Prend en argument le descripteur d'une base de donnée */
function
clore_connexion_bdd ($dbh)
{
    if ($dbh) 
    {
        $dbh = NULL;
    }
}

/* Permet de consulter la BDD en formant une requete SQL.
 * La méthode query de l'objet PDO envoie la requete à
 * la BDD, le résultat est stocké dans sth qui sera enregistrer
 * dans result sous forme d'un tableau associatif via la méhode 
 * fetchall(pdo::fetch_assoc) */

function
requete_consultation_bdd ($dbh,$sql)
{
    $sth = $dbh->query($sql);	
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/* Permet d'envoyer une requete de modification à la BDD.
 * Prend en argument le descripteur de la bdd et utilise la
 * méthode exec avec la $sql. */
function
requete_ecriture_bdd ($dbh,$sql)
{
    $result=$dbh->exec($sql);

    if ($result === FALSE)
    {
        die ("Erreur dans la requete :$sql.\n");
    }
    else
        if ($result === 0)
        {
            echo ("La requete $sql n'a rien modifiée...\n");
        }
        else
        {
            echo ("$result lignes modifiées.\n");
        }
}

/* Fonction de préparation à l'execution d'une requete SQL. 
 * renvoie l'objet créer par PDO décrivant la requete.
 * Les champs à modifier avant interprétation sont notés 
 * ':foo' */
function
preparation_objet_requete_sql ($dbh,$sql)
{
    $sth = $dbh->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    return $sth;
}
?>
