<?php

    require_once '../database/db.php';

    class Cours {
        private  $id_cours;
        private  $titre;
        private  $description;
        private  $image;
        private  $contenu;
        private  $video;
        private  $status;
        private  $date;
        private $db;

        public function __construct($db)
        {
            $this->db=$db ;
        }
        

        public function getId(){
            return $this->id_cours;
        }
        public function getTitre(){
            return $this->titre;
        }
        public function getDescription(){
            return $this->description;
        }
        public function getContenu(){
            return $this->contenu;
        }
        public function getVideo(){
            return $this->video;
        }
        public function getCouvertur(){
            return $this->image;
        }
        public function getStatus(){
            return $this->status;
        }
        public function getDate(){
            return $this->date;
        }

        // SETTERS
        public function setTitre($titre){
            $this->titre = $titre;
        }
        public function setDescription($description){
            $this->description = $description;
        }
        public function setContenu($contenu){
            $this->contenu = $contenu;
        }
        public function setVideo($video){
            $this->video = $video;
        }
        public function setImage($image){
            $this->image = $image;
        }
        public function setStatus($status){
            $this->status = $status;
        }
        public function setDate($date){
            $this->date = $date;
        }

        
    }



