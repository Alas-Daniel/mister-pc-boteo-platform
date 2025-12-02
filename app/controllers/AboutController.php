<?php

//Controller de Sobre Nosotros (landing)
class AboutController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Sobre Nosotros - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1764697967/nosotros_hero_bgae7b.jpg'
        ];

        $this->view('landing/nosotros', [
            'head' => $head
        ]);
    }
}
