<?php
    declare(strict_types=1);

    define("DD", realpath("../")); // recall file path to use short keywords

    require DD. "/cza/functions.php";
    require DD. "/app/controller/controllers.php";  // second line cos of use function

    // $default_lang = _config_get("app.lang");
    // $error = _lang_get("settings.view_not_found");
    // var_dump($error);
    // var_dump($default_lang);
    // die();

    if(!isset($_GET['page'])) {
        $page = "home";
    } else {
        $page = htmlspecialchars($_GET['page']);     // add htmlspecialchars for to protect sql injection
    }

    $controller = "_" . ucfirst($page) . "Controller";
    if (function_exists($controller)) {
        call_user_func($controller);
    } else {
        echo "404 Idiots";
    }
 
?>