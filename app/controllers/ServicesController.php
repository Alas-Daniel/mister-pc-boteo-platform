<?php

//Controller de Nuestros servicios (landing)
class ServicesController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Servicios - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1764696577/nuestros_servicios_uezwp7.jpg'
        ];

        $this->view('landing/servicios', [
            'head' => $head
        ]);
    }
}
