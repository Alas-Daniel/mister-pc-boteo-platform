<?php

class UsuarioModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = "SELECT 
                    u.UsuarioId AS id,
                    u.Email AS email,
                    u.Rol AS rol,
                    u.Estado AS estado,
                    e.Nombre AS nombre,
                    e.Telefono AS telefono,
                    e.DUI AS dui,
                    c.Cargo AS cargo
                FROM USUARIO u
                JOIN EMPLEADO e ON u.EmpleadoId = e.EmpleadoId
                LEFT JOIN CARGO c ON e.CargoId = c.CargoId
                ORDER BY u.Rol, e.Nombre";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT 
                u.UsuarioId,
                u.Email,
                u.Clave,
                u.Rol,
                u.Estado,
                e.Nombre AS nombre_completo
            FROM USUARIO u
            JOIN EMPLEADO e ON u.EmpleadoId = e.EmpleadoId
            WHERE u.Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT 
                    u.UsuarioId AS id,
                    u.Email AS email,
                    u.Rol AS rol,
                    u.Estado AS estado,
                    u.EmpleadoId AS empleado_id,
                    e.Nombre AS nombre,
                    e.Telefono AS telefono,
                    e.DUI AS dui,
                    e.Direccion AS direccion,
                    c.Cargo AS cargo
                FROM USUARIO u
                JOIN EMPLEADO e ON u.EmpleadoId = e.EmpleadoId
                LEFT JOIN CARGO c ON e.CargoId = c.CargoId
                WHERE u.UsuarioId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $email, $clave = null)
    {
        if ($clave) {
            $sql = "UPDATE USUARIO SET Email = ?, Clave = ? WHERE UsuarioId = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$email, $clave, $id]);
        } else {
            $sql = "UPDATE USUARIO SET Email = ? WHERE UsuarioId = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$email, $id]);
        }
    }

    public function toggleEstado($id, $estado)
    {
        $sql = "UPDATE USUARIO SET Estado = ? WHERE UsuarioId = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$estado, $id]);
    }

    public function getByRole($role)
    {
        $sql = "SELECT 
                u.UsuarioId AS id,
                e.Nombre AS nombre_completo
            FROM USUARIO u
            JOIN EMPLEADO e ON u.EmpleadoId = e.EmpleadoId
            WHERE u.Rol = ? AND u.Estado = 1
            ORDER BY e.Nombre";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
