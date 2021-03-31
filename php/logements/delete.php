<?php

    /**** LOADING OF 'PARTS' OF MAIN PHP PAGE ****/
    /** ... STRICLY REQUIRED PARTS (PHP codes mainly) **/
    require_once "../requires/00-php_init.php";
    //

    if(isset($_GET['id'])){
        $sEcho='<div class="alert alert-danger" role="alert">';
        // // - suppression de l'ancien fichier SSI...
        // $stRequest=$dbPDOConnect->prepare("select file from item where id=?");
        // $stRequest->execute([$_GET['id']]);
        // $arLogement2Delete=$stRequest->fetch();
        // $sCurrentFile=$arLogement2Delete['file'];
        //
        // $stRequest=$dbPDOConnect->prepare("select * from logement where file=?");
        // $stRequest->execute([$sCurrentFile]);
        // ... n'est pas utilisé par un autre article
        // if($stRequest->rowcount()==1){
        //     unlink('../../uploads/'.$sCurrentFile);
        //     $sEcho=$sEcho.'Le fichier image n\'étant pas utilisé par un autre article, a été supprimé.</br>';
        // }
        // else{$sEcho=$sEcho.'Le fichier image étant aussi utilisé par un autre article, n\'a pas été supprimé.</br>'; }
        //
        $sQuery="delete from logement where id_logement=?";
        $dbPDOConnect->prepare($sQuery)->execute([$_GET['id']]);
    }
    //
    header('Location: logements.php');
    exit();
?>