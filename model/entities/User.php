<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudo;
        private $mail;
        private $registerDate;
        private $role;
        private $password;

        public function __construct($data){         
            $this->hydrate($data);        
        }


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of mail
         */ 
        public function getMail()
        {
                return $this->mail;
        }

        /**
         * Set the value of mail
         *
         * @return  self
         */ 
        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }

        
        public function getRegisterDate(){
            $formattedDate = $this->registerDate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setRegisterDate($date){
            $this->registerDate = new \DateTime($date);
            return $this;
        }


        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

       /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = json_encode($role);

                return $this;
        }

        public function hasRole($role){
        
                $result = $this->role== $role;
                return $result; 

        }

        

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }
        
}
