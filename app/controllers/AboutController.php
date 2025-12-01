<?php

//Controller de Sobre Nosotros (landing)
class AboutController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Sobre Nosotros - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1758338073/hero-nosotros.jpg'
        ];

        $this->view('landing/nosotros', [
            'head' => $head
        ]);
    }
}
