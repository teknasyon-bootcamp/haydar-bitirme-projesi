<?php

namespace Core;

use Core\Session\Session;

class View
{
    public array $globaldata;

    public function include($viewAdress, ?array $data = [])
    {
        /**
         * Serialize path
         * 
         * Ex : dashboard.pages.home => dashboard/pages/home
         */
        $viewAdress = str_replace('.', '/', $viewAdress);

        extract($this->globalData);

        // Convert $data array to variables
        extract($data);

        $errors = new Session;
        $success = Session::getFlash('success', false);

        // Buffer the views
        ob_start();
        include_once AppRootDirectory . "/views/$viewAdress.php";
        $view = ob_get_clean();

        return $view;
    }

    public function render($viewAdress, ?array $data = [])
    {
        $this->globalData = $data;

        $view = $this->include($viewAdress, $data);

        Session::delete('flash');;

        return $view;
    }
}
