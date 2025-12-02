<?php

class ContactController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Contáctanos - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1753135286/nosotros_jbfyu8.png'
        ];

        // Enviar a la vista
        $this->view('landing/contacto', [
            'head' => $head
        ]);
    }
}
