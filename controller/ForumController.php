<?php

    namespace Controller;

    use App\Session;
    use App\DAO;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    use Model\Managers\CategoryManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
        
            return [
                "view" => VIEW_DIR."forum/topics/listTopics.php", // renvoie la vue listtopics
                "data" => [ //data prend la valeur d'un tableau qui contient topics 
                    "topics" => $topicManager->findAllTopicsUser(), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                ], 

            ];

        }

        public function detailTopic ($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            return [
                "view" => VIEW_DIR."forum/topics/detailTopic.php", // 
                "data" => [ //data prend la valeur d'un tableau qui contient topics 
                    "topic" => $topicManager->findOneById($id),
                    "messages" => $postManager-> postFromTopicById($id) 
                ]
            ];

        }

        public function viewAddTopic (){
            $topicManager = new TopicManager();
           
            return [
                "view" => VIEW_DIR."forum/ajouterTopic.php",
                "data" => [
                    "categories" => $topicManager->findAll()
                ]
            ];

        }

        public function addTopic (){
            if(!empty($_POST)){
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user =  Session::getUser()->getId();
                
                // $category = isset($_GET['id']) ? $_GET['id'] : '';
                var_dump($category);

                if($title){
                    $topicManager = new TopicManager(); 

                    if ($topicManager->add([
                        "title" => $title,
                        "user_id" => $user,
                        "category_id" => $category
                            
                    ])){
                        
                        header('Location:index.php?ctrl=home');

                    }


                }
                

            }

        }

    

        
        // Cette méthode renvoie la vue et les données nécessaires pour afficher la liste des utilisateurs
        public function viewUser(){
            
            $userManager = new UserManager(); // On instancie un objet de la classe UserManager pour récupérer la liste des utilisateurs

            return[ // On retourne un tableau contenant le chemin de la vue à afficher et les données à transmettre à la vue
                "view" => VIEW_DIR."forum/listUsers.php", 
                "data" => [ 
                    "users" => $userManager->findAll(), // La méthode findAll() de la classe UserManager renvoie la liste des utilisateurs
                ]
            ];
        }

        // Cette méthode renvoie la vue et les données nécessaires pour afficher la liste des messages
        public function viewPost(){
            $postManager = new PostManager(); // On instancie un objet de la classe PostManager pour récupérer la liste des messages

            return [
                "view" => VIEW_DIR."forum/listPosts.php", // On retourne un tableau contenant le chemin de la vue à afficher et les données à transmettre à la vue
                "data" => [ //data prend la valeur d'un tableau qui contient Post
                    "post" => $postManager->findAllPostUser(), // La méthode findAllPost() de la classe PostManager renvoie la liste des messages
                ]

            ];

        }

        public function viewAddPost (){
            $postManager = new PostManager();
           
            return [
                "view" => VIEW_DIR."forum/topics/detailTopic.phpp",
                "data" => [
                    "post" => $postManager->findAll()
                ]
            ];

        }

        public function addPostByTopic (){
            if(!empty($_POST)){
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user =  Session::getUser()->getId();
                

                if($title&&$post){
                    $topicManager = new TopicManager(); 

                    $topicManager->add([
                        "title" => $title,
                        "user_id" => $user,
                        "category_id" => $category
                            
                    ]);



                }
                

            }

        }



        // Cette méthode renvoie la vue et les données nécessaires pour afficher la liste des categories 
        public function viewCat(){
            
            $categorieManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategory.php", //  On retourne un tableau contenant le chemin de la vue à afficher et les données à transmettre à la vue
                "data" => [ //data prend la valeur d'un tableau qui contient Categories
                    "categories" => $categorieManager->findAll()// La méthode findAll de la classe catManager renvoie la liste des categories
                ]
            ];

        }

        public function findTopicsByCat($id){
            $categorieManager = new CategoryManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsByCategory.php",
                "data" => [
                    "categories" => $categorieManager->findOneById($id),
                    // "categories" => $categorieManager->findAll(),
                    // "categories2" => $categorieManager->catByTopic($id),
                    "topics" => $topicManager->TopicByCat($id)
                ]
            ];


        }

        public function viewAddCat(){
            $categorieManager = new CategoryManager();
           
            return [
                "view" => VIEW_DIR."forum/ajouterCategory.php",
                "data" => [
                    "categories" => $categorieManager->findAll()
                ]
            ];

        }

       

            public function addCategory(){
                if(!empty($_POST)){
                    
                    $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    if($category){
                        $manager = new CategoryManager(); 
                        $user = $manager->findOneById($category); 
                        if (!$user){

                            if ($manager->add([
                                "nameCategory" => $category,
                                
                            ])){
                                header('Location:index.php?ctrl=home');

                            }

                        
                        }
                       
                    }
                    var_dump($category);


    
                }
    
               
            }
            
        }
    
    
