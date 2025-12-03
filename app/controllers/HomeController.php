<?php

require_once __DIR__ . '/../models/ProductoModel.php';

//Controller de Inicio (landing)
class HomeController extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function index()
    {
        $producto = new ProductoModel($this->db);
        $destacados = $producto->getDestacados();

        $head = [
            'title' => 'Inicio - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1758338073/hero_lbtcnh.jpg'
        ];

        $this->view('landing/inicio', [
            'head' => $head,
            'productos_destacados' => $destacados
        ]);
    }
}
