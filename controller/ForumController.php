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

        
        // fonction pour aller dans la vu addCat
        public function viewAddCat(){
            $categorieManager = new CategoryManager();
           
            return [
                "view" => VIEW_DIR."forum/ajouterCategory.php",
                "data" => [
                    "categories" => $categorieManager->findAll()
                ]
            ];

        }

       
        // fonction pour ajouter une category
        public function addCategory(){
            if(!empty($_POST)){ //vérifie si les données du formulaire ont été soumises. 
                    
                $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);// on utilise la fonction "filter_input()" pour nettoyer les données saisies par l'utilisateur et les stocke dans la variable $category.

                if($category){
                    $manager = new CategoryManager(); // on instancie  la classe "CategoryManager"
                    $user = $manager->findOneById($category); //utilise la méthode "findOneById()" pour vérifier si une catégorie portant le même ID existe déjà dans la base de données.

                    if (!$user){// Si la catégorie n'existe pas encore,

                        if ($manager->add([ //  il utilise la méthode "add()" du "CategoryManager" pour ajouter la nouvelle catégorie à la base de données 
                            "nameCategory" => $category, // en lui associant le nom de la catégorie saisie par l'utilisateur.
                                
                        ])){
                             header('Location:index.php?ctrl=home'); // renvoie à la page d'acceuil

                        }

                        
                    }
                       
                }

            }
               
        }

/******************************************************************TOPIC*************************************************************************************************/  
        // Cette méthode renvoie la vue et les données nécessaires pour afficher la liste des topics
        public function findTopicsByCat($id){
            $categorieManager = new CategoryManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopicsByCategory.php",
                "data" => [
                    "categories" => $categorieManager->findOneById($id),
                    // "categories" => $categorieManager->findAll(),
                    // "categories2" => $categorieManager->catByTopic($id),
                    "topics" => $topicManager->TopicByCat($id),
                    "id" => $topicManager ->fetchId($id)
                ]
            ];


        }

        // Cette méthode renvoie la vue et les données nécessaires pour afficher le topic
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

        // fonction pour aller dans la vu addTopic
        public function viewAddTopic (){
            $topicManager = new TopicManager();// On instancie un objet de la classe UserManager pour récupérer la liste des utilisateurs
           
            return [
                "view" => VIEW_DIR."forum/ajouterTopic.php",
                "data" => [
                    "categories" => $topicManager->findAll()
                ]
            ];

        }
        
        // fonction pour ajouter un topic + un 1er  message  
        public function addTopic (){
            if(!empty($_POST)){
                // on utilise la fonction "filter_input()" pour nettoyer les données saisies par l'utilisateur et les stocke dans les variables
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user =  Session::getUser()->getId();
                
                // $category = isset($_GET['id']) ? $_GET['id'] : '';
                // var_dump($category);

                if($title){
                    $topicManager = new TopicManager(); // On instancie un objet de la classe TopicManager 
                    $post = new PostManager(); // On instancie un objet de la classe PostManager 

                    //la méthode "add()" de "TopicManager" pour ajouter un nouveau sujet à la base de données
                    $topic=$topicManager->add([
                        "title" => $title,
                        "user_id" => $user,
                        "category_id" => $category
                            
                    ]);

                    // la méthode "add()" de "PostManager" pour ajouter le message du sujet à la base de données 
                    $post->add([
                        "message" => $text,
                        "user_id" => $user,
                        "topic_id" =>$topic
                    ]);
                        
                   

                }
                header("index.php?ctrl=forum&action=findTopicsByCat");
                //header("Location: index.php?ctrl=forum&action=findTopicsByCat&id=" . $category);

                
                


            }
                

        }

        
        // fonction pour supprimer Topic  
        public function deleteTopic($id){
            // $postManager = new PostManager(); 
            $topicManager = new TopicManager(); //Elle crée une instance de la classe "TopicManager"
            $topic= $topicManager->findOneById($id)->getCategory()->getId(); // on utilise la méthode "findOneById()" pour récupérer les données du sujet à partir de son ID.
            
            // $postManager->deletePosts($id);
            $topicManager->delete($id);//on utilise la méthode "delete()" sur "TopicManager" pour supprimer le sujet de la base de données.

            $this->redirectTo("forum", "findTopicsByCat", $topic);
          
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

        public function viewEditPost($id){
            $postManager = new PostManager();
            // $post = $postManager->findOneByid($id)->getMessage();
           
            return [
                "view" => VIEW_DIR."forum/editPost.php",
                "data" => [
                    "messages" => $postManager->findAll()
                ]
            ];

        }

        public function editPost($id){
            // $topicManager = new TopicManager();
            $postManager = new PostManager();

            //je recupère l'user de mon post
            $topicId = $postManager->findOneById($id)->getUser()->getId();

            if (isset($_POST['submit']))
            {
                $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($post){
                    $postManager->updatePost($post, $id);
                } 
            
            }
            // $this->redirectTo("forum", "detailTopic", );
            // header("location:index.php?ctrl=forum&action=detailTopic&id=".$topicId);
            header('Location:index.php?ctrl=home');
        
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
    

        
            
    }
    
    
