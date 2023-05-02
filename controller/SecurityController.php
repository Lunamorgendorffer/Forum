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

        public function registerForm(){
            // hache le passeword = transformer le mp en clé unique indechifrable dans la bdd = defintif voir OWASP pour les recommmandaion
            return [
                "view" => VIEW_DIR."security/login.php", 
                "data" => null,

            ]; 


        }
        
        public function register() {
            if (!empty($_POST)){ // Si le form n'est pas vide alors 

                $pseudo = filter_input(INPUT_POST,"pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmPassword = filter_input(INPUT_POST,"confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
              

                if($pseudo&&$email&&$password){

                    if (($password == $confirmPassword) and strlen($password) >= 8){ // on verifie que $password == $confirmPassword et aussi sup à 8 caractère

                        $manager = new UserManager(); 
                        $user = $manager ->findOneByPseudo($pseudo); 

                        if (!$user){
                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            if ($manager->add([
                                "pseudo" => $pseudo,
                                "mail"=> $email,
                                "password"=> $hash,
                            ])){
                                header('Location:index.php?ctrl=home');

                            }

                            return [
                            "view" => VIEW_DIR."security/login.php", 
                            ]; 
                        }

                    }

                }else{
                    echo "Erreur : tous les champs sont requis.";
                }

            }else {
                echo "Le formulaire n'a pas été soumis.";
            }
        }
    }
