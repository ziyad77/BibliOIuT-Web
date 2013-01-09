<?php
/*CREATE TABLE Etudiant (
	idEtudiant integer AUTO_INCREMENT,
	numeroEtudiant integer NOT NULL,
	nomEtudiant varchar(255) NOT NULL,
	prenomEtudiant varchar(255) NOT NULL,
	dateNaissanceEtudiant date NOT NULL,
	photoProfilEtudiant blob,
	
	PRIMARY KEY (idEtudiant)
);*/
class Etudiant 
{
	public $_id;
	public $_num;
	public $_nom;
    public $_prenom;
    public $_date_naissance;
    public $_num_photo;

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
            $this->_num = $array[0][1];
            $this->_nom = $array[0][2];
            $this->_prenom = $array[0][3];
            $this->_date_naissance = $array[0][4];
            $this->_num_photo = $array[0][5];
            
        }

	/*Accesseur*/
}

?>