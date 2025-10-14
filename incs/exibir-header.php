<?php
require_once __DIR__ . "/../src/autoload.php";

if (!AdminDAO::validarAdmin($_SESSION['idusuario'])) {
    include "components/header.php";
} else {
    include "components/header-admin.php";
}

?>