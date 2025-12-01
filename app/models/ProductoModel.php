<?php

class ProductoModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll($categoria_id = null, $estado = 1)
    {
        $sql = "SELECT 
                    p.ProductoId AS id,
                    p.Producto AS nombre,
                    p.Marca AS marca,
                    p.Precio AS precio,
                    p.Stock AS stock,
                    p.TipoPresentacion AS tipo_presentacion,
                    p.UnidadesPresentacion AS unidades_por_presentacion,
                    p.Imagen AS imagen,
                    p.Destacado AS destacado,
                    p.CategoriaId AS categoria_id,
                    p.ProveedorId AS proveedor_id,
                    c.Categoria AS categoria_nombre,
                    pr.Proveedor AS proveedor_nombre
                FROM producto p
                JOIN categoria_producto c ON p.CategoriaId = c.CategoriaId
                JOIN proveedor pr ON p.ProveedorId = pr.ProveedorId
                WHERE p.Estado = ?";

        $params = [$estado];

        if ($categoria_id) {
            $sql .= " AND p.CategoriaId = ?";
            $params[] = $categoria_id;
        }

        $sql .= " ORDER BY p.ProductoId DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDestacados()
    {
        $sql = "SELECT 
                    p.ProductoId AS id,
                    p.Producto AS nombre,
                    p.Marca AS marca,
                    p.Precio AS precio,
                    p.Imagen AS imagen,
                    c.Categoria AS categoria_nombre
                FROM producto p
                JOIN categoria_producto c ON p.CategoriaId = c.CategoriaId
                WHERE p.Estado = 1 AND p.Destacado = 1
                ORDER BY p.ProductoId DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO producto
                (Producto, Marca, Precio, CategoriaId, ProveedorId, Stock,
                 TipoPresentacion, UnidadesPresentacion, Imagen, Estado, Destacado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['Producto'],
            $data['Marca'] ?? null,
            $data['Precio'],
            $data['CategoriaId'],
            $data['ProveedorId'],
            $data['Stock'],
            $data['TipoPresentacion'],
            !empty($data['UnidadesPresentacion']) ? $data['UnidadesPresentacion'] : null,
            $data['Imagen']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE producto SET
                    Producto = ?,
                    Marca = ?,
                    Precio = ?,
                    CategoriaId = ?,
                    ProveedorId = ?,
                    Stock = ?,
                    TipoPresentacion = ?,
                    UnidadesPresentacion = ?,
                    Imagen = ?
                WHERE ProductoId = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['Producto'],
            $data['Marca'] ?? null,
            $data['Precio'],
            $data['CategoriaId'],
            $data['ProveedorId'],
            $data['Stock'],
            $data['TipoPresentacion'],
            !empty($data['UnidadesPresentacion']) ? $data['UnidadesPresentacion'] : null,
            $data['Imagen'],
            $id
        ]);
    }

    public function softDelete($id)
    {
        $stmt = $this->db->prepare("UPDATE producto SET Estado = 0 WHERE ProductoId = ?");
        return $stmt->execute([$id]);
    }

    public function activar($id)
    {
        $stmt = $this->db->prepare("UPDATE producto SET Estado = 1 WHERE ProductoId = ?");
        return $stmt->execute([$id]);
    }

    public function setDestacado($id, $estado)
    {
        $stmt = $this->db->prepare("UPDATE producto SET Destacado = ? WHERE ProductoId = ?");
        return $stmt->execute([(int)$estado, $id]);
    }

    public function getById($id)
    {
        $sql = "SELECT 
                    p.*,
                    c.Categoria AS categoria_nombre,
                    pr.Proveedor AS proveedor_nombre
                FROM producto p
                JOIN categoria_producto c ON p.CategoriaId = c.CategoriaId
                JOIN proveedor pr ON p.ProveedorId = pr.ProveedorId
                WHERE p.ProductoId = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}