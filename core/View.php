<?php

namespace Core;

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

        // Buffer the views
        ob_start();
        include_once AppRootDirectory . "/views/$viewAdress.php";
        return ob_get_clean();
    }
}