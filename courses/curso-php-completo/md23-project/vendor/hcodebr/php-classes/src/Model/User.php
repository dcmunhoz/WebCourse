<?php

    namespace Hcode\Model;  
    use \Hcode\DB\Sql;
    use \Hcode\Model;

    class User extends Model {

        const SESSION = "User";

        public function login($login, $password){

            $sql = new Sql();

            $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN ", array(
                ":LOGIN"=>$login
            ));

            if(count($results) === 0){
                throw new \Exception("Usuário inexistente ou senha invalida");
                
            }

            $data = $results[0];

            if (password_verify($password, $data['despassword']) === true){

                $user = new User();

                $user->setData($data);
                
                $_SESSION[User::SESSION] = $user->getValues();

                return $user;

            } else {

                throw new \Exception("Usuário inexistente ou senha invalida");
            
            }


        }

        public static function verifyLogin( $inadmin = true ){

            if( !isset($_SESSION[User::SESSION]) || !$_SESSION[User::SESSION] || !(int)$_SESSION[User::SESSION]['iduser'] > 0 || (bool)$_SESSION[User::SESSION]['inadmin'] !== $inadmin ){
                header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/login");
                exit;
            }

        }

        public static function logout(){

            if( isset($_SESSION[User::SESSION]) ){

                unset($_SESSION[User::SESSION]);

            }

        }

        public static function listAll(){

            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");

        }

        public static function getUser($iduser){

            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_users WHERE iduser = :ID", array(":ID"=>$iduser));

        }

        public function save(){

            $sql = new Sql();

            $results = $sql->select("CALL sp_users_save(:desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
                ":desperson"=>$this->getdesperson(),
                ":deslogin"=>$this->getdeslogin(),
                ":despassword"=>$this->getdespassword(),
                ":desemail"=>$this->getdesemail(),
                ":nrphone"=>$this->getnrphone(),
                ":inadmin"=>$this->getinadmin()

            ));

            $this->setData($results[0]);

        }

        public function get($idUser){

            $sql = new Sql();

            $results = $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = :iduser", array(
                ":iduser"=>$idUser
            ));

            $this->setData($results[0]);

        }

        public function update(){
            
            $sql = new Sql();

            $results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
                ":iduser"=>$this->getiduser(),
                ":desperson"=>$this->getdesperson(),
                ":deslogin"=>$this->getdeslogin(),
                ":despassword"=>$this->getdespassword(),
                ":desemail"=>$this->getdesemail(),
                ":nrphone"=>$this->getnrphone(),
                ":inadmin"=>$this->getinadmin()

            ));

            $this->setData($results[0]);

        }

        public function delete(){

            $sql = new Sql();

            $sql->query("CALL sp_users_delete(:iduser)", array(
                ":iduser"=>$this->getiduser()
            ));
            
        }

        public static function getForgot($email){

            $sql = new Sql();

            $result = $sql->select("SELECT * FROM tb_persons a JOIN tb_users b USING (idperson) WHERE a.desemail = :email ;", array(
                ":email"=>$email
            ));

            if (count($result[0]) === 0){

                throw new \Exception("Não foi possivel recuperar a senha.");
                
            }else{

                $data = $result[0];

                $result2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:idusuario, :desip)", array(
                    ":iduser"=>$data["iduser"],
                    ":desip"=>$_SERVER["REMOTE_ADDR"]
                ));

                if( count($result2) === 0 ){

                    throw new \Exception("Não foi possivel recuperar a senha.");

                }else{

                    $dataRecovery = $result2[0];

                    // Pausa - 14:08
                    base64_encode();


                }

            }

        }


    }

?>