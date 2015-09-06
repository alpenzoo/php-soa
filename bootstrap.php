<?php /*** Bootstrap file ***/

    namespace SOA;
    error_reporting(E_ALL);
    date_default_timezone_set('America/New_York');

    define('ENV', 'development');
    define('PUBLIC_DIR', 'public');

    require_once __DIR__ . '/vendor/autoload.php';
    require_once 'Service_Example.php';



    /**
    * HTTP Request/Response Handlers
    * $request - Request Handler
    * $response - Response Handler
    */
    $request = new \Klein\Klein();
    $response = new \Klein\Response();



    /**
    * App Router
    * $router
    */
    $router = new \Klein\Klein();

    /**** end injector includes ***/

    /**
    * build $routes for the router. This will change depending on
    * the PHP router you choose.
    */

    $forbidden = function() {
        echo 'forbidden';
    };

    $return_asset_files = function ($request, $response) {

            $filetype = $request->paramsNamed()[1];
            $filepath = PUBLIC_DIR . $request->pathname();
            $mimetype = null;

            switch ($filetype) {
                case 'css':
                $mimetype = 'text/css';
                break;

                case 'eot':
                $mimetype = 'application/vnd.ms-fontobject';
                break;

                case 'js':
                $mimetype = 'application/javascript';
                break;

                case 'json':
                $mimetype = 'application/json';
                break;

                case 'less':
                $mimetype = 'text/plain';
                break;

                case 'svg':
                $mimetype = 'image/svg+xml';
                break;

                case 'ttf':
                $mimetype = 'application/octet-stream';
                break;

                case 'woff':
                $mimetype = 'application/font-woff';
                break;

                case 'woff2':
                $mimetype = 'application/font-woff2';
                break;

                case 'md':
                $mimetype = 'text/plain';
                break;

                default:
                $mimetype = 'text/plain';
            }

            if (is_file($filepath)) {
                $response->file($filepath,null, $mimetype);
            }


    };

    $router->onHttpError(function ($code, $router) {
        switch ($code) {
            case 404:
                $router->response()->body(
                    json_encode(["error" => '404 Not Found'])
                );
                break;
            case 405:
                $router->response()->body(
                    json_encode(["error" => '405 Forbidden'])
                );
                break;
            case 500:
                    $router->response()->body(
                        json_encode(["error" => '500 Internal Server Error'])
                );
                break;

            default:
                $router->response()->body(
                    json_encode(["error" => 'Error code: '. $code])
                );
        }
    });

    $routes =  [
        ['GET', '@\.(css|eot|js|json|less|jpg|bmp|png|svg|ttf|woff|woff2|md)$', $return_asset_files],
        //Index Page
         ['OPTIONS', null, $forbidden],
    ];

    if (gettype($routes) == 'array') {

      foreach ($routes as $route) {
              if (gettype($route[2]) == 'object') {
                  header('Content-Type: application/json');
              }
              $router->respond($route[0], $route[1], $route[2]);
      }
    }

    if (is_file('service_api.php')) {

        $custom_routes = include('service_api.php');
        if (gettype($custom_routes) == 'array') {
          foreach ($custom_routes as $route) {
                  $router->respond($route[0], $route[1], $route[2]);
          }
        }
    }

    $router->onError(function ($klein, $msg, $type, \Exception $err){
        $klein->response()->body(
                json_encode(["error" => $err->getTrace()[0]])
        );
        $klein->response()->code(503)->send();
    });

    $router->dispatch();
