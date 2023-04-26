<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CatManager;

    class CatManager extends Manager{

        protected $className = "Model\Entities\Category"; // variable qui va prendre ?
        protected $tableName = "category"; // le nom de la table que je vais consulter

        // fonc pour me connecter à la db 
        public function __construct(){ 
            parent::connect(); // par son parent de me prendre la fonc connect 
        }

       // fonc pour afficher les topic par categorie 
       public function catByTopic($id){
        $sql = "SELECT *
        FROM category c
        INNER JOIN topic t ON t.category_id = c.id_category
        WHERE c.id_category = :id";

        $params =['id'=> $id];

        return $this->getMultipleResults(
            DAO::select($sql,$params), 
            $this->className
        );

    }


    }