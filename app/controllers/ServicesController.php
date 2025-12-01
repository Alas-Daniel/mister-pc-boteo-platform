<?php

class ServicesController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Servicios - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1758338073/hero_lbtcnh.jpg'
        ];

        $this->view('landing/servicios', [
            'head' => $head
        ]);
    }
}
