<?php

// Modelo para empleado
class EmpleadoModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = "SELECT 
                    e.EmpleadoId AS id,
                    e.Nombre AS nombre,
                    e.Telefono AS telefono,
                    e.DUI AS dui,
                    e.Direccion AS direccion,
                    c.Cargo AS cargo,
                    e.Estado AS estado,
                    CASE 
                        WHEN u.UsuarioId IS NOT NULL THEN 1 
                        ELSE 0 
                    END AS tiene_usuario
                FROM EMPLEADO e
                LEFT JOIN CARGO c ON e.CargoId = c.CargoId
                LEFT JOIN USUARIO u ON e.EmpleadoId = u.EmpleadoId
                ORDER BY e.Nombre";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO EMPLEADO (Nombre, Telefono, DUI, Direccion, CargoId, Estado)
                VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['telefono'] ?? null,
            $data['dui'],
            $data['direccion'] ?? null,
            $data['cargo_id']
        ]);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM EMPLEADO WHERE EmpleadoId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE EMPLEADO 
                SET Nombre = ?, Telefono = ?, DUI = ?, Direccion = ?, CargoId = ?
                WHERE EmpleadoId = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['telefono'] ?? null,
            $data['dui'],
            $data['direccion'] ?? null,
            $data['cargo_id'],
            $id
        ]);
    }

    public function active(int $id)
    {
        $stmt = $this->db->prepare("UPDATE EMPLEADO SET Estado = 1 WHERE EmpleadoId = ?");
        return $stmt->execute([$id]);
    }


    public function delete($id)
    {
        // Soft delete
        $stmt = $this->db->prepare("UPDATE EMPLEADO SET Estado = 0 WHERE EmpleadoId = ?");
        return $stmt->execute([$id]);
    }

    public function getCargos()
    {
        $stmt = $this->db->query("SELECT CargoId AS id, Cargo AS nombre FROM CARGO WHERE 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
