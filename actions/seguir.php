<?php 

include "../incs/valida-sessao.php";
require_once __DIR__ . "/../src/autoload.php";

if (isset($_GET['idseguido'])) 
{
    SeguidoDAO::seguir($_SESSION['idusuario'], $_GET['idseguido']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

