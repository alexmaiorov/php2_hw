<?php
require_once ('../config/config.php');
require_once ('../Twig/Autoloader.php');

function catalogPage($connect) {
    try {
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem('../templates');
        $twig = new Twig_Environment($loader);

        $sql = "SELECT * FROM products LIMIT 8";
        $res = mysqli_query($connect,$sql);
        while ($data = mysqli_fetch_assoc($res)){
            $dataProduct[] = $data;
        };
        
        $template = $twig->loadTemplate('catalog.tmpl');
        echo $template->render(array(
            'dataProduct' => $dataProduct,
        ));	

        mysqli_close($connect);
    }
    catch (Exception $e) {
        die ('ERROR: '.$e->getMessage());
    }
}