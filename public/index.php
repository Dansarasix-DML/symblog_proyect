<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
    */

    // require "datos.php";

    require '../bootstrap.php';
    // use App\Core\Router;
    use App\Controllers\IndexController;
    use App\Controllers\BlogController;
    use App\Controllers\UserController;
    use App\Controllers\AuthController;
    use App\Controllers\AdminController;
    use Aura\Router\RouterContainer;


    // echo "<h1>HOLA MUNDO</h1>";

    session_start();

    if (!isset($_SESSION["profile"])) {
        $_SESSION["user"] = "Invitado";
        $_SESSION["profile"] = "Invitado";
    }

    $request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );

    $router = new RouterContainer();

    $map = $router->getMap();

    $map->get("home", "/", ['controller'=>IndexController::Class, 'action'=>"IndexAction"]);
    $map->get("about", "/about", ['controller'=>IndexController::Class, 'action'=>"AboutAction"]);
    $map->get("contact", "/contact", ['controller'=>IndexController::Class, 'action'=>"ContactAction", 'auth' => true]);
    $map->get("newBlog", "/addBlog", ['controller'=>BlogController::Class, 'action'=>"NewAction"]);
    $map->get("showBlog", "/show", ['controller'=>BlogController::Class, 'action'=>"ShowAction"]);
    $map->get("newUser", "/addUser", ['controller'=>UserController::Class, 'action'=>"NewAction", 'auth' => true]);
    $map->get("getLogin", "/login", ['controller'=>AuthController::Class, 'action'=>"GetLoginAction"]);
    $map->get("admin", "/admin", ['controller'=>AdminController::Class, 'action'=>"AdminAction", 'auth' => true]);
    $map->get("logOut", "/logout", ['controller'=>AuthController::Class, 'action'=>"LogOutAction", 'auth' => true]);

    $map->post("addBlog", "/addBlog", ['controller'=>BlogController::Class, 'action'=>"AddAction"]);
    $map->post("addUser", "/addUser", ['controller'=>UserController::Class, 'action'=>"AddAction", 'auth' => true]);
    $map->post("postLogin", "/login", ['controller'=>AuthController::Class, 'action'=>"PostLoginAction"]);
    $map->post("addComment", "/show", ['controller'=>BlogController::Class, 'action'=>"AddCommentAction"]);

    $route = $_GET["route"] ?? "";
    
    // $router = new Router;

    // $router->add([
    //     "name"=>"home",
    //     "path"=>"/^\/$/",
    //     "action"=>array(IndexController::Class, "IndexAction"),
    //     "auth"=>array("Invitado", "Usuario")
    // ]);

    // $router->add([
    //     "name"=>"about",
    //     "path"=>"/^\/about$/",
    //     "action"=>array(IndexController::Class, "AboutAction"),
    //     "auth"=>array("Invitado", "Usuario")
    // ]);

    // $router->add([
    //     "name"=>"contact",
    //     "path"=>"/^\/contact$/",
    //     "action"=>array(IndexController::Class, "ContactAction"),
    //     "auth"=>array("Invitado", "Usuario")
    // ]);

    // $router->add([
    //     "name"=>"addBlog",
    //     "path"=>"/^\/addBlog$/",
    //     "action"=>array(BlogController::Class, "AddAction"),
    //     "auth"=>array("Usuario")
    // ]);

    // $router->add([
    //     "name"=>"showBlog",
    //     "path"=>"/^\/\d+$/",
    //     "action"=>array(BlogController::Class, "ShowAction"),
    //     "auth"=>array("Invitado", "Usuario")
    // ]);

    // $request = $_SERVER['REQUEST_URI'];

    $matcher = $router->getMatcher();

    $route=$matcher->match($request);

    if (!$route) {
        echo "No route";
    } else {
        $handlerData = $route->handler;

        $controllerName = $handlerData["controller"];
        $actionName = $handlerData["action"];
        $needsAuth = $handlerData["auth"] ?? false;
        $sessionProfile = $_SESSION["profile"] ?? "Invitado";

        if ($needsAuth && $sessionProfile === "Invitado") {
            header("Location: /login");
        } else {
            $controller = new $controllerName;
            $response = $controller->$actionName($request);
            foreach ($response->getHeaders() as $name => $values) {
                foreach ($values as $value) {
                    header(sprintf("%s: %s", $name, $value), false);
                }
            }
            echo $response->getBody();
        }
        // $handler = $route->handler;
        // $controller = new $handler[0];
        // $action = $handler[1];
        // $controller->$action($route->attributes);
    }
    

    // if($route) {
    //     if (in_array($_SESSION["profile"], $route["auth"])) {
    //         $controllerName = $route["action"][0];
    //         $actionName = $route["action"][1];
    //         $controller = new $controllerName;
    //         $controller->$actionName($request);
    //     } else {
    //         echo "NO AUTORIZADO";
    //     }
    // } else {
    //     echo "No route";
    // }








