<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

     namespace App\Controllers;
     include "../lib/lib.php";
     use App\Controllers\BaseController;
     use Laminas\Diactoros\Response\RedirectResponse;
     use App\Models\Blog;
     use App\Models\Usuario;

    class AuthController extends BaseController{

        public function GetLoginAction() {
            
            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();
            
            return $this->renderHTML("login_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
            ]);
            // return new HTMLResponse($this->renderHTML("../views/login_view.php", $data));
        }

        public function PostLoginAction($request) {

            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();
            
            $postData = $request->getParsedBody();
            $response = null;

            $user = Usuario::where("user", $postData["user"])->first();
            if($user){
                if(password_verify($postData["passwd"], $user->password)){
                    $_SESSION["user"] = $user;
                    $_SESSION["profile"] = $user->profile;
                    $response = "OK Credentials";
                    var_dump($_SESSION["profile"]);
                    return new RedirectResponse("/admin");
                } else {
                    echo "poosdata   ".$postData["passwd"];
                    echo "user pass  ".$user->password;
                    $response = "Bad Credentials 222";
                }
            } else{
                $response = "Bad Credentials";
            }
            $data["response"] = $response;
            // return new HTMLResponse($this->renderHTML("../views/login_view.php", $data));
            return $this->renderHTML("login_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
            ]);
        }

        public function LogOutAction() {
            unset($_SESSION["profile"]);
            return new RedirectResponse("/login");
        }
    }