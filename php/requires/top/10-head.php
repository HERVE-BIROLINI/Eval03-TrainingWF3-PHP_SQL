<!-- ***** 10-HEAD.PHP : START ***** -->

<?php
// echo'</br> - Chargement (include) du HEAD.PHP...';
// var_dump(CO_PATH_SRC);
?>

<!DOCTYPE html>
<html lang="fr"> <!-- <= Utile au référencement (CEO) -->
<head>
	<!-- vv Balises TRES importantes (CEO)... vv -->
	<!-- ...  pour acceptation des caractères spéciaux -->
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Type" content="text/html"/>
	<!-- <meta charset="utf-8"/>  Devenu obsolète au profit de la ligne de dessus -->
	<!-- ...  pour une identification du sujet, et de l'auteur/client -->
	<meta name="description" content="Projet d'évaluation PHP-SQL"/>
	<!-- ...  de l'auteur/client -->
	<meta name="author" content="Hervé BIROLINI"/>
	<!-- ...  de la langue -->
	<meta name="Language" content="fr"/>
	<!-- <meta name="keywords" content="NE SERT PLUS A RIEN"> -->
	<!-- VOIR TOUTES LES BALISES 'OG:...' (Open Graph)-->
	<!-- ^^ CEO ^^ -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK pour l'utilisation des fonctionnalités BootStrap (! à placer en 1er !) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!-- INCLUSION BOOTSTRAP : obtenu sur Getbootstrap.com / MAIS ON LE RELIE AU-DESSUS (???) -->
<!-- <link rel="stylesheet" href="css/bootstrap.css"/> -->
    <!-- LINK nécessaire pour bénéficier de la balise I, de CDN Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- LINK nécessaire pour bénéficier des Fonts Google -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap">
    <!-- LINK vers le CSS Perso pour la page HTML (! à placer après le lien BootStrap !) -->
	<!-- <link rel="stylesheet" type="text/css" href="<?=CO_PATH_CSS.'bootstrap.css';?>"/> -->

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital@1&display=swap" rel="stylesheet">
	
	<!-- Police de caractères -->
<!-- <link href="https://fonts.googleapis.com/css2?family=Barlow:ital@1&family=Roboto:wght@100&display=swap" rel="stylesheet"> -->

	<link rel="icon" type="image/png" href="<?=CO_HTTP_SRC.'immobilier.png';?>"/>
</head>
<body>
	<style type="text/css">
		body{background-color:rgb(243, 243, 243);}
		header{
			height:30vh;
			background-image:url(<?=CO_HTTP_SRC.'background-house.jpg';?>);
			/**/
			background-repeat: no-repeat;
			background-size: cover;
			/* background-attachment: fixed; */
			background-position: center center ;
		}
	</style>
	<!-- -->
	<script type="text/javascript">
	</script>

	<header>

	</header>

<!-- ***** 10-HEAD.PHP : END ***** -->
