<?php
    session_start();

// echo'</br>- $_SESSION = ';
// print_r($_SESSION);

    // Mes constantes :
    //*****************/
    defined('CO_FUNCTIONSUSER') or define('CO_FUNCTIONSUSER',(get_defined_functions()['user']));
    /* <?=CO_PATHCSS.'bootstrap.css';?> */
    // (pour hébergement : ftptonnomftp/www/tondossier/css/etc/etc/etc)
    
    // Pour serveur hébergeur :
    // defined('CO_PROJECTNAME') or define('CO_PROJECTNAME','/');
    // ... pour serveur LOCALHOST :
    defined('CO_PROJECTNAME') or define('CO_PROJECTNAME','eval03-php');

    // Si le dernier dossier du chemin SCRIPT_FILENAME
    //   ==
    // le 1er dossier du chemin REQUEST_URI
    //  => alors le site (la page d'accueil du site)
    //     est dans un dossier 'intermédiaire' du serveur...
// echo'</br> - $_SERVER[\'HTTP_HOST\'] = '.$_SERVER['HTTP_HOST'];
// echo'</br> - $_SERVER[\'SCRIPT_FILENAME\'] = '.$_SERVER['SCRIPT_FILENAME'];
// echo'</br> - $_SERVER[\'DOCUMENT_ROOT\'] = '.$_SERVER['DOCUMENT_ROOT'];
    $sAfterHTTPRoot=substr(stristr($_SERVER['SCRIPT_FILENAME'],substr($_SERVER['DOCUMENT_ROOT'],-3)),3);
    $sAfterHTTPRoot=substr(stristr($sAfterHTTPRoot,CO_PROJECTNAME,true),0,-1);
    
    //
    // Si serveur local => ajoute le nom du projet aux chemins...
    if(strlen(stristr($_SERVER['HTTP_HOST'],'localhost')) > 0){
        defined('CO_HTTP_ROOT') or define('CO_HTTP_ROOT',"http://".$_SERVER['HTTP_HOST'].$sAfterHTTPRoot.'/'.CO_PROJECTNAME.'/');
        defined('CO_DOCUMENT_ROOT') or define('CO_DOCUMENT_ROOT',stristr($_SERVER['SCRIPT_FILENAME'],CO_PROJECTNAME,true).CO_PROJECTNAME.'/');
    }
    // ... sinon, serveur distant (hébergeur), n'ajoute surtout pas le nom du projet
    else{
        defined('CO_HTTP_ROOT') or define('CO_HTTP_ROOT',"http://".$_SERVER['HTTP_HOST'].'/');
        defined('CO_DOCUMENT_ROOT') or define('CO_DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT'].'/');
    }
    //
    defined('CO_HTTP_REQUIRES_TOP') or define('CO_HTTP_REQUIRES_TOP',CO_HTTP_ROOT.'php/requires/top/');
    defined('CO_PATH_REQUIRES_TOP') or define('CO_PATH_REQUIRES_TOP',CO_DOCUMENT_ROOT.'php/requires/top/');
    defined('CO_HTTP_REQUIRES_BOTTOM') or define('CO_HTTP_REQUIRES_BOTTOM',CO_HTTP_ROOT.'php/requires/bottom/');
    defined('CO_PATH_REQUIRES_BOTTOM') or define('CO_PATH_REQUIRES_BOTTOM',CO_DOCUMENT_ROOT.'php/requires/bottom/');
    //
    defined('CO_HTTP_ADMIN') or define('CO_HTTP_ADMIN',CO_HTTP_ROOT.'php/admin/');
    defined('CO_PATH_ADMIN') or define('CO_PATH_ADMIN',CO_DOCUMENT_ROOT.'php/admin/');
    defined('CO_HTTP_LOGEMENTS') or define('CO_HTTP_LOGEMENTS',CO_HTTP_ROOT.'php/logements/');
    defined('CO_PATH_LOGEMENTS') or define('CO_PATH_LOGEMENTS',CO_DOCUMENT_ROOT.'php/logements/');
    defined('CO_HTTP_USERS') or define('CO_HTTP_USERS',CO_HTTP_ROOT.'php/users/');
    defined('CO_PATH_USERS') or define('CO_PATH_USERS',CO_DOCUMENT_ROOT.'php/users/');
    defined('CO_HTTP_SRC') or define('CO_HTTP_SRC',CO_HTTP_ROOT.'src/');
    defined('CO_PATH_SRC') or define('CO_PATH_SRC',CO_DOCUMENT_ROOT.'src/');
    defined('CO_HTTP_CSS') or define('CO_HTTP_CSS',CO_HTTP_ROOT.'css/');
    defined('CO_PATH_CSS') or define('CO_PATH_CSS',CO_DOCUMENT_ROOT.'css/');
    defined('CO_HTTP_JS') or define('CO_HTTP_JS',CO_HTTP_ROOT.'js/');
    defined('CO_PATH_JS') or define('CO_PATH_JS',CO_DOCUMENT_ROOT.'js/');
    // Initialise les paramètres de connexion à la base de donnée
    require_once "01-db.php";

    // Mes variables :
    //****************/

    // Mes fonctions :
    //****************/
    /*  @param	$sTypeMsg	STRING or INT	Background color
     *      'info' or 2 (bleu ciel)     = #d1ecf1 / rgb(209, 236, 241) / hsl(189, 53%, 88%)
     *      'success' or 1 (vert pâle)  = #d4edda / rgb(212, 237, 218) / hsl(134, 41%, 88%)
     *      'warning' or 0 (paille)      = #fff3cd / rgb(209, 236, 241) / hsl(355, 70%, 91%)
     *      'danger' or -1 (rouge pâle) = #f8d7da / rgb(248, 215, 218) / hsl(355, 70%, 91%)
     *  @param	$sMessage	STRING      	Message to show
    */
    if(!in_array('funEcho',CO_FUNCTIONSUSER)){
        function funEcho($sTypeMsg, $sMessage){
            if(isset($sMessage) and gettype($sMessage)=='string'){
                switch($sTypeMsg){
                    case'warning':case'0':case 0:
                        $sStyle='background-color:#fff3cd;width=100;';
                    break;
                    case'danger':case'-1':case -1:
                        $sStyle='background-color:#f8d7da;width=100;';
                    break;
                    case'success':case'1':case 1:
                        $sStyle='background-color:#d4edda;width=100;';
                    break;
                    default:// 'info'
                        $sStyle='background-color:#d1ecf1;width=100;';
                    break;
                }
                //
                echo'<div style="'.$sStyle.'padding:10px;">'.$sMessage.'</div>';
            }
        }
    }
    /*  @param	$sFolder	STRING	path to scan
     *  @param	$sExtension	STRING	extension to consider, could be '' for ALL
     *  @return	$arResult	ARRAY	containing founded files as STRING
    */
    if(!in_array('fundirfiles',CO_FUNCTIONSUSER)){
        function funDirFiles($sFolder, $sExtension){
            $bArgFolderIsString=is_string($sFolder);
            $bArgExtensionIsString=is_string($sExtension);
            if($bArgFolderIsString
                and $bArgExtensionIsString
                // and $bArgExtensionIsString=is_string($sExtension)
                )
            {
                switch($sExtension){
                    case '':case '*':
                        $sExtension='';
                        break;
                    default:
                        $sExtension=substr($sExtension,-3);
                        break;
                }
                $arScanDir=scandir($sFolder);
                if(is_array($arScanDir)){return $arScanDir;}
            }
        }
    }
    /*  @param	$sWord2Analyze	STRING	sentence to scan
     *  @return					BOOLEAN
    */
    if(!in_array('isalphaonly',CO_FUNCTIONSUSER)){
        function isAlphaOnly($sWord2Analyze){
            foreach(str_split($sWord2Analyze,1) as $sLetter){
                $iAsciiCode=ord($sLetter);
                if(!(($iAsciiCode > 64 and $iAsciiCode < 91) or
                    ($iAsciiCode > 96 and $iAsciiCode < 123) or
                    $iAsciiCode==195
                    )
                )
                {return false;}
            }
            return true;
        }
    }

    
    /*
     is_numeric existe déjà
      @param	$sWord2Analyze	STRING	sentence to scan
       @return					BOOLEAN
     
     if(!in_array('isanumeric',CO_FUNCTIONSUSER)){
        function isANumeric($sWord2Analyze){
            foreach(str_split($sWord2Analyze,1) as $sLetter){
                $iAsciiCode=ord($sLetter);
                if(!(($iAsciiCode > 47 and $iAsciiCode < 58) or
                    $iAsciiCode==44 or $iAsciiCode==46 // ',' et '.'
                    )
                )
                {return false;}
            }
            return true;
        }
    }
    */

// funEcho(2,'- Chargement (require) du fichier "00-PHP_Init.php"...');
    $bInitLoaded=true;
?>
