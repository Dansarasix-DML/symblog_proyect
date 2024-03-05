<?php

    /**
     * @author Daniel Marín López
     * @version 0.01a
     * 
     */

    namespace App\Models;

    class Comment extends DBAbstractModel{
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
        private $blog_id;
        private $user;
        private $comment;
        private $approved;
        private $created;
        private $updated;

        public function setBlog($blog) {
            $this->query = "SELECT id
            FROM blog WHERE title = :title";
            $this->parametros["title"] = $blog->getTitle();
            $this->getResultsFromQuery();
            // var_dump($this->rows);
            // exit;
            $this->blog_id = $this->rows[0]["id"];
        }

        public function getBlog() {
            return $this->blog_id;
        }

        public function setUser($user) {
            $this->user = $user;
        }

        public function getUser() {
            return $this->user;
        }

        public function setComment($comment) {
            $this->comment = $comment;
        }

        public function getComment() {
            return $this->comment;
        }

        public function setApproved($app = 1) {
            $this->approved = $app;
        }

        public function getApproved() {
            return $this->approved;
        }

        public function setCreated($date = new \DateTime()) {
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
        
        public function get(){}
        public function set(){
            
            $this->setCreated();
            $this->setUpdated($this->getCreated());
            $this->setApproved();
            
            $this->query = "INSERT INTO comment (blog_id, user, comment, approved, created, updated)
            VALUES(:blog_id, :user, :comment, :approved, :created, :updated)";

            $this->parametros['blog_id']= $this->getBlog();
            $this->parametros['user']= $this->getUser();
            $this->parametros['comment']= $this->getComment();
            $this->parametros['approved']= $this->getApproved();
            $this->parametros['created']= $this->getCreated();
            $this->parametros['updated']= $this->getUpdated();

            $this->getResultsFromQuery();
            $this->mensaje = "Comentario añadido";
            echo $this->mensaje . "\n";
        }
        public function edit(){}
        public function delete(){}
    }