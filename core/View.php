<?php

namespace Core;

use Core\Session;

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

        // Buffer the views
        ob_start();
        include_once AppRootDirectory . "/views/$viewAdress.php";
        Session::delete('flash');
        return ob_get_clean();
    }
}