<?php

namespace Lucid\Routes;

use Laravel\Lumen\Routing\Router;

class BootstrapRouteFiles
{

    private $router;
    private $routeDirectoryPath;

    public function __construct(Router $router, string $routeDirectoryPath, bool $autoBootstrap = TRUE)
    {
        $this->router = $router;
        $this->routeDirectoryPath = $routeDirectoryPath;
        if ($autoBootstrap) {
            $this->bootstrap();
        }
    }

    public function bootstrap()
    {
        $this->includeFolderFiles($this->routeDirectoryPath, $this->router);
    }

    function includeFolderFiles($path, $router)
    {
        $dirs = scandir($path);
        for ($i = 0; $i < count($dirs); $i++) {
            if ($dirs[$i] != '.' && $dirs[$i] != '..') {
                if (!is_dir($path . DIRECTORY_SEPARATOR . $dirs[$i])) {
                    if ($path != $this->routeDirectoryPath) {
                        require($path . DIRECTORY_SEPARATOR . $dirs[$i]);
                    }
                } else {
                    $dir = $dirs[$i];
                    $router->group(['prefix' => $dir], function () use ($router, $path, $dir) {
                        $this->includeFolderFiles($path . DIRECTORY_SEPARATOR . $dir, $router);
                    });
                }
            }
        }
    }
}
