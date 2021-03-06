<?php

//jCMS
//created by Joan Gimenez Donat
//@joan16v
//joan16v@gmail.com

session_start();

$link = mysql_connect("bbdd.server.com", "username", "password") or die("Could not connect: " . mysql_error());
mysql_select_db("bbdd_name");
mysql_query("SET NAMES utf8");

define('PAGE_TITLE', 'jCMS - free and simple php+mysql content management system');
define('EMAIL_OWNER', 'joan16v@gmail.com');
define('SERVER_DIR', $_SERVER['DOCUMENT_ROOT'] . "/");
define('PAGE_DIR', 'jcms/');
define('BASE_HREF', "http://".$_SERVER['HTTP_HOST'] . "/" . PAGE_DIR);

if (!isset($_SESSION["lang_session"])) {
    include("php_language_detection.php");
    $array_idiomas_navegador = get_languages("data");
    for ($i = 0; $i < count($array_idiomas_navegador); $i++) {
            $idioma_navegador = $array_idiomas_navegador[$i][1];
            if ($i == 0) {
                if ($idioma_navegador == "es") {
                    $_SESSION["lang_session"] = "ES";
                }
                if ($idioma_navegador == "en") {
                    $_SESSION["lang_session"] = "EN";
                }
            }
    }
}

if (!isset($_SESSION["lang_session"])) {
    $_SESSION["lang_session"] = "ES";
}

if (isset($_GET['lang'])) {
    if ($_GET['lang'] == "ES" || $_GET['lang'] == "EN") {
        $_SESSION["lang_session"] = $_GET['lang'];
        header("Location: " . $_SERVER['SCRIPT_NAME']);
        exit(0);
    }
}

function reSanitizar($x) {
    $x = str_replace("Á", "A", $x);
    $x = str_replace("À", "A", $x);
    $x = str_replace("É", "E", $x);
    $x = str_replace("È", "E", $x);
    $x = str_replace("Í", "I", $x);
    $x = str_replace("Ì", "I", $x);
    $x = str_replace("Ó", "O", $x);
    $x = str_replace("Ò", "O", $x);
    $x = str_replace("Ú", "U", $x);
    $x = str_replace("Ù", "U", $x);
    $x = str_replace("á", "a", $x);
    $x = str_replace("à", "a", $x);
    $x = str_replace("é", "e", $x);
    $x = str_replace("è", "e", $x);
    $x = str_replace("í", "i", $x);
    $x = str_replace("ì", "i", $x);
    $x = str_replace("ó", "o", $x);
    $x = str_replace("ò", "o", $x);
    $x = str_replace("ú", "u", $x);
    $x = str_replace("ù", "u", $x);
    $x = str_replace("Ñ", "N", $x);
    $x = str_replace("ñ", "n", $x);
    return ereg_replace("[^ A-Za-z0-9_-]", "", $x);
}

function limpiar_nombre_foto($x) {
    return ereg_replace("[^.A-Za-z0-9_-]", "", $x);
}

function url_clean($x) {
    $x = str_replace("  ", " ", $x);
    $x = str_replace(" ", "-", $x);
    $x = str_replace("Á", "A", $x);
    $x = str_replace("À", "A", $x);
    $x = str_replace("É", "E", $x);
    $x = str_replace("È", "E", $x);
    $x = str_replace("Í", "I", $x);
    $x = str_replace("Ì", "I", $x);
    $x = str_replace("Ó", "O", $x);
    $x = str_replace("Ò", "O", $x);
    $x = str_replace("Ú", "U", $x);
    $x = str_replace("Ù", "U", $x);
    $x = str_replace("á", "a", $x);
    $x = str_replace("à", "a", $x);
    $x = str_replace("é", "e", $x);
    $x = str_replace("è", "e", $x);
    $x = str_replace("í", "i", $x);
    $x = str_replace("ì", "i", $x);
    $x = str_replace("ó", "o", $x);
    $x = str_replace("ò", "o", $x);
    $x = str_replace("ú", "u", $x);
    $x = str_replace("ù", "u", $x);
    $x = str_replace("Ñ", "N", $x);
    $x = str_replace("ñ", "n", $x);
    $x = strtolower($x);
    return ereg_replace( "[^.A-Za-z0-9_-]", "", $x);
}

if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "", $crypt = 0)  {
        if (isset($theValue)) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
            $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
            switch ($theType) {
                case "text":
                case "string":
                    $theValue = ($theValue != "") ? "" . (strip_tags($theValue)). "" : "";
                break;
                case "html":
                    $theValue = ($theValue != "") ? "" . (($theValue)). "" : "";
                break;
                case "":
                    $theValue = ($theValue != "") ? strip_tags($theValue): "";
                break;
                case "long":
                case "int":
                    $theValue = ($theValue != "") ? intval($theValue) : "";
                break;
                case "double":
                    $theValue = ($theValue != "") ? "" . doubleval($theValue) . "" : "";
                break;
                case "float":
                    $theValue = ($theValue != "") ? "" . floatval($theValue) . "" : "";
                break;
                case "date":
                    $theValue = ($theValue != "") ? "" . ($theValue) . "" : "";
                break;
                case "ticks":
                    $theValue = (($theValue != "") && ($theValue != 0)) ?  "FROM_UNIXTIME(" . doubleval($theValue) . ")"  : 0;
                break;
                case "datetime":
                    $theValue = ($theValue != "") ? "" . ($theValue) . "" : "";
                break;
                case "IP":
                    $theValue = ($theValue != "") ? "INET_ATON('" . $theValue . "')" : "";
                break;
                case "blob":
                    $theValue = ($theValue != "") ?  "".$theValue."" : "";
                break;
                case "defined":
                    $theValue = ($theValue != "") ? ($theDefinedValue) : $theNotDefinedValue;
                break;
                default:
                    $theValue="";
                    die("Tipo de valor no definido: " . $theType);
            }
            return $theValue;
        } else {
            return "";
        }
    }
}

function youtube($volcado) {
    if (ereg('\[youtube=', $volcado)) {
       $posicion = stripos($volcado, "[youtube=");
       $volcado1 = substr($volcado, 0, $posicion);
       $posicion = $posicion + 9;
       $volcadotemp = substr($volcado, $posicion, strlen($volcado) - $posicion);
       $posicion2 = strpos($volcadotemp, "]");
       $enlace_video = substr($volcadotemp, 0, $posicion2);
       $volcado2 = substr($volcadotemp, $posicion2 + 1, strlen($volcadotemp) - $posicion2 - 1);
       $posvideo = stripos($enlace_video, "watch?v=");
       $codigo_video = substr($enlace_video, $posvideo + 8, strlen($enlace_video) - 1);
       $enlace_video = "http://www.youtube.com/v/" . $codigo_video;
       $codigo_video = "<br><object width=\"425\" height=\"350\"><param name=\"movie\" value=\"" . $enlace_video . "\"></param><embed src=\"" . $enlace_video . "\" type=\"application/x-shockwave-flash\" width=\"425\" height=\"350\"></embed></object><br>";
       return $volcado1 . $codigo_video . youtube($volcado2);
    } else {
       return $volcado;
    }
}
