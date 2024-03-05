<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

     require '../../bootstrap.php';
     include "../../lib/lib.php";
     use App\Models\Blog;
     use App\Models\Comment;
     use App\Models\Usuario;
     
     // $blog = Blog::Create([
     //     'title' => "Almeja2 Khan",
     //     'author' => "ahmed.khan@lbs.com",
     //     'blog' => "skjfn",
     //     'image' => "jght.png",
     //     'tags' => "php",
     // ]);

    // $usuario = Usuario::Create([
    //     "user" => "Daniel",
    //     "password" => "admin",
    //     "email" => "example2@gmail.com"
    // ]);

    // Comment::create([
    //     'blog_id' => 17,
    //     'author' => "Laura",
    //     'comment' => "Prueba",
    //     'approved' => 1
    // ]);

    $user = Usuario::where("user", "Dogday")->first();
     
    var_dump($user->profile);

     // print_r($blog->comment()->create([
     //     'user' => "Working with Eloquent Without PHP",
     //     'comment' => "eloquent",
     //     'approved' => 1
     //     ]));
     
     // print_r(Blog::all('author')); // todos
     // foreach (Blog::find(34) as $key => $value) {
     //     // var_dump($value->comment());
     //     foreach ($value->comment as $key2 => $value2) {
     //         var_dump($value2);
     //     }
     // }

    //Saca los blogs y sus comentarios
    $pepe = Blog::all();
    foreach ($pepe as $value) {
        echo "<br/>Blog: ".$value->title."<br/>";
        $value->getComments();
    }
    // var_dump(getAllTags());
    foreach (getAllTags() as $tag) {
        $count = 0;
        echo $tag." ";
        foreach ($pepe as $blog) {
            if (in_array($tag, explode(", ", $blog->tags))) {
                $count++;
            }
        }
        echo $count."<br/>";
    }
    //Busca blog y saca sus comentarios
    //  foreach (Blog::find(19)->comment as $value) {
    //     var_dump($value->comment);
    //  }
    //  foreach (Blog::find(19) as $key => $blog) {
    //     // var_dump($blog->comment);
    //      foreach ($blog->comment as $key2 => $comment) {
    //          var_dump($comment->comment);
    //      }
    //  }
     // print_r($pepe->user); // busca por id