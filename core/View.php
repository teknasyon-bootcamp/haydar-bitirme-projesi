<?php

namespace Core;

use Core\Session\Session;

class View 
{
    public function render($viewAdress, ?array $data = [])
    {
        /**
         * Serialize path
         * 
         * Ex : dashboard.pages.home => dashboard/pages/home
         */
        $viewAdress = str_replace('.', '/', $viewAdress);

        // Convert $data array to variables
        extract($data);

        $errors = new Session;
        $success = Session::getFlash('success', false); 

        // Buffer the views
        ob_start();
        include_once AppRootDirectory . "/views/$viewAdress.php";
        return ob_get_clean();
    }
}