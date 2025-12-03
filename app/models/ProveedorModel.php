<?php

//Modelo para proveedor
class ProveedorModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = "SELECT 
                    ProveedorId AS id,
                    Proveedor AS nombre,
                    Telefono AS telefono,
                    Email AS email,
                    Direccion AS direccion
                FROM proveedor
                WHERE Estado = 1
                ORDER BY Proveedor ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDesactivados()
    {
        $sql = "SELECT 
                    ProveedorId AS id,
                    Proveedor AS nombre,
                    Telefono AS telefono,
                    Email AS email,
                    Direccion AS direccion
                FROM proveedor
                WHERE Estado = 0
                ORDER BY Proveedor ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO proveedor (Proveedor, Telefono, Email, Direccion, Estado)
                VALUES (?, ?, ?, ?, 1)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombre'] ?? '',
            $data['telefono'] ?? null,
            $data['email'] ?? null,
            $data['direccion'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE proveedor 
                SET Proveedor = ?,
                    Telefono = ?,
                    Email = ?,
                    Direccion = ?
                WHERE ProveedorId = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombre'] ?? '',
            $data['telefono'] ?? null,
            $data['email'] ?? null,
            $data['direccion'] ?? null,
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "UPDATE proveedor SET Estado = 0 WHERE ProveedorId = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function restore($id)
    {
        $sql = "UPDATE proveedor SET Estado = 1 WHERE ProveedorId = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM proveedor WHERE ProveedorId = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}