<?php
/*CREATE TABLE Personnel (
	idPersonnel integer AUTO_INCREMENT,
	nssPersonnel varchar(255) NOT NULL,
	nomPersonnel varchar(255) NOT NULL,
	prenomPersonnel varchar(255) NOT NULL,

	PRIMARY KEY (idPersonnel)
);*/
class personnel 
{
	public $_id;
	public $_nss;
	public $_nom;
    public $_prenom;

    public
        function __construct ($dbh,$membre)
        {
	        require(getcwd().'/include/requetes_sql.inc.php');
            require_once(getcwd().'/include/gestion_pdo.inc.php');

            /* Recherche du profil */
            $stmt=$dbh->prepare($requete_sql_select_membre);

            $stmt->bindValue('iduser',$user->_id,PDO::PARAM_INT); 

            $stmt->execute();

            /* Recuperation dans un tableau */
            $array = $stmt->fetchAll();
            echo "<pre>\n</pre>";

            /* Edition de l'objet */
            $this->_id = $array[0][0];
            $this->_nss = $array[0][1];
            $this->_nom = $array[0][2];
            $this->_prenom = $array[0][3];
    
        }

	/*Accesseur*/
		
}

?>