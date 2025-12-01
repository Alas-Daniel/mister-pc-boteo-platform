<?php

require_once __DIR__ . '/../models/EquipoModel.php';
require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../core/AdminController.php';

class EquipoController extends AdminController
{
    public function index()
    {
        $model = new EquipoModel($this->db);
        $tipoFiltro = $_GET['tipo_filtro'] ?? null;
        if (!in_array($tipoFiltro, ['hardware', 'software', 'ambos', null])) {
            $tipoFiltro = null;
        }
        $equipos = $model->getAllInProgress($tipoFiltro);

        $this->view('admin/equipos', [
            'equipos' => $equipos,
            'tipoFiltro' => $tipoFiltro,
            'head' => ['title' => 'Equipos en Reparación']
        ]);
    }

    public function history()
    {
        $model = new EquipoModel($this->db);
        $tipoFiltro = $_GET['tipo_filtro'] ?? null;
        if (!in_array($tipoFiltro, ['hardware', 'software', 'ambos', null])) {
            $tipoFiltro = null;
        }
        $equipos = $model->getAllDelivered($tipoFiltro);

        $this->view('admin/equipos/historial', [
            'equipos' => $equipos,
            'head' => ['title' => 'Historial de Equipos']
        ]);
    }

    public function create()
    {
        $clienteModel = new ClienteModel($this->db);
        $usuarioModel = new UsuarioModel($this->db);

        $clientesRaw = $clienteModel->getAll();
        $clientes = array_map(fn($c) => [
            'id' => $c['id'],
            'nombre_completo' => $c['nombre']
        ], $clientesRaw);

        $tecnicos = $usuarioModel->getByRole('tecnico');

        $this->view('admin/equipos/agregar', [
            'clientes' => $clientes,
            'tecnicos' => $tecnicos,
            'head' => ['title' => 'Agregar Equipo']
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/equipos/create');
            exit;
        }

        if (empty($_POST['cliente_id']) || empty($_POST['nombre_equipo']) || empty($_POST['fecha_ingreso'])) {
            header('Location: ' . BASE_URL . 'admin/equipos/create?error=required');
            exit;
        }

        $model = new EquipoModel($this->db);
        $equipoData = [
            'cliente_id' => $_POST['cliente_id'],
            'tecnico_id' => !empty($_POST['tecnico_id']) ? $_POST['tecnico_id'] : null,
            'nombre_equipo' => $_POST['nombre_equipo'],
            'marca' => $_POST['marca'] ?? null,
            'modelo' => $_POST['modelo'] ?? null,
            'numero_serie' => $_POST['numero_serie'] ?? null,
            'estado_equipo' => $_POST['estado_equipo'] ?? 'no iniciado',
            'tipo_problema' => $_POST['tipo_problema'] ?? 'hardware',
            'fecha_ingreso' => $_POST['fecha_ingreso'],
            'fecha_finalizacion' => null
        ];

        // Insertar en EQUIPO
        $stmt = $this->db->prepare("INSERT INTO EQUIPO (
        ClienteId, TecnicoId, NombreEquipo, Marca, Modelo, NumeroSerie,
        EstadoEquipo, TipoProblema, Activo, FechaIngreso, FechaFinalizacion
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)");
        $stmt->execute([
            $equipoData['cliente_id'],
            $equipoData['tecnico_id'],
            $equipoData['nombre_equipo'],
            $equipoData['marca'],
            $equipoData['modelo'],
            $equipoData['numero_serie'],
            $equipoData['estado_equipo'],
            $equipoData['tipo_problema'],
            $equipoData['fecha_ingreso'],
            $equipoData['fecha_finalizacion']
        ]);
        $equipoId = $this->db->lastInsertId();

        $model->createDetail($equipoId, $_POST);

        header('Location: ' . BASE_URL . 'admin/equipos?exito=created');
        exit;
    }

    public function createRepaired()
    {
        $clienteModel = new ClienteModel($this->db);
        $usuarioModel = new UsuarioModel($this->db);

        $clientesRaw = $clienteModel->getAll();
        $clientes = array_map(fn($c) => [
            'id' => $c['id'],
            'nombre_completo' => $c['nombre']
        ], $clientesRaw);
        $tecnicos = $usuarioModel->getByRole('tecnico');

        $this->view('admin/equipos/reparados', [
            'clientes' => $clientes,
            'tecnicos' => $tecnicos,
            'head' => ['title' => 'Registrar Equipo Reparado']
        ]);
    }

    public function storeRepaired()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/equipos/createRepaired');
            exit;
        }

        if (empty($_POST['cliente_id']) || empty($_POST['nombre_equipo']) || empty($_POST['fecha_ingreso'])) {
            header('Location: ' . BASE_URL . 'admin/equipos/createRepaired?error=required');
            exit;
        }

        $model = new EquipoModel($this->db);
        $equipoData = [
            'cliente_id' => $_POST['cliente_id'],
            'tecnico_id' => !empty($_POST['tecnico_id']) ? $_POST['tecnico_id'] : null,
            'nombre_equipo' => $_POST['nombre_equipo'],
            'marca' => $_POST['marca'] ?? null,
            'modelo' => $_POST['modelo'] ?? null,
            'numero_serie' => $_POST['numero_serie'] ?? null,
            'estado_equipo' => 'entregado',
            'tipo_problema' => $_POST['tipo_problema'] ?? 'hardware',
            'fecha_ingreso' => $_POST['fecha_ingreso'],
            'fecha_finalizacion' => !empty($_POST['fecha_finalizacion']) ? $_POST['fecha_finalizacion'] : $_POST['fecha_ingreso']
        ];

        $stmt = $this->db->prepare("INSERT INTO EQUIPO (
        ClienteId, TecnicoId, NombreEquipo, Marca, Modelo, NumeroSerie,
        EstadoEquipo, TipoProblema, Activo, FechaIngreso, FechaFinalizacion
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)");
        $stmt->execute([
            $equipoData['cliente_id'],
            $equipoData['tecnico_id'],
            $equipoData['nombre_equipo'],
            $equipoData['marca'],
            $equipoData['modelo'],
            $equipoData['numero_serie'],
            $equipoData['estado_equipo'],
            $equipoData['tipo_problema'],
            $equipoData['fecha_ingreso'],
            $equipoData['fecha_finalizacion']
        ]);
        $equipoId = $this->db->lastInsertId();

        $model->createDetail($equipoId, $_POST);
        $model->createRepairRecord($equipoId, $_POST);

        header('Location: ' . BASE_URL . 'admin/equipos?exito=repaired');
        exit;
    }

    public function edit($id)
    {
        $model = new EquipoModel($this->db);
        $clienteModel = new ClienteModel($this->db);
        $usuarioModel = new UsuarioModel($this->db);

        $equipo = $model->findById($id);

        $clientesRaw = $clienteModel->getAll();
        $clientes = array_map(fn($c) => [
            'id' => $c['id'],
            'nombre_completo' => $c['nombre']
        ], $clientesRaw);
        $tecnicos = $usuarioModel->getByRole('tecnico');

        if (!$equipo) {
            header('Location: ' . BASE_URL . 'admin/equipos?error=not_found');
            exit;
        }

        $this->view('admin/equipos/editar', [
            'equipo' => $equipo,
            'clientes' => $clientes,
            'tecnicos' => $tecnicos,
            'head' => ['title' => 'Editar Equipo']
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . "admin/equipos/edit/{$id}");
            exit;
        }

        if (empty($_POST['cliente_id']) || empty($_POST['nombre_equipo']) || empty($_POST['fecha_ingreso'])) {
            header('Location: ' . BASE_URL . "admin/equipos/edit/{$id}?error=required");
            exit;
        }

        $model = new EquipoModel($this->db);
        $model->updateBasic($id, $_POST);
        $model->updateDetail($id, $_POST);
        $model->updateRepairRecord($id, $_POST);

        header('Location: ' . BASE_URL . 'admin/equipos?exito=updated');
        exit;
    }

    public function delete($id)
    {
        $model = new EquipoModel($this->db);
        $model->delete($id);
        header('Location: ' . BASE_URL . 'admin/equipos?exito=deleted');
        exit;
    }
}
