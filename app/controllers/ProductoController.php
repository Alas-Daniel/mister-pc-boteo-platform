<?php

require_once __DIR__ . '/../models/ProductoModel.php';
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../models/ProveedorModel.php';

//Gestion de productos en admin
class ProductoController extends Controller
{
    private $db;
    private $productoModel;
    private $categoriaModel;
    private $proveedorModel;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
        $this->db = Database::getConnection();
        $this->productoModel = new ProductoModel($this->db);
        $this->categoriaModel = new CategoriaModel($this->db);
        $this->proveedorModel = new ProveedorModel($this->db);
    }

    public function index()
    {
        $this->handleActions();

        $categoria_id = $_GET['categoria_filtro'] ?? null;
        $productos = $this->productoModel->getAll($categoria_id, 1);
        $productos_desactivados = $this->productoModel->getAll(null, 0);
        $categorias = $this->categoriaModel->getAll();
        $proveedores = $this->proveedorModel->getAll();

        return $this->view('admin/productos', [
            'productos' => $productos,
            'productos_desactivados' => $productos_desactivados,
            'categorias' => $categorias,
            'proveedores' => $proveedores,
            'categoria_id' => $categoria_id,
            'head' => ['title' => 'Gestión de Productos']
        ]);
    }

    private function handleActions()
    {
        if (isset($_POST['agregar_producto'])) {
            $this->crearProducto();
        } elseif (isset($_POST['editar_producto'])) {
            $this->editarProducto();
        } elseif (isset($_GET['eliminar_producto'])) {
            $this->eliminarProducto((int)$_GET['eliminar_producto']);
        } elseif (isset($_GET['activar_producto'])) {
            $this->activarProducto((int)$_GET['activar_producto']);
        } elseif (isset($_GET['destacar_producto'])) {
            $this->toggleDestacado((int)$_GET['destacar_producto'], (int)$_GET['estado']);
        } elseif (isset($_POST['agregar_categoria'])) {
            $this->crearCategoria();
        } elseif (isset($_POST['editar_categoria'])) {
            $this->editarCategoria();
        } elseif (isset($_GET['eliminar_categoria'])) {
            $this->eliminarCategoria((int)$_GET['eliminar_categoria']);
        } elseif (isset($_POST['agregar_proveedor'])) {
            $this->crearProveedor();
        }
    }

    // === PRODUCTOS ===
    private function crearProducto()
    {
        $data = [
            'Producto' => trim($_POST['nombre_producto'] ?? ''),
            'Marca' => trim($_POST['marca_producto'] ?? ''),
            'Precio' => (float)($_POST['precio_producto'] ?? 0),
            'CategoriaId' => (int)($_POST['categoria_id'] ?? 0),
            'ProveedorId' => (int)($_POST['proveedor_id'] ?? 0),
            'Stock' => (int)($_POST['stock_producto'] ?? 0),
            'TipoPresentacion' => $_POST['tipo_presentacion'] ?? 'unidad',
            'UnidadesPresentacion' => !empty($_POST['unidades_por_presentacion']) ? (int)$_POST['unidades_por_presentacion'] : null,
            'Imagen' => trim($_POST['imagen_producto'] ?? '')
        ];

        if (empty($data['Producto']) || $data['Precio'] <= 0 || $data['CategoriaId'] <= 0 || $data['ProveedorId'] <= 0) {
            $_SESSION['error'] = 'Datos incompletos o inválidos.';
        } else {
            try {
                $this->productoModel->create($data);
                $_SESSION['success'] = 'Producto agregado exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al agregar el producto.';
            }
        }
        $this->redirectWithParams();
    }

    private function editarProducto()
    {
        $id = (int)($_POST['id_producto'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de producto inválido.';
            $this->redirectWithParams();
            return;
        }

        $data = [
            'Producto' => trim($_POST['nombre_producto'] ?? ''),
            'Marca' => trim($_POST['marca_producto'] ?? ''),
            'Precio' => (float)($_POST['precio_producto'] ?? 0),
            'CategoriaId' => (int)($_POST['categoria_id'] ?? 0),
            'ProveedorId' => (int)($_POST['proveedor_id'] ?? 0),
            'Stock' => (int)($_POST['stock_producto'] ?? 0),
            'TipoPresentacion' => $_POST['tipo_presentacion'] ?? 'unidad',
            'UnidadesPresentacion' => !empty($_POST['unidades_por_presentacion']) ? (int)$_POST['unidades_por_presentacion'] : null,
            'Imagen' => trim($_POST['imagen_producto'] ?? '')
        ];

        if (empty($data['Producto']) || $data['Precio'] <= 0 || $data['CategoriaId'] <= 0 || $data['ProveedorId'] <= 0) {
            $_SESSION['error'] = 'Datos incompletos o inválidos.';
        } else {
            try {
                $this->productoModel->update($id, $data);
                $_SESSION['success'] = 'Producto actualizado exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al actualizar el producto.';
            }
        }
        $this->redirectWithParams();
    }

    private function eliminarProducto($id)
    {
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de producto inválido.';
        } else {
            try {
                $this->productoModel->softDelete($id);
                $_SESSION['success'] = 'Producto desactivado exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al desactivar el producto.';
            }
        }
        $this->redirectWithParams();
    }

    private function activarProducto($id)
    {
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de producto inválido.';
        } else {
            try {
                $this->productoModel->activar($id);
                $_SESSION['success'] = 'Producto reactivado exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al reactivar el producto.';
            }
        }
        $this->redirectWithParams();
    }

    private function toggleDestacado($id, $estado)
    {
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de producto inválido.';
        } else {
            try {
                $this->productoModel->setDestacado($id, $estado);
                $_SESSION['success'] = 'Producto actualizado exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al actualizar el producto.';
            }
        }
        $this->redirectWithParams();
    }

    // === CATEGORÍAS ===
    private function crearCategoria()
    {
        $nombre = trim($_POST['nombre_categoria'] ?? '');
        if (empty($nombre)) {
            $_SESSION['error'] = 'El nombre de la categoría es obligatorio.';
        } else {
            try {
                $this->categoriaModel->insert($nombre);
                $_SESSION['success'] = 'Categoría agregada exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al agregar la categoría.';
            }
        }
        $this->redirectWithParams();
    }

    private function editarCategoria()
    {
        $id = (int)($_POST['id_categoria'] ?? 0);
        $nombre = trim($_POST['nombre_categoria_edit'] ?? '');
        if ($id <= 0 || empty($nombre)) {
            $_SESSION['error'] = 'Datos de categoría inválidos.';
        } else {
            try {
                $this->categoriaModel->update($id, $nombre);
                $_SESSION['success'] = 'Categoría actualizada exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al actualizar la categoría.';
            }
        }
        $this->redirectWithParams();
    }

    private function eliminarCategoria($id)
    {
        if ($id <= 0) {
            $_SESSION['error'] = 'ID de categoría inválido.';
        } else {
            try {
                $this->categoriaModel->delete($id);
                $_SESSION['success'] = 'Categoría eliminada exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al eliminar la categoría.';
            }
        }
        $this->redirectWithParams();
    }

    // === PROVEEDORES ===
    private function crearProveedor()
    {
        $data = [
            'nombre' => trim($_POST['nombre_proveedor'] ?? ''),
            'telefono' => trim($_POST['telefono_proveedor'] ?? ''),
            'email' => trim($_POST['email_proveedor'] ?? ''),
            'direccion' => trim($_POST['direccion_proveedor'] ?? '')
        ];

        if (empty($data['nombre'])) {
            $_SESSION['error'] = 'El nombre del proveedor es obligatorio.';
        } else {
            try {
                $this->proveedorModel->create($data);
                $_SESSION['success'] = 'Proveedor agregado exitosamente.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al agregar el proveedor.';
            }
        }
        $this->redirectWithParams();
    }

    private function redirectWithParams()
    {
        $params = $_GET;
        unset($params['eliminar_producto'], $params['activar_producto'], $params['destacar_producto'], $params['estado'], $params['eliminar_categoria']);
        $query = http_build_query($params);
        $url = BASE_URL . 'admin/productos';
        if ($query) {
            $url .= '?' . $query;
        }
        header('Location: ' . $url);
        exit;
    }
}