<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

// IMPORTANT!!! Do not remove uncommented settings in this file even if
// you are using session configuration.
// See http://kcfinder.sunhater.com/install for setting descriptions

/*
if (isset($_SESSION["ckfinderLogin"]) && $_SESSION["ckfinderLogin"] == true) {
    $app_path   = $_SESSION["app_path"];
    $path_y 	= $app_path .'/../public/uploads/images/contents/'.date('Y');
    $path_m		= $path_y.'/'.date('m');
    $path_d     = $path_m.'/'.date('d');
    if (!is_dir($path_y)) {
        mkdir($path_y);
    }
    if (!is_dir($path_m)) {
        mkdir($path_m);
    }
    if (!is_dir($path_d)) {
        mkdir($path_d);
    }
    $base_url = $_SESSION["base_url"];
    $_SESSION['KCFINDER']['uploadURL'] = $base_url.'public/uploads/images/contents/'.date("Y").'/'.date("m").'/'.date("d");
    $_SESSION['KCFINDER']['uploadDir'] = $app_path.'/../public/uploads/images/contents/'.date("Y").'/'.date("m").'/'.date("d");
}
*/


$_SESSION['KCFINDER']['uploadURL'] = 'http://dev.lar-shop.vn/uploads/contents';
$_SESSION['KCFINDER']['uploadDir'] = $_SERVER["DOCUMENT_ROOT"].'/uploads/contents';

$_CONFIG = array(

    'disabled' => false,
    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,

    'theme' => "oxygen",

    'uploadURL' => "upload",
    'uploadDir' => "",

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true
        ),

        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),

    'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",

    'types' => array(

        // CKEditor & FCKEditor types
        'files'   =>  "",
        'flash'   =>  "swf flv",
        'images'  =>  "*img",

        // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),

    'filenameChangeChars' => array(
        ' ' => "_",
        ':' => "."
    ),

    'dirnameChangeChars' => array(
        ' ' => "_",
        ':' => "."
    ),

    'mime_magic' => "",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'thumbsDir' => ".thumbs",

    'jpegQuality' => 100,

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    '_check4htaccess' => false,
    //'_tinyMCEPath' => "/tiny_mce",

    '_sessionVar' => &$_SESSION['KCFINDER'],
    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);

?>