<?php

    require_once '../database/db.php';

  abstract  class Cours {


        private  $id_cours;
        private  $titre;
        private  $description;
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
     
        public function getVideo(){
            return $this->video;
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
      
        public function setVideo($video){
            $this->video = $video;
        }
       
        public function setStatus($status){
            $this->status = $status;
        }
        public function setDate($date){
            $this->date = $date;
        }

        abstract public function afficherCours();


       abstract public function getIdcours($id_cours);

       abstract function affichercoursetudiants();
    }



