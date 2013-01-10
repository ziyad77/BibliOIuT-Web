<?php

class Reservation 
{
	public $_idMembre;
	public $_idLivre;
	public $_dateReservation;

	/*Constructeur*/
    public
        function __construct ($dbh,$idMembre,$idLivre)
        {
	        include(getcwd().'/model/BDD/query_construct_class.inc.php');
	        include_once(getcwd().'/config/connectionsToDatabase.php');
	        
            /* Recherche du profil */
            $answer=$dbh->prepare($query_get_Reservation);
            $answer->bindValue('idMembre',$idMembre,PDO::PARAM_INT);
            $answer->bindValue('idLivre',$idLivre,PDO::PARAM_INT);
            $answer->execute();

            /* Recuperation dans un tableau et Edition de l'objet*/
			$donnees = $answer->fetch();
			if (!empty($donnees))
			{
				$this->_idLivre = $idLivre;
				$this->_idMembre = $idMembre;
				$this->_dateReservation = $donnees['dateReservation'];
			}
			else
			{
				echo 'Error query';
			}
    
        }

	/*Accesseur*/
		
}


?>