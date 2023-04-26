<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    use Model\Managers\CatManager;
    
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

         // Cette méthode renvoie la vue et les données nécessaires pour afficher la liste des categories 
        public function viewCat(){
            
            $catManager = new CatManager();

            return [
                "view" => VIEW_DIR."forum/listCategory.php", //  On retourne un tableau contenant le chemin de la vue à afficher et les données à transmettre à la vue
                "data" => [ //data prend la valeur d'un tableau qui contient Categories
                    "categories" => $catManager->findAll()// La méthode findAll de la classe catManager renvoie la liste des categories
                ]
            ];

        }

    }
