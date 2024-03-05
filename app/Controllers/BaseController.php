<?php
    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

    namespace App\Controllers;
    use Laminas\Diactoros\Response\HTMLResponse;
    
    class BaseController {

        protected $templateEngine;

        public function __construct() {
            $loader = new \Twig\Loader\FilesystemLoader("../views");
            
            $this->templateEngine = new \Twig\Environment($loader, [
                "debug" => true,
                "cache" => false
            ]);
        }        
        public function renderHTML($flieName, $data = []){
            // ob_start();
            // include $flieName;
            // return ob_get_clean();
            return new HTMLResponse($this->templateEngine->render($flieName, $data));
        }

    }
    
?>