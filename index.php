<?php

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';
    
    if ($url == '/')
    {   

        // This is the home page only when no controllers are there to route. (basically no url[0] after trimming.)
        // Initiate the home controller
        // and render the home view

        require_once __DIR__.'/Models/index_model.php';
        require_once __DIR__.'/Controllers/index_controller.php';
        require_once __DIR__.'/Views/index_view.php';

        //model for index (data need to return, later passed to controller as an model object.)
        $indexModel = New IndexModel();
        // cotroller mainly incharge of routing the request from url.
        $indexController = New IndexController($indexModel);
        // takes objects from controller and model to instantiate view as per view code.
        $indexView = New IndexView($indexController, $indexModel);
        // prints default method of index in IndexView class. (default index method for that view class.)
        print $indexView->index();

    }else{


        // This is not home page
        // Initiate the appropriate controller
        // and render the required view

        //The first element should be a controller
        $requestedController = $url[0]; 

        // If a second part is added in the URI, 
        // it should be a method
        $requestedMethods = isset($url[1])? $url[1] :'';

        // The remain parts are considered as 
        // arguments of the method
        $requestedParams = array_slice($url, 2); 

        // Check if controller exists. NB: 
        // You have to do that for the model and the view too
        $ctrlPath = __DIR__.'/Controllers/'.$requestedController.'_controller.php';



        if (file_exists($ctrlPath))
        {

            require_once __DIR__.'/Models/'.$requestedController.'_model.php';
            require_once __DIR__.'/Controllers/'.$requestedController.'_controller.php';
            require_once __DIR__.'/Views/'.$requestedController.'_view.php';

            $modelName      = ucfirst($requestedController).'Model';
            $controllerName = ucfirst($requestedController).'Controller';
            $viewName       = ucfirst($requestedController).'View';

            $controllerObj  = new $controllerName( new $modelName );
            $viewObj        = new $viewName( $controllerObj, new $modelName );


            // If there is a method - Second parameter
            if ($requestedMethods != '')
            {
                // then we call the method via the view
                // this logic basically there for a reason so that if there are no methods for controller \

                // then the params will be routed to view.
                print $viewObj->$requestedMethods($requestedParams);

            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The file - '.$ctrlPath.' - not found');
            //require the 404 controller and initiate it
            //Display its view
        }
    }
