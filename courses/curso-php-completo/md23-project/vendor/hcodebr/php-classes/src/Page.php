<?php
    /**
     *  
     * Classe responsavel por cuidar das paginas.
     * 
     */

    namespace Hcode;

    use Rain\Tpl;

    class Page{

        private $tpl;
        private $defaults = [
            "data"=>[]
        ];
        private $options = [];

        public function __construct($opts = array()){

            $this->options = array_merge($this->defaults, $opts);

            $config = array(
                "tpl_dir"       =>  $_SERVER["DOCUMENT_ROOT"]."/WebCourse/courses/curso-php-completo/md23-project/views/",
                "cache_dir"     =>  $_SERVER["DOCUMENT_ROOT"]."/WebCourse/courses/curso-php-completo/md23-project/views-cache/",
                "debug"         =>  false
            );

            Tpl::configure( $config );

            $this->tpl = new Tpl;

            $this->setData($this->options["data"]);

            $this->tpl->draw("header");


        }

        private function setData($data = array()){

            foreach ($data as $key => $value) {
                $this->tpl->assign($key, $value);
            }

        }

        public function setTpl($name, $data = array(), $returnHtml = false){
            $this->setData($data);
            return $this->tpl->draw($name, $returnHtml);
        }


        public function __destruct(){

            $this->tpl->draw("footer");

        }


    }

?>