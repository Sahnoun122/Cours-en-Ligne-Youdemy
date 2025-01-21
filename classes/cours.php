<?php

    require_once '../database/db.php';

  abstract  class Cours {

        private  $id_cours;
        private  $titre;
        private  $description;
        private  $video;
        private  $status;
        private  $date;
        private $id_category;
        private $id_tag;
        private $db;

        // public function __construct($db, $id_cours, $titre , $description,$video, $status , $date ,$id_category , $id_tag)
        // {
        //     $this->db=$db ;
        //     $this->id_cours = $id_cours;
        //     $this->titre =$titre;
        //     $this->description= $description;
        //     $this->video=$video;
        //     $this->status= $status;
        //     $this->date=$date;
        //     $this->id_category= $id_category;
        //     $this->id_tag= $id_tag; 
        // }
        

        // public function getId(){
        //     return $this->id_cours;
        // }
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
        public function getIdtag(){
            return $this->id_tag;
        }
        public function getIdcategory(){
            return $this->id_category;
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

        public function setIdtag($id_tag){
            $this->id_tag =$id_tag;
        }
        public function setIdcategory($id_category){
            $this->id_category= $id_category;
        }


        abstract public function afficherCours();


    //    abstract public function getIdcours($id_cours);

    //    abstract function affichercoursetudiants();

    //    abstract  public function afficherstatu();
       


 
    }
