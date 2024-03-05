<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

     namespace App\Controllers;

     use App\Controllers\BaseController;
     use Laminas\Diactoros\Response\RedirectResponse;
     include "../lib/lib.php";
     use App\Models\Blog;
     use App\Models\Usuario;

    class UserController extends BaseController {

        public function AddAction($request) {
            $postData = $request->getParsedBody();

            Usuario::create([
                "user" => $postData["user"],
                'password' => password_hash($postData['passwd'], PASSWORD_BCRYPT),
                'email' => $postData['email']
            ]);
            
            // Redireccionar a una página diferente después de agregar el blog
            $cookie = setcookie("newUser", true, time() + 60,"/");

            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();

            return $this->renderHTML("addUser_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
                "cookie" => $cookie
            ]);
            // header("Location: /addUser");
            // exit();
            // return new RedirectResponse("/addUser");
        }

        public function NewAction() {
            
            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();

            return $this->renderHTML("addUser_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"]
            ]);

            // return new HTMLResponse($this->renderHTML("../views/addUser_view.php", $data));
        }
    }