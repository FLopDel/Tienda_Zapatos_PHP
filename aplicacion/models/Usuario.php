<?php

    namespace Models;

    use Lib\BaseDatos;
    use PDO;
    use PDOException;

    //clase usuario(modelo)
    class Usuario{

        private string $id;
        private string $nombre;
        private string $apellidos;
        private string $email;
        private string $password;
        private string $rol;

        private BaseDatos $db;

        public function __construct(string $id, string $nombre, string $apellidos, string $email, string $password, string $rol) {

            $this->db= new BaseDatos();
            $this->id= $id;
            $this->nombre= $nombre;
            $this->apellidos= $apellidos;
            $this->email= $email;
            $this->password= $password;
            $this->rol= $rol;

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
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellidos
         */ 
        public function getApellidos()
        {
                return $this->apellidos;
        }

        /**
         * Set the value of apellidos
         *
         * @return  self
         */ 
        public function setApellidos($apellidos)
        {
                $this->apellidos = $apellidos;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getpassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setpassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of rol
         */ 
        public function getRol()
        {
                return $this->rol;
        }

        /**
         * Set the value of rol
         *
         * @return  self
         */ 
        public function setRol($rol)
        {
                $this->rol = $rol;

                return $this;
        }


        public static function fromArray(array $data):Usuario{

            return new Usuario(
                    $data['id'] ?? '',
                    $data['nombre'] ?? '',
                    $data['apellidos'] ?? '',
                    $data['email'] ?? '',
                    $data['password'] ?? '',
                    $data['rol'] ?? '',
            );
        }

        public function save(): bool{

            $ins=$this->db->prepare("INSERT INTO usuarios (id,nombre,apellidos,email,password,rol) VALUES(:id, :nombre,:apellidos,:email,:password,:rol)");

            $ins->bindParam('id',$id);
            $ins->bindParam(':nombre',$nombre,PDO::PARAM_STR);
            $ins->bindParam(':apellidos',$apellidos,PDO::PARAM_STR);
            $ins->bindParam(':email',$email,PDO::PARAM_STR);
            $ins->bindParam(':password',$password,PDO::PARAM_STR);
            $ins->bindParam(':rol',$rol,PDO::PARAM_STR);

            $id=NULL;
            $nombre=$this->getNombre();
            $apellidos=$this->getApellidos();
            $email=$this->getEmail();
            $password=$this->getpassword();
            $rol='user';

            try{
                $ins->execute();
                $result=true;
            }catch(PDOException $err){
                echo "Algo ha salido mal";
                $result=false;
            }

            return $result;

        }

        public function login():bool|object{
            $result = false;
            $email = $this->email;
            $password = $this->password;
            
            $usuario = $this->buscaMail($email);
            if($usuario !== false){
                $verify = password_verify($password, $usuario->password);
                if($verify){
                    $result = $usuario;
                }
            }
            return $result;
        }

        public function buscaMail($email):bool|object{
            $result = false;

            $cons = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email");
            $cons->bindParam(':email',$email,PDO::PARAM_STR);
            try{
                $cons->execute();
                if($cons && $cons->rowCount()==1){
                    $result = $cons->fetch(PDO::FETCH_OBJ);
                }
            }catch(PDOException $err){
                $result = false;
            }
            return $result;
        }
    }

?>