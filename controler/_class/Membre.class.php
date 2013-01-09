<?php
/*CREATE TABLE Membre (
	idMembre integer AUTO_INCREMENT,
	loginMembre varchar(255) NOT NULL,
	mdpMembre varchar(255) NOT NULL,
	emailMembre varchar(255) NOT NULL,
	fk_idEtudiant integer,
	fk_idPersonnel integer,
	PRIMARY KEY (idMembre),
	FOREIGN KEY (fk_idEtudiant) references Etudiant(idEtudiant),
	FOREIGN KEY (fk_idPersonnel) references Personnel(idPersonnel)
);*/
class Membre 
{
	public $_id;
	public $_login;
	public $_mdp;
    public $_email;
    public $_droit; /*Etudiant = 0, Personnel = 1*/

    /* action inscription : 0 | action connexion : 1 */
    public
        function __construct ($dbh,$login,$mdp,$email,$action)
        {
	        $this->_login = $login;
            $this->_email = $email;

            /* On chiffre le mot de passe */
            $this->_mdp = md5($motdepasse);

            if ($action)
                $this->connexion($dbh);
        }

	/* return :
	 * 0 = Connexion effectué
	 * -1 = Echec de connexion (couple login mot de passe ne correspond pas)
	 */
	public  
        function connexion ($dbh)
        {
        	require_once(getcwd().'/include/gestion_pdo.inc.php');
            require(getcwd().'/include/requetes_sql.inc.php');
            
    		// Verification des login
        	$stmt=$dbh->prepare($requete_sql_charger_user);
            
            $stmt->bindValue(':mail',$this->_email,PDO::PARAM_STR);
            $stmt->bindValue(':password',$this->_mdp,PDO::PARAM_STR);

            $stmt->execute();
            
            /* Recuperation dans un tableau */
            $array = $stmt->fetchAll();
            print_r($array);

            if (!empty($array))
            {  
	            $this->_id = $array[0][0];
	            $this->_droit = $array[0][1];
        		if ( $this->_droit >= 1 )
        		{       		
        			$etudiant = new etudiant($dbh,$this);
        			echo "je suis un membre étudiant";
        			echo "<pre>\n</pre>";
        			return 	0; 
        		}
        		else if ( $this->_droit == 0 )
        		{
        			$personnel = new personnel($dbh,$this);
        			echo "je suis un membre du personnel";
        			echo "<pre>\n</pre>";
        			return -1; //instruction vide
        		}
        		else
        		{
        			echo "je suis un membre à problème de droit";
        			echo "<pre>\n</pre>"; //problème de droit
        		}
        	}
        	else
        	{
				echo "je suis un invité qui n'arrive pas a se connecter";
				echo "<pre>\n</pre>";
        		return 1;
        	}
        }

	
}

?>