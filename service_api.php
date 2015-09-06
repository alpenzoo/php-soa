<?php

    require_once('Service_Example.php');

    return [

        ['GET', '/api/example', function ($request, $response, $serviceProvider, $app) {
            $microService = new SOA\Service_Example();
            return $microService->read(1);
            }
        ],

        ['POST', '/api/example', function ($request, $response, $serviceProvider, $app) {

            /*** http://chriso.github.io/klein.php/docs/classes/Klein.ServiceProvider.html
                let's verify the POST body contains certain fields
            ***/
            try {
                $serviceProvider->validateParam('subject')->notNull();
            } catch (\Klein\Exceptions\ValidationException $err ) {
                return json_encode(["error" => "Subject cannot be empty."]);
            }
            try {
                $serviceProvider->validateParam('body')->notNull();
            } catch (\Klein\Exceptions\ValidationException $err ) {
                return json_encode(["error" => "Body cannot be empty."]);
            }
            /*** end 3rd party validator checks ***/


            $microService = new SOA\Service_Example();
            return $microService->create($request->subject, $request->body);
            }
        ],

    ];
