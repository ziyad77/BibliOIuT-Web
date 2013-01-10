<?php

class Membre
{
	public $_idMembre;
	public $_nomMembre;
	public $_prenomMembre;
	public $_loginMembre;
	public $_mdpMembre;
	/*Etudiant = 0, Personnel = 1, Calculé en fonction de l'attribut fk_idEtudiant == ou != NULL*/
    public $_droit;
    public $etudiant;

    /*Constructeur*/
    public
        function __construct ($dbh,$login,$mdp)
        {
	        $this->_loginMembre = $login;
            $this->_mdpMembre = $mdp;

            /* On chiffre le mot de passe */
            //$this->_mdpMembre = md5($mdp);

            return $this->connexion($dbh);
        }

	/* return :
	 * 0 = Connexion effectué
	 * -1 = Echec de connexion (couple login mot de passe ne correspond pas)
	 */
	public  
        function connexion ($dbh)
        {
	        include(getcwd().'/model/BDD/query_construct_class.inc.php');
	        include_once(getcwd().'/config/connectionsToDatabase.php');
            
    		/* Verification des login */
        	$answer=$dbh->prepare($query_login_Membre);
            
            $answer->bindValue(':loginMembre',$this->_loginMembre,PDO::PARAM_STR);
            $answer->bindValue(':mdpMembre',$this->_mdpMembre,PDO::PARAM_STR);

            $answer->execute();
            
            /* Recuperation dans un tableau */
            $donnees = $answer->fetch();

            if (!empty($donnees))
            {
	            $this->_idMembre = $donnees['idMembre'];
	            $this->_nomMembre = $donnees['nomMembre'];
	            $this->_prenomMembre = $donnees['prenomMembre'];
	            
	            if ($donnees['fk_idEtudiant'])
	            {
		            $this->_droit = 0;
		            $this->etudiant = new Etudiant($dbh,$donnees['fk_idEtudiant']);
		        }
		        else
		        	$this->_droit = 1;
		        
		        return 0;
            }
            else
            {
	            return -1;
            }
        }
}

?>