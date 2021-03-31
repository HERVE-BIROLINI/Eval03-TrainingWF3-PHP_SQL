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

    //
    if(isset($_POST['submit']) and isset($_FILES['photo']) and $_FILES['photo']['error']===0){
        
        //  * File *
        //    - Déclare les extensions acceptées
        // déclaration du dossier destination
        $sFolder='../../uploads/';
        // $sFolder='/exercices/PHP-Projet/uploads/';
        //
        // récupère le nom (sans le chemin) de l'image dans la super globale
        // ... récupère les informations sur le fichier...
        $sFilePathInfo=pathinfo($_FILES['photo']['name']);
        // $sFileName=$_FILES['photo']['name'];
        // ... ... en déduit le nom (sans l'extension)
        $sFileName=$sFilePathInfo['filename'];
        // ... ... en déduit son extension
        $sFileExtension=strtolower($sFilePathInfo['extension']);
        // Parce que l'outil AURA DEJA copié le fichier dans une zone tampon...
        // ... récupère le chemin de cette zone tampon
        $sFileTmp=$_FILES['photo']['tmp_name'];
        $arExtensions=array('jpg','jpeg','png','webp','ico');
        $sEcho='';
        if(!in_array($sFileExtension, $arExtensions)){
            $bError=true;
            $sEcho=$sEcho.'Vous devez choisir un fichier du type autorisé :';
            foreach($arExtensions as $sExtension){
                $sEcho=$sEcho.' '.$sExtension.',';
            }
            funEcho(-1,substr($sEcho,0,-1));
        }
            
        // teste le CP
        if(!is_numeric($_POST['cp'])){
            funEcho(-1,'Le code Postal que vous avez renseigné est incorrect.</br>Merci de le corriger...');
            $bError=true;
        }
        // funEcho(2,'le type de \'cp\' est : '.gettype($_POST['cp']+1));
        elseif(strlen($_POST['cp'])<5){
            funEcho(0,'Le code postal était trop court... (ne devrait pas passer par là !');
            $sCP='0'.$_POST['cp'];
        }
        else{$sCP=$_POST['cp'];}

        // si pas d'erreur, enregistre...
        if(!isset($bError)){
            // transforme le nom du ficher
            $sPhotoFileName='logement_'.time().'.jpg';
            // ... écrit dans la BD
            $stQuery=$dbPDOConnect->prepare("insert into logement (titre,adresse,ville,cp,surface,prix,photo,type,description) values(?,?,?,?,?,?,?,?,?)");
            $stQuery->execute([$_POST['titre'],$_POST['adresse'],$_POST['ville'],
                $sCP,$_POST['surface'],$_POST['prix'],
                //
                $sPhotoFileName,
                //
                $_POST['type'],$_POST['description']]);
            //
            header('Location: logements.php');
            // exit();
        }
    }
    elseif(isset($_POST['submit'])){
        $bError=true;
        funEcho(-1,'Vous devez choisir un fichier image pour l\'article à créer.');
    }
    // else{funEcho(2,'ENTREE dans le formulaire de création...');}

    // if(iss)
?>

<div class="d-flex flex-row justify-content-center">
    <form class="col-10" method="post" enctype="multipart/form-data"
    style="padding-top:10vh;padding-bottom:10vh;align-self:centered;">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column col-4 justify-content-around">
                <label for="titre">Titre</label>
                <label for="adresse">Adresse</label>
                <label for="ville">Ville</label>
                <label for="cp">CP</label>
                <label for="surface">Surface (m&sup2;)</label>
                <label for="prix">Prix (€)</label>
                <label for="type">Type</label>
                <label for="photo">Photo</label>
                <label for="description">Description</label>
                <!-- <label for="titre">Actions</label> -->
            </div>
            <div class="d-flex flex-column col-8">
                <input type="text" id="titre" class="form-control" name="titre"
                    value='<?php if(isset($_POST['titre'])){echo$_POST['titre'];}?>'
                    required style="width:100%;"
                >
                <p></p>
                <input type="text" id="adresse" class="form-control" name="adresse"
                    value='<?php if(isset($_POST['adresse'])){echo$_POST['adresse'];}?>'
                    required style="width:100%;"
                >
                <p></p>
                <input type="text" id="ville" class="form-control" name="ville"
                    value='<?php if(isset($_POST['ville'])){echo$_POST['ville'];}?>'
                    required style="width:100%;"
                >
                <p></p>
                <input type="text" id="cp" class="form-control" name="cp"
                    minlength="5" maxlength="5" required style="width:100%;"
                    value='<?php if(isset($_POST['cp'])){echo$_POST['cp'];}?>'
                >
                <p></p>
                <input type="number" id="surface" class="form-control" name="surface"
                    value='<?php if(isset($_POST['surface'])){echo$_POST['surface'];}?>'
                    required style="width:100%;"
                >
                <p></p>
                <input type="number" id="prix" class="form-control" name="prix"
                    value='<?php if(isset($_POST['prix'])){echo$_POST['prix'];}?>'
                    required style="width:100%;"
                >
                <p></p>
                <select id="type" class="form-control" name="type" style="width:100%;" required>
                    <option value="location"<?php if(isset($_POST['type'])and $_POST['type']=='location'){echo'selected';}?>>location</option>
                    <option value="vente"<?php if(isset($_POST['type'])and $_POST['type']=='vente'){echo'selected';}?>>vente</option>
                </select>
                <p></p>
                <input type="file" class="form-control" name="photo" value="">
                <p></p>
                <input type="text" id="description" class="form-control" name="description"
                    value='<?php if(isset($_POST['description'])){echo$_POST['description'];}?>'
                    style="width:100%;"
                >
                <p></p>
            </div>
        </div>
        <div class="d-flex flex-row">
            <div class="col-4"></div>
            <div class="col-8">
                <a  href=<?='logements.php'?> class="btn btn-secondary">Retour à la liste</a>
                <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
</div>


<?php
	foreach(funDirFiles(CO_PATH_REQUIRES_BOTTOM,'') as $sFile){
		if(ctype_digit(substr($sFile,0,2))){
			require_once CO_PATH_REQUIRES_BOTTOM.$sFile;
		}
	}
?>

