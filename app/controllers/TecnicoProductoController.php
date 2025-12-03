<?php

require_once __DIR__ . '/../models/ProductoModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../core/TecnicoPanelBase.php';

//Gestion de productos desde tecnico
class TecnicoProductoController extends TecnicoPanelBase
{
    private $productoModel;
    private $categoriaModel;

    public function __construct()
    {
        parent::__construct();
        $this->productoModel = new ProductoModel($this->db);
        $this->categoriaModel = new CategoriaModel($this->db);
    }

    public function index()
    {
        $categoria_id = $_GET['categoria_filtro'] ?? null;
        
        if ($categoria_id) {
            $categoria_existe = false;
            $categorias_todas = $this->categoriaModel->getAll();
            foreach ($categorias_todas as $cat) {
                if ($cat['id'] == $categoria_id) {
                    $categoria_existe = true;
                    break;
                }
            }
            if (!$categoria_existe) {
                $categoria_id = null;
            }
        }

        $productos = $this->productoModel->getAll($categoria_id, 1);
        $categorias = $this->categoriaModel->getAll();

        $this->view('tecnico/productos', [
            'productos' => $productos,
            'categorias' => $categorias,
            'categoria_id' => $categoria_id,
            'head' => ['title' => 'Productos y Repuestos Disponibles']
        ]);
    }
}