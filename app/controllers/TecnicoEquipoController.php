<?php

require_once __DIR__ . '/../models/EquipoModel.php';
require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../core/TecnicoPanelBase.php';

class TecnicoEquipoController extends TecnicoPanelBase
{
    public function index()
    {
        $model = new EquipoModel($this->db);
        $tecnicoId = (int) $this->usuario['id'];

        $equipos = $model->getByTecnicoId($tecnicoId, ['no iniciado', 'en proceso', 'finalizado']);

        $this->view('tecnico/equipos', [
            'equipos' => $equipos,
            'head' => ['title' => 'Mis Equipos']
        ]);
    }

    public function historial()
    {
        $model = new EquipoModel($this->db);
        $tecnicoId = (int) $this->usuario['id'];

        $equipos = $model->getByTecnicoId($tecnicoId, ['entregado']);

        $this->view('tecnico/equipos/historial', [
            'equipos' => $equipos,
            'head' => ['title' => 'Historial de Reparaciones']
        ]);
    }

    public function create()
    {
        $clienteModel = new ClienteModel($this->db);
        $clientesRaw = $clienteModel->getAll();

        $clientes = array_map(fn($c) => [
            'id' => $c['id'],
            'nombre_completo' => $c['nombre']
        ], $clientesRaw);

        $this->view('tecnico/equipos/crear', [
            'clientes' => $clientes,
            'head' => ['title' => 'Registrar Nuevo Equipo']
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'tecnico/equipos/crear');
            exit;
        }

        if (empty($_POST['cliente_id']) || empty($_POST['nombre_equipo']) || empty($_POST['fecha_ingreso'])) {
            header('Location: ' . BASE_URL . 'tecnico/equipos/crear?error=required');
            exit;
        }

        $tecnicoId = (int) $this->usuario['id'];
        $model = new EquipoModel($this->db);

        $equipoData = [
            'cliente_id' => (int) $_POST['cliente_id'],
            'tecnico_id' => $tecnicoId,
            'nombre_equipo' => $_POST['nombre_equipo'],
            'marca' => $_POST['marca'] ?? null,
            'modelo' => $_POST['modelo'] ?? null,
            'numero_serie' => $_POST['numero_serie'] ?? null,
            'estado_equipo' => 'no iniciado',
            'tipo_problema' => $_POST['tipo_problema'] ?? 'hardware',
            'fecha_ingreso' => $_POST['fecha_ingreso'],
            'fecha_finalizacion' => null
        ];

        $stmt = $this->db->prepare("
            INSERT INTO EQUIPO (
                ClienteId, TecnicoId, NombreEquipo, Marca, Modelo, NumeroSerie,
                EstadoEquipo, TipoProblema, Activo, FechaIngreso, FechaFinalizacion
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)
        ");
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
        $equipoId = (int) $this->db->lastInsertId();

        $model->createDetail($equipoId, $_POST);

        header('Location: ' . BASE_URL . 'tecnico/equipos?exito=created');
        exit;
    }

    public function edit($id)
    {
        $id = (int) $id;
        $tecnicoId = (int) $this->usuario['id'];

        $model = new EquipoModel($this->db);
        $equipo = $model->findByIdAndTecnico($id, $tecnicoId);

        if (!$equipo) {
            header('Location: ' . BASE_URL . 'tecnico/equipos?error=no_access');
            exit;
        }

        $this->view('tecnico/equipos/editar', [
            'equipo' => $equipo,
            'head' => ['title' => 'Actualizar Equipo']
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . "tecnico/equipos/editar/{$id}");
            exit;
        }

        $id = (int) $id;
        $tecnicoId = (int) $this->usuario['id'];

        $model = new EquipoModel($this->db);
        $equipo = $model->findByIdAndTecnico($id, $tecnicoId);

        if (!$equipo) {
            header('Location: ' . BASE_URL . 'tecnico/equipos?error=no_access');
            exit;
        }

        $estado = $_POST['estado_equipo'] ?? $equipo['EstadoEquipo'];
        $fechaFinalizacion = null;

        if (in_array($estado, ['finalizado', 'entregado'])) {
            $fechaFinalizacion = $_POST['fecha_finalizacion'] ?? date('Y-m-d');
        }

        $stmt = $this->db->prepare("
            UPDATE EQUIPO 
            SET EstadoEquipo = ?, FechaFinalizacion = ?
            WHERE EquipoId = ? AND TecnicoId = ?
        ");
        $stmt->execute([$estado, $fechaFinalizacion, $id, $tecnicoId]);

        if (!empty($_POST['descripcion_proceso'])) {
            $model->createRepairRecord($id, $_POST);
        }

        $model->updateDetail($id, $_POST);

        header('Location: ' . BASE_URL . 'tecnico/equipos?exito=updated');
        exit;
    }

    public function reparado()
    {
        $clienteModel = new ClienteModel($this->db);
        $clientesRaw = $clienteModel->getAll();

        $clientes = array_map(fn($c) => [
            'id' => $c['id'],
            'nombre_completo' => $c['nombre']
        ], $clientesRaw);

        $this->view('tecnico/equipos/reparado', [
            'clientes' => $clientes,
            'head' => ['title' => 'Registrar Equipo Reparado']
        ]);
    }

    public function storeReparado()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'tecnico/equipos/reparado');
            exit;
        }

        if (empty($_POST['cliente_id']) || empty($_POST['nombre_equipo']) || empty($_POST['fecha_ingreso'])) {
            header('Location: ' . BASE_URL . 'tecnico/equipos/reparado?error=required');
            exit;
        }

        $tecnicoId = (int) $this->usuario['id'];
        $model = new EquipoModel($this->db);

        $fechaFinalizacion = $_POST['fecha_finalizacion'] ?? $_POST['fecha_ingreso'];

        $equipoData = [
            'cliente_id' => (int) $_POST['cliente_id'],
            'tecnico_id' => $tecnicoId,
            'nombre_equipo' => $_POST['nombre_equipo'],
            'marca' => $_POST['marca'] ?? null,
            'modelo' => $_POST['modelo'] ?? null,
            'numero_serie' => $_POST['numero_serie'] ?? null,
            'estado_equipo' => 'entregado',
            'tipo_problema' => $_POST['tipo_problema'] ?? 'hardware',
            'fecha_ingreso' => $_POST['fecha_ingreso'],
            'fecha_finalizacion' => $fechaFinalizacion
        ];

        $stmt = $this->db->prepare("
        INSERT INTO EQUIPO (
            ClienteId, TecnicoId, NombreEquipo, Marca, Modelo, NumeroSerie,
            EstadoEquipo, TipoProblema, Activo, FechaIngreso, FechaFinalizacion
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)
    ");
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
        $equipoId = (int) $this->db->lastInsertId();

        $model->createDetail($equipoId, $_POST);
        $model->createRepairRecord($equipoId, $_POST);

        header('Location: ' . BASE_URL . 'tecnico/equipos?exito=reparado');
        exit;
    }

    public function download($equipoId)
    {
        // Validar que el técnico tenga permiso sobre este equipo (opcional pero recomendado)
        if (!is_numeric($equipoId)) {
            $this->error404();
        }

        // Aquí puedes validar que el equipo pertenezca al técnico logueado
        // (si ya tienes esa lógica en otro método, reutilízala)

        // Invocar el generador de PDF
        require_once __DIR__ . '/PdfController.php';
        $pdfController = new PdfController();
        $pdfController->equipo($equipoId);
        // Nota: PdfController::equipo() hace exit(), así que nada después se ejecuta
    }

    private function error404()
    {
        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
        exit;
    }
}
