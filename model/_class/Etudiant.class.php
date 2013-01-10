<?php

class Etudiant 
{
	public $_idEtudiant;
	public $_diplomeEtudiant;
	public $_anneeEtudiant;
	public $_dateNaissanceEtudiant;
	public $_photoProfilEtudiant;

    public
        function __construct ($bdd,$idEtudiant)
        {
	        include(getcwd().'/model/BDD/query_construct_class.inc.php');
	        include_once(getcwd().'/config/connectionsToDatabase.php');
            
            /* Recherche du profil */
            $answer = $bdd->prepare($query_get_Etudiant);
			$answer->bindValue('idEtudiant',$idEtudiant,PDO::PARAM_INT);
			$answer->execute();
			
			/* Recuperation dans un tableau et Edition de l'objet*/
			while ($donnees = $answer->fetch())
			{
				$this->_idEtudiant = $donnees['idEtudiant'];
				$this->_diplomeEtudiant = $donnees['diplomeEtudiant'];
				$this->_anneeEtudiant = $donnees['anneeEtudiant'];
				$this->_dateNaissanceEtudiant = $donnees['dateNaissanceEtudiant'];
				//$this->_photoProfilEtudiant = $donnees['photoProfilEtudiant'];
			}
		}


	/*Accesseur*/
}

?>