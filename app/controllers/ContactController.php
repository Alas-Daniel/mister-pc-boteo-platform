<?php

class ContactController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Contáctanos - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1758338073/hero-contacto.jpg'
        ];

        // Enviar a la vista
        $this->view('landing/contacto', [
            'head' => $head
        ]);
    }
}
