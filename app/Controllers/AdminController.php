<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

     namespace App\Controllers;
     include "../lib/lib.php";
     use Laminas\Diactoros\Response\HTMLResponse;
     use App\Models\Blog;

    class AdminController extends BaseController{


        public function AdminAction() {

            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();

            $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
            $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";

            return $this->renderHTML("admin_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
                "user" => $user,
                "email" => $email
            ]);
        }
    }