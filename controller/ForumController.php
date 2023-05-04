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
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user =  Session::getUser()->getId();
                
                // $category = isset($_GET['id']) ? $_GET['id'] : '';
                // var_dump($category);

                if($title){
                    $topicManager = new TopicManager(); 
                    $post = new PostManager();

                    $topic=$topicManager->add([
                        "title" => $title,
                        "user_id" => $user,
                        "category_id" => $category
                            
                    ]);

                    $post->add([
                        "message" => $text,
                        "user_id" => $user,
                        "topic_id" =>$topic
                    ]);
                        
                   

                }
                // header("index.php?ctrl=forum&action=findTopicsByCat&id=".$topicManager->getId());
                return [
                    "view" => VIEW_DIR."forum/topics/listTopicsByCategories.php", // renvoie la vue listtopics
                    "data" => null, 
    
                ];


            }
                

        }

        public function editForm()
        {
            $topicManager = new TopicManager();
            $postManager = new PostManager();
    
            return [
                "view" => VIEW_DIR . "forum/editTopic.php",
                "data" => [
                    "topic" => $topicManager->findOneById($_GET['id']),
                    "post" => $postManager->findFirstById($_GET['id'])
                ]
            ];
        }


        // fonction pour supprimer un message  
        public function deleteTopic($id){ 
            $topicManager =new TopicManager();
         
            
            // requete pour récupérer l'id du topic avant la suppression par la table message 
            $id2 = $postManager->findOneById($id)->getTopic()->getId();
            $postManager->delete($id);

            $this->redirectTo("forum", "detailTopic", $id);
          
        }

     /******************************************************************USER*************************************************************************************************/   
        
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

        /******************************************************************POST*************************************************************************************************/  

        public function viewAddPost (){
            $postManager = new PostManager();
           
            return [
                "view" => VIEW_DIR."forum/topics/detailTopic.phpp",
                "data" => [
                    "messages" => $postManager->findAll()
                ]
            ];

        }

        public function addPostByTopic (){
            if(!empty($_POST)){
                $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user =  Session::getUser()->getId();
                $topic = $_GET['id'];

                if($post){
                    $topicManager = new TopicManager();
                    $postManager = new PostManager(); 

                    $postManager->add([
                        "message" => $post,
                        "user_id" => $user,
                        "topic_id" => $topic
                            
                    ]);

                    header("location:index.php?ctrl=forum&action=detailTopic&id=".$topic);
                }



            }
                

        }

        // fonction pour supprimer un message  
        public function deletePost($id){ 
            $postManager =new PostManager();
         
            
            // requete pour récupérer l'id du topic avant la suppression par la table message 
            $id2 = $postManager->findOneById($id)->getTopic()->getId();
            $postManager->delete($id);

            $this->redirectTo("forum", "detailTopic", $id);
          
        }

        /******************************************************************CATEGORY*************************************************************************************************/  


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
    
    
