<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic"; // variable qui va prendre ?
        protected $tableName = "topic"; // le nom de la table que je vais consulter

        // fonc pour me connecter à la db 
        public function __construct(){ 
            parent::connect(); // par son parent de me prendre la fonc connect 
        }

    
        // fonc pour recuperer les topics crée
        public function findAllTopicsUser(){

            $sql = "SELECT t.id_topic, t.title, t.creationdate, t.user_id
            FROM topic t 
            INNER JOIN user u ON u.id_user = t.user_id";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        // fonc pour afficher les topic par categorie 
        public function topicByCategorie(){
            $sql = "SELECT *
            FROM topic 
            WHERE t.category_id = :id ";

            $params =['id'=> $id];

            return $this->getMultipleResults(
                DAO::select($sql,$params), 
                $this->className
            );

        }


    }