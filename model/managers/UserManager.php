<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User"; // variable qui va prendre ?
        protected $tableName = "user"; // le nom de la table que je vais consulter

        // fonc pour me connecter à la db 
        public function __construct(){ 
            parent::connect(); // par son parent de me prendre la fonc connect 
        }

        public function findOneByPseudo($data){
            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.pseudo = :pseudo
            ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $data], false), 
                $this->className
            );
        }



    }