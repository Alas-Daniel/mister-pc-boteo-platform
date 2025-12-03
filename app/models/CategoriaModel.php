<?php

// Modelo para categorias
class CategoriaModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT 
                                        CategoriaId AS id, 
                                        Categoria AS nombre 
                                    FROM categoria_producto 
                                    WHERE Estado = 1 
                                    ORDER BY Categoria ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDesactivadas()
    {
        $stmt = $this->db->prepare("SELECT 
                                        CategoriaId AS id, 
                                        Categoria AS nombre 
                                    FROM categoria_producto 
                                    WHERE Estado = 0 
                                    ORDER BY Categoria ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nombre)
    {
        $stmt = $this->db->prepare("INSERT INTO categoria_producto (Categoria, Estado) VALUES (?, 1)");
        $stmt->execute([$nombre]);
    }

    public function update($id, $nombre)
    {
        $stmt = $this->db->prepare("UPDATE categoria_producto SET Categoria = ? WHERE CategoriaId = ?");
        $stmt->execute([$nombre, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("UPDATE categoria_producto SET Estado = 0 WHERE CategoriaId = ?");
        $stmt->execute([$id]);
    }

    public function restore($id)
    {
        $stmt = $this->db->prepare("UPDATE categoria_producto SET Estado = 1 WHERE CategoriaId = ?");
        $stmt->execute([$id]);
    }
}