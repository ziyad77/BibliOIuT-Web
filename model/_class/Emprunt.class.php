<?php

class Emprunt 
{
	public $_idEmprunt;
	public $_dateDebutEmprunt;
	public $_dateFinEmprunt;

	/*Constructeur*/
    public
        function __construct ($dbh,$idEmprunt)
        {
	        include(getcwd().'/model/BDD/query_construct_class.inc.php');
	        include_once(getcwd().'/config/connectionsToDatabase.php');
	        
            /* Recherche du profil */
            $answer=$dbh->prepare($query_get_Emprunt);
            $answer->bindValue('idEmprunt',$idEmprunt,PDO::PARAM_INT); 
            $answer->execute();

            /* Recuperation dans un tableau et Edition de l'objet*/
			while ($donnees = $answer->fetch())
			{
				$this->_idEmprunt = $donnees['idEmprunt'];
				$this->_dateDebutEmprunt = $donnees['dateDebutEmprunt'];
				$this->_dateFinEmprunt = $donnees['dateFinEmprunt'];
			}
    
        }

	/*Accesseur*/
		
}


?>