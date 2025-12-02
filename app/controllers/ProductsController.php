<?php

require_once __DIR__ . '/../models/ProductoModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';

class ProductsController extends Controller
{
    private $db;
    private $productoModel;
    private $categoriaModel;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->productoModel = new ProductoModel($this->db);
        $this->categoriaModel = new CategoriaModel($this->db);
    }

    public function index()
    {
        $categoria_id = null;
        if (isset($_GET['categoria_id']) && is_numeric($_GET['categoria_id'])) {
            $categoria_id = (int) $_GET['categoria_id'];
        }

        $productos = $this->productoModel->getAll($categoria_id, 1);

        $categorias = $this->categoriaModel->getAll();

        $head = [
            'title' => 'Productos - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1764697413/productos_hero_vqzvya.jpg'
        ];

        $this->view('landing/productos', [
            'head' => $head,
            'productos' => $productos,
            'categorias' => $categorias,
            'categoria_id' => $categoria_id
        ]);
    }
}