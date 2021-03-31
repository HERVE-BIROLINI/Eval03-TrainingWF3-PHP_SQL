<?php

// funEcho(2,'- Chargement (require) du fichier PHP d\'initialisation des outils de BdD ("01-DB.php")...');

    // phpinfo();

    // ** Définition des constantes : ... **
    // * ... Nécessaires à la connexion avec la BdD
    define('CO_DB_NAME','immobilier');
    define('CO_DB_USER','root');
    define('CO_DB_PWD','root');
    define('CO_DB_HOST','127.0.0.1:8889');

    // Instanciation de l'Objet de CLASS PDO pour interface avec la BdD SQL
    try{
        $dbAddress='mysql:host='.CO_DB_HOST.';dbname='.CO_DB_NAME;
        $dbPDOConnect=new PDO($dbAddress,CO_DB_USER,CO_DB_PWD);
    }
    catch(PDOException $error){
        die('Erreur = '.$error->getMessage());
    }
?>
