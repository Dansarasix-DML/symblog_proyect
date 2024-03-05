<?php
    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

    namespace App\Controllers;

    use App\Controllers\BaseController;
    include "../lib/lib.php";
    use App\Models\Blog;


    class IndexController extends BaseController {        

        public function IndexAction() {

            $data["blogs"] = Blog::orderBy('created', 'desc')->get();

            $data["allComments"] = array_reverse(array_slice(getAllComments($data["blogs"]), -5));

            $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
            $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
            $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

            $data["tags"] = printTags();

            // $this->renderHTML("../views/index_view.php", $data);
            // return new HTMLResponse($this->renderHTML("../views/index_view.php", $data));
            return $this->renderHTML("index_view.twig", [
                "blogs" => $data["blogs"],
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
                "profile" => $profile,
                "user" => $user,
                "email" => $email
            ]);
        }

        public function AboutAction() {
            
            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();

            $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
            $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
            $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

            // return new HTMLResponse($this->renderHTML("../views/about_view.php", $data));

            return $this->renderHTML("about_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
                "profile" => $profile,
                "user" => $user,
                "email" => $email
            ]);
        }

        public function ContactAction(){
            $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
            $data["tags"] = printTags();

            $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
            $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
            $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

            return $this->renderHTML("contact_view.twig", [
                "allComments" => $data["allComments"],
                "tags" => $data["tags"],
                "profile" => $profile,
                "user" => $user,
                "email" => $email
            ]);
        }


    }