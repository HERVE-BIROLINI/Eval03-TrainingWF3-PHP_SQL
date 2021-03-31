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
    if(isset($_POST['submit'])){

        //  * File *
        if(isset($_FILES['photo']) and $_FILES['photo']['error']===0){
            //    - Déclare les extensions acceptées
            // déclaration du dossier destination
            $sFolder='../../uploads/';
            // $sFolder='/exercices/PHP-Projet/uploads/';
            //
            // récupère le nom (sans le chemin) de l'image dans la super globale
            // $sFileName=$_FILES['photo']['name'];
            // ... récupère les informations sur le fichier...
            $sFilePathInfo=pathinfo($_FILES['photo']['name']);
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
            // transforme le nom du ficher
            $sPhotoFileName='logement_'.time().'.jpg';
        }
        
        // teste le CP
        if(!is_numeric($_POST['cp'])){
            funEcho(-1,'Le code Postal que vous avez renseigné est incorrect.</br>Merci de le corriger...');
            $bError=true;
        }
        // si le champs dans la base est VARCHAR, si INT => inutile...
        elseif(strlen($sCP=$_POST['cp'])<5){
            funEcho(0,'Le code postal était trop court... (ne devrait pas passer par là !)');
            while(strlen($sCP)!==5){$sCP='0'.$sCP;}
        }
        else{$sCP=$_POST['cp'];}
        
        // si pas d'erreur, enregistre...
        if(!isset($bError)){
            // ... écrit dans la BD
            if(isset($sPhotoFileName)){
                $stQuery=$dbPDOConnect->prepare("update logement set titre=?, adresse=?, ville=?, cp=?, surface=?, prix=?, photo=?, type=?, description=? where id_logement=?");
                $stQuery->execute([$_POST['titre'],$_POST['adresse'],$_POST['ville'],
                    $sCP,$_POST['surface'],$_POST['prix'],
                    //
                    $sPhotoFileName,
                    //
                    $_POST['type'],$_POST['description'],$_GET['id']]
                );
            }
            else{
                $stQuery=$dbPDOConnect->prepare("update logement set titre=?, adresse=?, ville=?, cp=?, surface=?, prix=?, type=?, description=? where id_logement=?");
                $stQuery->execute([$_POST['titre'],$_POST['adresse'],$_POST['ville'],
                    $sCP,$_POST['surface'],$_POST['prix'],$_POST['type'],$_POST['description'],$_GET['id']]
                );
            }
            //
            header('Location: logements.php');
            // exit();
        }
    }

    //
    if(isset($_GET['id']) and !empty($_GET['id'])){
        $stLogement2Update=$dbPDOConnect->prepare("select * from logement where id_logement=?");
        $stLogement2Update->execute([$_GET['id']]);
        // Vérifie que l'ID existe bien dans la BdD, si oui, retourne 1 ROW
        if($stLogement2Update->rowcount()>0){
            $arLogement=$stLogement2Update->fetch();
        }
        else{
            funEcho(-1,'Mauvais ID !');
            // header('location:index.php');
        }
// funEcho(2,'ENTREE dans le formulaire de modification...');
        
    }
    else{funEcho(-1,'Comment est-on arrivé là ?');}
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
                <label for="file">Fichier image</label>
                <label for="description">Description</label>
                <!-- <label for="titre">Actions</label> -->
            </div>
            <div class="d-flex flex-column col-8">
                <input type="text" id="titre" class="form-control" name="titre"
                    value="<?php    if(isset($_POST['titre'])){echo $_POST['titre'];}
                                    elseif(isset($arLogement['titre'])){echo $arLogement['titre'];}
                            ?>"
                    required style="width:100%;"
                >
                <p></p>
                <input type="text" id="adresse" class="form-control" name="adresse"
                    value="<?php    if(isset($_POST['adresse'])){echo $_POST['adresse'];}
                                    elseif(isset($arLogement['adresse'])){echo $arLogement['adresse'];}
                            ?>"
                    required style="width:100%;"
                >
                <p></p>
                <input type="text" id="ville" class="form-control" name="ville"
                    value="<?php    if(isset($_POST['ville'])){echo $_POST['ville'];}
                                    elseif(isset($arLogement['ville'])){echo $arLogement['ville'];}
                            ?>"
                    required style="width:100%;"
                >
                <p></p>
                <input type="text" id="cp" class="form-control" name="cp"
                    value="<?php    if(isset($sCP)){echo $sCP;}
                                    elseif(isset($_POST['cp'])){echo $_POST['cp'];}
                                    elseif(isset($arLogement['cp'])){echo $arLogement['cp'];}
                            ?>"
                    minlength="5" maxlength="5" required style="width:100%;"
                >
                <p></p>
                <input type="number" id="surface" class="form-control" name="surface"
                    value="<?php    if(isset($_POST['surface'])){echo $_POST['surface'];}
                                    elseif(isset($arLogement['surface'])){echo $arLogement['surface'];}
                            ?>"
                    required style="width:100%;"
                >
                <p></p>
                <input type="number" id="prix" class="form-control" name="prix"
                    value="<?php    if(isset($_POST['prix'])){echo $_POST['prix'];}
                                    elseif(isset($arLogement['prix'])){echo $arLogement['prix'];}
                            ?>"
                    required style="width:100%;"
                >
                <p></p>
                <select id="type" class="form-control" name="type" style="width:100%;" required>
                    <option value="location"
                        <?php   if(isset($_POST['type'])and $_POST['type']=='location'){echo'selected';}
                                elseif(isset($arLogement['type'])and $arLogement['type']=='location'){echo'selected';}
                        ?>>
                        location
                    </option>
                    <option value="vente"
                        <?php   if(isset($_POST['type'])and $_POST['type']=='vente'){echo'selected';}
                                elseif(isset($arLogement['type'])and $arLogement['type']=='vente'){echo'selected';}
                        ?>>
                        vente
                    </option>
                </select>
                <p></p>
                <input type="file" class="form-control" name="photo" value="">
                <p></p>
                <input type="text" id="description" class="form-control" name="description"
                    value="<?php    if(isset($_POST['description'])){echo $_POST['description'];}
                                    elseif(isset($arLogement['description'])){echo $arLogement['description'];}
                            ?>"
                    style="width:100%;"
                >
                <p></p>
                <!-- <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button> -->
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
