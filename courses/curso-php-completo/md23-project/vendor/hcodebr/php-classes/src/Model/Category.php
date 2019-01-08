<?php

    namespace Hcode\Model;  
    use \Hcode\DB\Sql;
    use \Hcode\Model;
    use \Hcode\Mailer;

    class Category extends Model {

        
        public static function listAll(){

            $sql = new Sql();

            return $sql->select("SELECT * FROM tb_categories ORDER BY descategory");

        }

        public function save(){

            $sql = new Sql();

            $result = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", array(
                ":idcategory"=>$this->getidcategory(),
                ":descategory"=>$this->getdescategory()
            ));

            $this->setData($result[0]);

            Category::updateFile();

        }

        public function get($idCategory){

            $sql = new Sql();

            $results = $sql->select("SELECT * FROM tb_categories WHERE idcategory = :idcategory", [
                ':idcategory'=>$idCategory
            ]);

            $this->setData($results[0]);

        }

        public function delete(){

            $sql = new Sql();

            $sql->query("DELETE FROM tb_categories WHERE idcategory = :idcategory",[
                ':idcategory'=>$this->getidcategory()
            ]);

            Category::updateFile();

        }

        public static function updateFile(){

            $categories = Category::listAll();

            $html = [];

            foreach($categories as $row){

                array_push($html, '<li><a href="/WebCourse/courses/curso-php-completo/md23-project/index.php/category/'.$row['idcategory'].'">'. $row['descategory'] .'</a></li>');

            }

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "\WebCourse\courses\curso-php-completo\md23-project" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "categories-menu.html", implode('', $html));


        }

        /**
         * PAROU AQUI - 07:00
         * 
         * CRIAR INTELIGENCIA PARA PUXAR PRODUTOS SEM CATEGORIAS
         * 
         */

        
    }

?>