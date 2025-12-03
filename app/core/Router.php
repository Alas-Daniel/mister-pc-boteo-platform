<?php

class Router
{
    public function run()
    {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $segments = explode('/', $url);

        // Aliases para la página pública (landing)
        $aliases = [
            '' => 'HomeController',
            'servicios' => 'ServicesController',
            'productos' => 'ProductsController',
            'nosotros' => 'AboutController',
            'contacto' => 'ContactController',
            'login' => 'LoginController',
        ];

        // Rutas del panel de administración
        $panelRoutes = [
            'admin/panel'             => 'PanelController',
            'admin/equipos'           => 'EquipoController',
            'admin/tecnicos'          => 'TecnicoController',
            'admin/usuarios'          => 'UsuarioController',
            'admin/clientes'          => 'ClienteController',
            'admin/empleados'         => 'EmpleadoController',
            'admin/gestion-productos' => 'ProductoController',
        ];

        // Rutas del panel de técnico
        $tecnicoRoutes = [
            'tecnico/inicio'  => 'TecnicoPanelController',
            'tecnico/equipos' => 'TecnicoEquipoController',
            'tecnico/clientes' => 'TecnicoClienteController',
            'tecnico/productos' => 'TecnicoProductoController'
        ];

        $controllerName = null;
        $method = 'index';
        $params = [];
        $matched = false;

        // Buscar en rutas de administrador
        $urlPath = implode('/', $segments);
        foreach ($panelRoutes as $route => $controller) {
            if ($urlPath === $route) {
                $controllerName = $controller;
                $method = 'index';
                $params = [];
                $matched = true;
                break;
            } elseif (strpos($urlPath, $route . '/') === 0) {
                $controllerName = $controller;
                $remaining = substr($urlPath, strlen($route) + 1);
                $parts = explode('/', $remaining);
                $method = $parts[0] ?? 'index';
                $params = array_slice($parts, 1);
                $matched = true;
                break;
            }
        }

        // Si no coincidió, buscar en rutas de técnico
        if (!$matched) {
            foreach ($tecnicoRoutes as $route => $controller) {
                if ($urlPath === $route) {
                    $controllerName = $controller;
                    $method = 'index';
                    $params = [];
                    $matched = true;
                    break;
                } elseif (strpos($urlPath, $route . '/') === 0) {
                    $controllerName = $controller;
                    $remaining = substr($urlPath, strlen($route) + 1);
                    $parts = explode('/', $remaining);
                    $method = $parts[0] ?? 'index';
                    $params = array_slice($parts, 1);
                    $matched = true;
                    break;
                }
            }
        }

        // Si aún no coincide, tratar como ruta pública
        if (!$matched) {
            $segment = $segments[0] ?? '';
            $controllerName = $aliases[$segment] ?? ucfirst($segment) . 'Controller';
            $method = $segments[1] ?? 'index';
            $params = array_slice($segments, 2);
        }

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            $this->error404("Controlador '$controllerName' no encontrado");
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            $this->error404("Clase '$controllerName' no definida en el archivo");
            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            $this->error404("Método '$method' no encontrado en '$controllerName'");
            return;
        }

        call_user_func_array([$controller, $method], $params);
    }

    private function error404($message)
    {
        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
        exit;
    }
}