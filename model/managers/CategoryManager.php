<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category"; // variable qui va prendre ?
        protected $tableName = "category"; // le nom de la table que je vais consulter

        // fonc pour me connecter à la db 
        public function __construct(){ 
            parent::connect(); // par son parent de me prendre la fonc connect 
        }

       // fonc pour afficher les topic par categorie 
       public function catByTopic($id){
            $sql = "SELECT t.title, c.id_category,c.nameCategory
            FROM category c
            INNER JOIN topic t ON t.category_id = c.id_category
            WHERE c.id_category = :id";

            return $this->getMultipleResults(
                DAO::select($sql,['id'=> $id],TRUE), 
                $this->className
            );
        }

        public function addCategory(){
            if(isset($_POST['submit'])){
                
                $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               
                if($category){
                    $cat = new CategoryManager(); 
                    $check = $cat->findOneById($cat); 

                        if (!$check){
                           
                            $check->add([
                                "nameCategory" => $category,
                                
                            ]);
                                // header('Location:index.php?ctrl=home')
                            

                }


            }else {
                echo "Le formulaire n'a pas été soumis.";
            }

           
        }


    }
}