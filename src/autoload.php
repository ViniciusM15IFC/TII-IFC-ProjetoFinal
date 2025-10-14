<?php
spl_autoload_register(function ($classe) {
    require_once __DIR__ . "/" . $classe . ".php";
});
