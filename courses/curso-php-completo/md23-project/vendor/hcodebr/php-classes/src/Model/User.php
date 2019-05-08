<?php

    namespace Hcode\Model;  
    use \Hcode\DB\Sql;
    use \Hcode\Model;
    use \Hcode\Mailer;

    class User extends Model {

        const SESSION   = "User";
        const SECRET  = "HcodePhp7_Secret";
        const ERROR = "UserError";
        const ERROR_REGISTER = "UserErrorRegister";
        const SUCCESS = "UserSuccess";

        public static function getFromSession(){

            $user = new User();

            if(isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['iduser'] > 0 ){

                

                $user->setData($_SESSION[User::SESSION]);


            }

            return $user;


        }

        public static function checkLogin($inadmin = true){

            if(

                !isset($_SESSION[User::SESSION]) 
                || 
                !$_SESSION[User::SESSION] 
                || 
                !(int)$_SESSION[User::SESSION]['iduser'] > 0

            ){

                // não esta logado
                return false;

            }else{

                if($inadmin === true && (bool)$_SESSION[User::SESSION]['inadmin'] === true ){

                    return true;

                } else if ( $inadmin === false ) {

                    return true;

                }else{

                    return false;

                }

            }

        }

        public function login($login, $password){

            $sql = new Sql();

            $results = $sql->select("SELECT * FROM tb_users a JOIN tb_persons b ON a.idperson = b.idperson WHERE a.deslogin = :LOGIN ", array(
                ":LOGIN"=>$login
            ));

            if(count($results) === 0){
                throw new \Exception("Usuário inexistente ou senha invalida");
                
            }

            $data = $results[0];

            if (password_verify($password, $data['despassword']) === true){

                $user = new User();

                $data['desperson'] = \utf8_encode($data['desperson']);

                $user->setData($data);
                
                $_SESSION[User::SESSION] = $user->getValues();

                return $user;

            } else {

                throw new \Exception("Usuário inexistente ou senha invalida");
            
            }


        }

        public static function verifyLogin( $inadmin = true ){

            
            if( !User::checkLogin($inadmin))
            {

                if($inadmin){
                    header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/admin/login");
                }else{
                    header("Location: /WebCourse/courses/curso-php-completo/md23-project/index.php/login");
                }

                
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
                ":desperson"=>utf8_decode($this->getdesperson()),
                ":deslogin"=>$this->getdeslogin(),
                ":despassword"=>User::getPasswordHash($this->getdespassword()),
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

            $data = $results[0];

            
            $data['desperson'] = \utf8_encode($data['desperson']);

            $this->setData($data);

        }

        public function update(){
            
            $sql = new Sql();

            $results = $sql->select("CALL sp_usersupdate_save(:iduser, :desperson, :deslogin, :despassword, :desemail, :nrphone, :inadmin)", array(
                ":iduser"=>$this->getiduser(),
                ":desperson"=>utf8_decode($this->getdesperson()),
                ":deslogin"=>$this->getdeslogin(),
                ":despassword"=>User::getPasswordHash($this->getdespassword()),
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

        public static function getForgot($email, $inadmin = true){

            $sql = new Sql();

            $result = $sql->select("SELECT * FROM tb_persons a JOIN tb_users b USING (idperson) WHERE a.desemail = :email ;", array(
                ":email"=>$email
            ));

            if (count($result[0]) === 0){

                throw new \Exception("Não foi possivel recuperar a senha.");
                
            }else{

                $data = $result[0];

                $result2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:IDUSUARIO, :DESIP)", array(
                    ":IDUSUARIO"=>$data["iduser"],
                    ":DESIP"=>$_SERVER["REMOTE_ADDR"]
                ));

                if( count($result2) === 0 ){

                    throw new \Exception("Não foi possivel recuperar a senha.");

                }else{

                    $dataRecovery = $result2[0];

                    $iv     = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                    $code   = openssl_encrypt($dataRecovery['idrecovery'], 'aes-256-cbc', User::SECRET, 0, $iv);
                    $result = base64_encode($iv.$code);


                    if($inadmin){
                        $link = "http://localhost/WebCourse/courses/curso-php-completo/md23-project/index.php/admin/forgot/reset?code=$result";
                    }else{
                        $link = "http://localhost/WebCourse/courses/curso-php-completo/md23-project/index.php/forgot/reset?code=$result";                        
                    }

                
                    $mailer = new Mailer($data['desemail'], $data['desperson'], "Redefinição de senha.", 'forgot',
                    array(
                        "name"=>$data['desperson'],
                        "link"=>$link
                    ));

                    $mailer->send();

                    return $data;
                
                
                }

            }

        }

        public static function validForgotDecrypt($result){
           
            $result = base64_decode($result);
            $code = mb_substr($result, openssl_cipher_iv_length('aes-256-cbc'), null, '8bit');
            $iv = mb_substr($result, 0, openssl_cipher_iv_length('aes-256-cbc'), '8bit');
            $idRecovery = openssl_decrypt($code, 'aes-256-cbc', User::SECRET, 0, $iv);

            $sql = new Sql();
            $result = $sql->select("SELECT * FROM tb_userspasswordsrecoveries a INNER JOIN tb_users b USING(iduser) INNER JOIN tb_persons c USING(idperson) WHERE a.idrecovery = :RECOV AND a.dtrecovery IS NULL AND DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();", array(
                ":RECOV"=>$idRecovery
            ));

            if(count($result) === 0){
                throw new \Exception("Não foi possivel recuperar a senha.");
            
            }else{

                return $result[0];

            }
        }

        public static function setForgotUser($idRecovery){

            $sql = new Sql();

            $sql->query("UPDATE tb_userspasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(
                ":idrecovery"=>$idRecovery
            ));

        }

        public function setPassword($password){

            $sql = new Sql();

            $sql->query("UPDATE tb_users SET despassword = :pass WHERE iduser = :id", array(
                ":pass"=>$password,
                ":id"=>$this->getiduser()
            ));

        }

        public static function setError($msg){

            $_SESSION[User::ERROR] = $msg;

        }

        public static function getError(){

            $msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : "";

            User::ClearError();

            return $msg;

        }

        public static function clearError(){

            $_SESSION[User::ERROR] = null;

        }

        public static function setErrorRegister($msg){

            $_SESSION[User::ERROR_REGISTER] = $msg;

        }

        public static function getErrorRegister(){

            $msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : "";

            User::clearErrorRegister();

            return $msg;

        }

        public static function clearErrorRegister(){

            $_SESSION[User::ERROR_REGISTER] = null;

        }

        public static function getPasswordHash($pass){
            return \password_hash($pass, PASSWORD_DEFAULT, ['const'=>12]);
        }

        public static function checkLoginExist($login){

            $sql = new Sql();

            $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :deslogin",[
                ':deslogin'=>$login
            ]);

            return (count($results) > 0);

        }

        public static function setSuccess($msg){

            $_SESSION[User::SUCCESS] = $msg;

        }

        public static function getSuccess(){

            $msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : "";

            User::ClearError();

            return $msg;

        }

        public static function clearSuccess(){

            $_SESSION[User::SUCCESS] = null;

        }

    }

?>