<?php
    class Usuario{
        private string $username;
        private string $password;
        private string $role;

        public function __construct($username, $password, $role){
            $this->username = $username;
            $this->password = $password;
            $this->role = $role;
        }

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            $this->username = $username;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password = $password;
        }

        public function getRole(){
            return $this->role;
        }
        public function setRole($role){
            $this->role = $role;
        }
    }
?>