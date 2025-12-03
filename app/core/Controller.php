<?php

//Controlador base
class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);

        $BASE_URL = BASE_URL;

        $file = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($file)) {
            require $file;
        } else {
            echo "Vista '$view' no encontrada.";
        }
    }
}
