<?php
/*
Archivo:  index.php
Objetivo: verifica usuario y contraseña desde agenda_usuarios
*/
include_once("modelo/Usuario.php");
session_start();

$sErr = "";
$oUsu = new Usuario();

/* Verificar que hayan llegado los datos */
if (isset($_POST["txtUsuario"]) && !empty($_POST["txtUsuario"]) &&
    isset($_POST["txtContrasena"]) && !empty($_POST["txtContrasena"])) {
    
    $usuario = $_POST["txtUsuario"];
    $contrasena = $_POST["txtContrasena"];
    
    $oUsu->setUsuario($usuario);
    $oUsu->setContrasena($contrasena);

    try {
        if ($oUsu->validarLogin()) {
            $_SESSION["usuario"] = $oUsu->getUsuario();
            $_SESSION["rol"] = $oUsu->getRol();

            // Redirigir según el rol
            if ($oUsu->getRol() == "1") {
                header("Location: inicio.php");//Aqi redirige si eres admin
            } elseif ($oUsu->getRol() == "2") {
                header("Location: inicio.php");//
            } else {
                $sErr = "Rol desconocido";
                header("Location: error.php?sError=" . urlencode($sErr));
            }
        } else {
            $sErr = "Usuario o contraseña incorrectos";
            header("Location: error.php?sError=" . urlencode($sErr));
        }
    } catch (Exception $e) {
        error_log($e->getMessage(), 0);
        $sErr = "Error al acceder a la base de datos";
        header("Location: error.php?sError=" . urlencode($sErr));
    }
} else {
    $sErr = "Faltan datos";
    header("Location: error.php?sError=" . urlencode($sErr));
}
?>
