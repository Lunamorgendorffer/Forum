<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post"; // variable qui va prendre ?
        protected $tableName = "post"; // le nom de la table que je vais consulter

        // fonc pour me connecter à la db 
        public function __construct(){ 
            parent::connect(); // par son parent de me prendre la fonc connect 
        }

        // fonc pour recuperer les topics crée
        public function findAllPostUser(){

            $sql = "SELECT p.message, p.messCreationDate, p.user_id
            FROM post p
            INNER JOIN user u ON u.id_user= p.user_id
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function postFromTopicById($id){
            $sql = "SELECT * FROM post p
                    INNER JOIN  topic t ON p.topic_id = t.id_topic
                    WHERE p.topic_id = :id
                    ORDER BY p.messCreationDate ASC
            ";

            $params =['id'=> $id];

            return $this->getMultipleResults(
                    DAO::select($sql,$params), 
                    $this->className
            );


        }
    }