<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
           $userManager = new userManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php", // renvoie la vue listtopics
                "data" => [ //data prend la valeur d'un tableau qui contient topics 
                    "topics" => $topicManager->findAll(["creationdate", "DESC"]), // Dans topicManager va me chercher la fonc findAll, trié par creation date, 
                    "users" => $userManager->findAll(["registerDate", "DESC"]) //Dans useManager va me chercher la fonc findAll, trié par creation date 
                ]
            ];
        
        }

    }
