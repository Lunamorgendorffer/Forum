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
           $userManager = new UserManager();
           $postManager = new PostManager();
           $catManager = new CatManager();
        
            return [
                "view" => VIEW_DIR."forum/listTopics.php", // renvoie la vue listtopics
                "data" => [ //data prend la valeur d'un tableau qui contient topics 
                    // "topics" => $topicManager->findAll(["creationdate", "DESC"]), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                    "topics" => $topicManager->findAllTopicsUser(), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                ],

                "view" => VIEW_DIR."forum/listUsers.php", // envoi à la vue listUsers
                "data" => [ //data prend la valeur d'un tableau qui contient Users
                    "users" => $userManager->findAll(), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                ],

                "view" => VIEW_DIR."forum/listPosts.php", // envoi à la vue listUsers
                "data" => [ //data prend la valeur d'un tableau qui contient Users
                    "post" => $postManager->findAllPostUser(), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                ],

                "view" => VIEW_DIR."forum/listCategory.php", // envoi à la vue listUsers
                "data" => [ //data prend la valeur d'un tableau qui contient Users
                    "category" => $catManager->findAll(), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                ],
            ];

           
            
        
        }

    }
