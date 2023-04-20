<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php", // renvoie la vue listtopics
                "data" => [
                    "topics" => $topicManager->findAll(["creationdate", "DESC"])//Dans topicManager va me chercher la fonc findAll, trié par creation date 
                ]
            ];
        
        }

        

    }
