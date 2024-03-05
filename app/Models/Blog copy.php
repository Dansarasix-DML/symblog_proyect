<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

    namespace App\Models;

    class Blog extends DBAbstractModel{
        private static $instancia;
        public static function getInstancia(){
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                return self::$instancia = new $miclase;
            }
            return self::$instancia;
        }
        public function __clone(){
            trigger_error("CLONACIÓN NO PERMITIDA", E_USER_ERROR);
        }

        private $id;
        private $title;
        private $author;
        private $blog;
        private $image;
        private $tags;
        private $comments;
        private $created;
        private $updated;
        // private $mensaje;

        
        public function setTitle($title) {
            $this->title = $title;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setAuthor($author) {
            $this->author = $author;
        }

        public function getAuthor() {
            return $this->author;
        }

        public function setBlog($blog) {
            $this->blog = $blog;
        }

        public function getBlog() {
            return $this->blog;
        }

        public function setImage($img) {
            $this->image = $img;
        }

        public function getImage() {
            return $this->image;
        }

        public function setTags($tags) {
            $this->tags = $tags;
        }

        public function getTags() {
            return $this->tags;
        }

        public function setCreated($date) {
            $this->created = date("Y-m-d H:m:s", $date->getTimestamp());
        }

        public function getCreated() {
            return $this->created;
        }

        public function setUpdated($date) {
            $this->updated = $date;
        }

        public function getUpdated() {
            return $this->updated;
        }

        public function getMensaje() {
            return $this->mensaje;
        }

        public function addComment($comment) {
            $this->comments[] = $comment;
        }

        public function get(){}
        public function set(){
            $this->query = "INSERT INTO blog (title, author, blog, image, tags, created, updated)
            VALUES(:title, :author, :blog, :image, :tags, :created, :updated)";
            $this->parametros['title']= $this->getTitle();
            $this->parametros['author']= $this->getAuthor();
            $this->parametros['blog']= $this->getBlog();
            $this->parametros['image']= $this->getImage();
            $this->parametros['tags']= $this->getTags();
            $this->parametros['created']= $this->getCreated();
            $this->parametros['updated']= $this->getUpdated();
            $this->getResultsFromQuery();
            $this->mensaje = "Blog añadido";
            echo $this->mensaje . "\n";
        }
        public function edit(){}
        public function delete(){}
    }