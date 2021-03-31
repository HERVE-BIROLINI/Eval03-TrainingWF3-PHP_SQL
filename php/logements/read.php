<?php

	/**** LOADING OF 'PARTS' OF MAIN PHP PAGE ****/
	/** ... STRICLY REQUIRED PARTS (PHP codes mainly) **/
	require_once "../requires/00-php_init.php";
	//
	foreach(funDirFiles(CO_PATH_REQUIRES_TOP,'') as $sFile){
		if(ctype_digit(substr($sFile,0,2))){
			require_once CO_PATH_REQUIRES_TOP.$sFile;
		}
	}

?>

<style type="text/css">
    .FormRead{
        font-size:0.85em;
    }
</style>

<form class="col-12 FormRead" method="post" enctype="multipart/form-data"
    style="padding-bottom:10vh;align-self:centered;"
>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col" for="titre">Titre</th>
                <th scope="col" for="adresse">Adresse</th>
                <th scope="col" for="ville">Ville</th>
                <th scope="col" for="cp">CP</th>
                <th scope="col" for="surface">Surf. (m&sup2;)</th>
                <th scope="col" for="prix">Prix (€)</th>
                <th scope="col" for="type">Type</th>
                <th scope="col" for="photo">Photo</th>
                <th scope="col" for="description">Description</th>
                <th scope="col" for="titre">Actions</th>
            </tr>
        </thead>
        <!-- -->
        <tbody>
            <?php
                //
                $stQuery_AllLogements=$dbPDOConnect->query("select * from logement");
                $arAllLogements=$stQuery_AllLogements->fetchall( );//PDO::FETCH_ASSOC); => valeur par défaut pour un TABLEAU ASSOCIATIF
                if(isset($arAllLogements)){
// var_dump($arAllLogements);
                    foreach($arAllLogements as $arLogement){
// var_dump($arLogement);
                        // if(!isset($_GET['id_logement']) or $arLogement['id_logement']==$_GET['category_id']){
            ?>
            <tr>
                <td scope="row">
                    <p><?php if(isset($arLogement['titre'])){echo $arLogement['titre'];}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['adresse'])){echo $arLogement['adresse'];}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['ville'])){echo $arLogement['ville'];}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['cp'])){echo $arLogement['cp'];}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['surface'])){echo sprintf("%s m&sup2;", $arLogement['surface']);}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['prix'])){echo sprintf("%s €", $arLogement['prix']);}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['type'])){echo $arLogement['type'];}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['photo'])){echo $arLogement['photo'];}?></p>
                </td>
                <td scope="row">
                    <p><?php if(isset($arLogement['description'])){echo $arLogement['description'];}?></p>
                </td>
                <td scope="row">
                    <a href=<?= 'update.php?id='.$arLogement['id_logement']?> class="btn btn-primary">Modifier</a>
                    <a href=<?= 'delete.php?id='.$arLogement['id_logement']?> class="btn btn-danger">Supprimer</a>
                    <!-- <a href=<?= CO_HTTP_LOGEMENTS.'update.php?id='.$arLogement['id_logement']?> class="btn btn-primary">Modifier</a>
                    <a href=<?= CO_HTTP_LOGEMENTS.'delete.php?id='.$arLogement['id_logement']?> class="btn btn-danger">Supprimer</a> -->
                </td>
			</tr>
            
            <?php
                    }
                }
            ?>
		</tbody>

	</table>
    <a href="<?= CO_HTTP_LOGEMENTS.'create.php'?>" class="btn btn-primary">Ajouter</a>
</form>



<?php
	foreach(funDirFiles(CO_PATH_REQUIRES_BOTTOM,'') as $sFile){
		if(ctype_digit(substr($sFile,0,2))){
			require_once CO_PATH_REQUIRES_BOTTOM.$sFile;
		}
	}
?>