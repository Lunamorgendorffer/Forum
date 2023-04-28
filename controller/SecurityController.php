<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    use Model\Managers\CategoryManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        public function register(){
            // hache le passeword = transformer le mp en clé unique indechifrable dans la bdd = defintif voir OWASP pour les recommmandaion 

        }
        
    }
