<?php

class ClienteModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = "SELECT 
                    ClienteId AS id,
                    Nombre AS nombre,
                    Telefono AS telefono,
                    Email AS email,
                    Direccion AS direccion
                FROM CLIENTE
                WHERE Estado = 1
                ORDER BY Nombre";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO CLIENTE (Nombre, Telefono, Email, Direccion, Estado)
                VALUES (?, ?, ?, ?, 1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['telefono'] ?? null,
            $data['email'] ?? null,
            $data['direccion'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE CLIENTE 
                SET Nombre = ?,
                    Telefono = ?,
                    Email = ?,
                    Direccion = ?
                WHERE ClienteId = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['nombre'],
            $data['telefono'] ?? null,
            $data['email'] ?? null,
            $data['direccion'] ?? null,
            $id
        ]);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM CLIENTE WHERE ClienteId = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists($email, $excludeId = null)
    {
        $sql = "SELECT ClienteId FROM CLIENTE WHERE Email = ?";
        $params = [$email];
        if ($excludeId) {
            $sql .= " AND ClienteId != ?";
            $params[] = $excludeId;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() !== false;
    }
}