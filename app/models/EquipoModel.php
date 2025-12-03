<?php

// Modelo para equipo
class EquipoModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllInProgress($tipoFiltro = null)
    {
        $sql = "SELECT 
                e.EquipoId AS id,
                e.NombreEquipo AS nombre_equipo,
                c.Nombre AS propietario,
                e.Marca AS marca,
                e.FechaIngreso AS fecha_ingreso,
                emp.Nombre AS tecnico,
                e.TipoProblema AS tipo_problema,
                e.EstadoEquipo AS estado_actual
            FROM EQUIPO e
            JOIN CLIENTE c ON e.ClienteId = c.ClienteId
            LEFT JOIN USUARIO u ON e.TecnicoId = u.UsuarioId
            LEFT JOIN EMPLEADO emp ON u.EmpleadoId = emp.EmpleadoId
            WHERE e.Activo = 1 
              AND e.EstadoEquipo != 'entregado'";

        $params = [];

        if ($tipoFiltro && in_array($tipoFiltro, ['hardware', 'software', 'ambos'])) {
            $sql .= " AND e.TipoProblema = ?";
            $params[] = $tipoFiltro;
        }
        $sql .= " ORDER BY e.FechaIngreso DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDelivered($tipoFiltro = null)
    {
        $sql = "SELECT 
                e.EquipoId AS id,
                e.NombreEquipo AS nombre_equipo,
                c.Nombre AS propietario,
                e.Marca AS marca,
                e.FechaIngreso AS fecha_ingreso,
                e.FechaFinalizacion AS fecha_finalizacion,
                emp.Nombre AS tecnico,
                e.TipoProblema AS tipo_problema,
                e.EstadoEquipo AS estado_actual
            FROM EQUIPO e
            JOIN CLIENTE c ON e.ClienteId = c.ClienteId
            LEFT JOIN USUARIO u ON e.TecnicoId = u.UsuarioId
            LEFT JOIN EMPLEADO emp ON u.EmpleadoId = emp.EmpleadoId
            WHERE e.Activo = 1 AND e.EstadoEquipo = 'entregado'";

        $params = [];
        if ($tipoFiltro && in_array($tipoFiltro, ['hardware', 'software', 'ambos'])) {
            $sql .= " AND e.TipoProblema = ?";
            $params[] = $tipoFiltro;
        }
        $sql .= " ORDER BY e.FechaFinalizacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT 
                    e.EquipoId AS id,
                    e.ClienteId AS cliente_id,
                    e.TecnicoId AS tecnico_id,
                    e.NombreEquipo AS nombre_equipo,
                    e.Marca AS marca,
                    e.Modelo AS modelo,
                    e.NumeroSerie AS numero_serie,
                    e.EstadoEquipo AS estado_equipo,
                    e.TipoProblema AS tipo_problema,
                    e.FechaIngreso AS fecha_ingreso,
                    e.FechaFinalizacion AS fecha_finalizacion,
                    c.Nombre AS cliente_nombre,
                    emp.Nombre AS tecnico_nombre,
                    d.SoNombre AS so_nombre,
                    d.SoVersion AS so_version,
                    d.SoArquitectura AS so_arquitectura,
                    d.CpuMarca AS cpu_marca,
                    d.CpuModelo AS cpu_modelo,
                    d.CpuVelocidad AS cpu_velocidad,
                    d.RamTipo AS ram_tipo,
                    d.RamCapacidad AS ram_capacidad,
                    d.RamVelocidad AS ram_velocidad,
                    d.RamSlotsVacios AS ram_slots_vacios,
                    d.AlmacenamientoCap AS almacenamiento_cap,
                    d.AlmacenamientoParticiones AS almacenamiento_particiones,
                    d.PlacaModelo AS placa_modelo,
                    d.Puertos AS puertos,
                    d.InfoExtra AS info_extra,
                    r.DescripcionProceso AS descripcion_proceso,
                    r.DetallesProblema AS detalles_problemas
                FROM EQUIPO e
                JOIN CLIENTE c ON e.ClienteId = c.ClienteId
                LEFT JOIN USUARIO u ON e.TecnicoId = u.UsuarioId
                LEFT JOIN EMPLEADO emp ON u.EmpleadoId = emp.EmpleadoId
                LEFT JOIN DETALLE_EQUIPO d ON e.EquipoId = d.EquipoId
                LEFT JOIN REPARACION r ON e.EquipoId = r.EquipoId
                WHERE e.EquipoId = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createBasic($data)
    {
        $sql = "INSERT INTO EQUIPO (
            ClienteId, TecnicoId, NombreEquipo, Marca, Modelo, NumeroSerie,
            EstadoEquipo, TipoProblema, Activo, FechaIngreso, FechaFinalizacion
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['cliente_id'],
            $data['tecnico_id'] ?? null,
            $data['nombre_equipo'],
            $data['marca'] ?? null,
            $data['modelo'] ?? null,
            $data['numero_serie'] ?? null,
            $data['estado_equipo'] ?? 'no iniciado',
            $data['tipo_problema'] ?? 'hardware',
            $data['fecha_ingreso'],
            !empty($data['fecha_finalizacion']) ? $data['fecha_finalizacion'] : null
        ]);
    }

    public function createDetail($equipoId, $data)
    {
        $sql = "INSERT INTO DETALLE_EQUIPO (
            EquipoId, SoNombre, SoVersion, SoArquitectura,
            CpuMarca, CpuModelo, CpuVelocidad,
            RamTipo, RamCapacidad, RamVelocidad, RamSlotsVacios,
            AlmacenamientoCap, AlmacenamientoParticiones,
            PlacaModelo, Puertos, InfoExtra
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $equipoId,
            $data['so_nombre'] ?? null,
            $data['so_version'] ?? null,
            $data['so_arquitectura'] ?? null,
            $data['cpu_marca'] ?? null,
            $data['cpu_modelo'] ?? null,
            $data['cpu_velocidad'] ?? null,
            $data['ram_tipo'] ?? null,
            $data['ram_capacidad'] ?? null,
            $data['ram_velocidad'] ?? null,
            !empty($data['ram_slots_vacios']) ? (int)$data['ram_slots_vacios'] : null,
            $data['almacenamiento_cap'] ?? null,
            $data['almacenamiento_particiones'] ?? null,
            $data['placa_modelo'] ?? null,
            $data['puertos'] ?? null,
            $data['info_extra'] ?? null
        ]);
    }

    public function createRepairRecord($equipoId, $data)
    {
        if (empty($data['descripcion_proceso'])) return true;

        $sql = "INSERT INTO REPARACION (EquipoId, DescripcionProceso, DetallesProblema)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $equipoId,
            $data['descripcion_proceso'] ?? '',
            $data['detalles_problemas'] ?? null
        ]);
    }

    public function updateBasic($id, $data)
    {
        $sql = "UPDATE EQUIPO SET
            ClienteId = ?,
            TecnicoId = ?,
            NombreEquipo = ?,
            Marca = ?,
            Modelo = ?,
            NumeroSerie = ?,
            EstadoEquipo = ?,
            TipoProblema = ?,
            FechaIngreso = ?,
            FechaFinalizacion = ?
            WHERE EquipoId = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['cliente_id'],
            $data['tecnico_id'] ?? null,
            $data['nombre_equipo'],
            $data['marca'] ?? null,
            $data['modelo'] ?? null,
            $data['numero_serie'] ?? null,
            $data['estado_equipo'] ?? 'no iniciado',
            $data['tipo_problema'] ?? 'hardware',
            $data['fecha_ingreso'],
            !empty($data['fecha_finalizacion']) ? $data['fecha_finalizacion'] : null,
            $id
        ]);
    }

    public function updateDetail($equipoId, $data)
    {
        $check = $this->db->prepare("SELECT DetalleEquipoId FROM DETALLE_EQUIPO WHERE EquipoId = ?");
        $check->execute([$equipoId]);
        $exists = $check->fetch();

        if ($exists) {
            $sql = "UPDATE DETALLE_EQUIPO SET
                SoNombre = ?, SoVersion = ?, SoArquitectura = ?,
                CpuMarca = ?, CpuModelo = ?, CpuVelocidad = ?,
                RamTipo = ?, RamCapacidad = ?, RamVelocidad = ?, RamSlotsVacios = ?,
                AlmacenamientoCap = ?, AlmacenamientoParticiones = ?,
                PlacaModelo = ?, Puertos = ?, InfoExtra = ?
                WHERE EquipoId = ?";
            $params = [
                $data['so_nombre'] ?? null,
                $data['so_version'] ?? null,
                $data['so_arquitectura'] ?? null,
                $data['cpu_marca'] ?? null,
                $data['cpu_modelo'] ?? null,
                $data['cpu_velocidad'] ?? null,
                $data['ram_tipo'] ?? null,
                $data['ram_capacidad'] ?? null,
                $data['ram_velocidad'] ?? null,
                !empty($data['ram_slots_vacios']) ? (int)$data['ram_slots_vacios'] : null,
                $data['almacenamiento_cap'] ?? null,
                $data['almacenamiento_particiones'] ?? null,
                $data['placa_modelo'] ?? null,
                $data['puertos'] ?? null,
                $data['info_extra'] ?? null,
                $equipoId
            ];
        } else {
            return $this->createDetail($equipoId, $data);
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function updateRepairRecord($equipoId, $data)
    {
        $check = $this->db->prepare("SELECT ReparacionId FROM REPARACION WHERE EquipoId = ?");
        $check->execute([$equipoId]);
        $exists = $check->fetch();

        if ($exists) {
            $sql = "UPDATE REPARACION SET
                DescripcionProceso = ?,
                DetallesProblema = ?
                WHERE EquipoId = ?";
            $params = [$data['descripcion_proceso'] ?? '', $data['detalles_problemas'] ?? null, $equipoId];
        } else {
            return $this->createRepairRecord($equipoId, $data);
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "UPDATE EQUIPO SET Activo = 0 WHERE EquipoId = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    // NUEVO: Obtener equipos asignados a un técnico específico (con filtro de estados)
    public function getByTecnicoId(int $tecnicoId, array $estados = [])
    {
        $sql = "SELECT 
                    e.EquipoId AS id,
                    e.NombreEquipo AS nombre_equipo,
                    c.Nombre AS propietario,
                    e.Marca AS marca,
                    e.FechaIngreso AS fecha_ingreso,
                    e.TipoProblema AS tipo_problema,
                    e.EstadoEquipo AS estado_actual,
                    emp.Nombre AS tecnico_nombre
                FROM EQUIPO e
                JOIN CLIENTE c ON e.ClienteId = c.ClienteId
                LEFT JOIN USUARIO u ON e.TecnicoId = u.UsuarioId
                LEFT JOIN EMPLEADO emp ON u.EmpleadoId = emp.EmpleadoId
                WHERE e.TecnicoId = ? AND e.Activo = 1";

        $params = [$tecnicoId];

        if (!empty($estados)) {
            $placeholders = str_repeat('?,', count($estados) - 1) . '?';
            $sql .= " AND e.EstadoEquipo IN ($placeholders)";
            $params = array_merge($params, $estados);
        }

        $sql .= " ORDER BY e.FechaIngreso DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByIdAndTecnico(int $id, int $tecnicoId)
    {
        $sql = "SELECT 
                    e.EquipoId AS id,
                    e.ClienteId AS cliente_id,
                    e.TecnicoId AS tecnico_id,
                    e.NombreEquipo AS nombre_equipo,
                    e.Marca AS marca,
                    e.Modelo AS modelo,
                    e.NumeroSerie AS numero_serie,
                    e.EstadoEquipo AS estado_equipo,
                    e.TipoProblema AS tipo_problema,
                    e.FechaIngreso AS fecha_ingreso,
                    e.FechaFinalizacion AS fecha_finalizacion,
                    c.Nombre AS cliente_nombre,
                    c.Telefono AS cliente_telefono,
                    emp.Nombre AS tecnico_nombre,
                    d.SoNombre AS so_nombre,
                    d.SoVersion AS so_version,
                    d.SoArquitectura AS so_arquitectura,
                    d.CpuMarca AS cpu_marca,
                    d.CpuModelo AS cpu_modelo,
                    d.CpuVelocidad AS cpu_velocidad,
                    d.RamTipo AS ram_tipo,
                    d.RamCapacidad AS ram_capacidad,
                    d.RamVelocidad AS ram_velocidad,
                    d.RamSlotsVacios AS ram_slots_vacios,
                    d.AlmacenamientoCap AS almacenamiento_cap,
                    d.AlmacenamientoParticiones AS almacenamiento_particiones,
                    d.PlacaModelo AS placa_modelo,
                    d.Puertos AS puertos,
                    d.InfoExtra AS info_extra,
                    r.DescripcionProceso AS descripcion_proceso,
                    r.DetallesProblema AS detalles_problemas
                FROM EQUIPO e
                JOIN CLIENTE c ON e.ClienteId = c.ClienteId
                LEFT JOIN USUARIO u ON e.TecnicoId = u.UsuarioId
                LEFT JOIN EMPLEADO emp ON u.EmpleadoId = emp.EmpleadoId
                LEFT JOIN DETALLE_EQUIPO d ON e.EquipoId = d.EquipoId
                LEFT JOIN REPARACION r ON e.EquipoId = r.EquipoId
                WHERE e.EquipoId = ? AND e.TecnicoId = ? AND e.Activo = 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id, $tecnicoId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}