<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;
use \Hcode\Model\User;

class Cart extends Model{

    const SESSION = "Cart";
    const SESSION_ERROR = "CartError";

    public static function getFromSession()
{
        $cart = new Cart(); 
        if (isset($_SESSION[Cart::SESSION]) && (int)$_SESSION[Cart::SESSION]['idcart'] > 0) {
            $cart->get((int)$_SESSION[Cart::SESSION]['idcart']);
        } else {
            $cart->getFromSessionID();
            if (!(int)$cart->getidcart() > 0) {
                $data = [
                    'dessessionid'=>session_id()
                ];
                if (User::checkLogin(false)) {
                    $user = User::getFromSession();
                    
                    $data['iduser'] = $user->getiduser();   
                }
                $cart->setData($data);

                $cart->save();
                $cart->setToSession();
            }
        }
        return $cart;
}


    public function setToSession(){

        $_SESSION[Cart::SESSION] = $this->getValues();

    }

    public function getFromSessionID(){

        $sql = new Sql();

        $results = $sql->SELECT("SELECT * FROM tb_carts WHERE dessessionid = :dessessionid", [
            ":dessessionid"=>session_id()
        ]);

        if(count($results) > 0){
            $this->setData($result[0]);
        }

    }

    public function get(int $idCart){

        $sql = new Sql();

        $results = $sql->SELECT("SELECT * FROM tb_carts WHERE idcart = :idcart", [
            ":idcart"=>$idCart
        ]);

        if(count($results) > 0){
            $this->setData($results[0]);
        }

        

    }

    public function save(){

        $sql = new Sql();
        
        $results = $sql->select("CALL `db_ecommerce`.`sp_carts_save`(:idcart, :dessessionid, :iduser, :deszipcode, :vlfreight, :nrdays);",[
            ":idcart"=>$this->getidcart(),
            ":dessessionid"=>$this->getdessessionid(),
            ":iduser"=>$this->getiduser(),
            ":deszipcode"=>$this->getdeszipcode(),
            ":vlfreight"=>$this->getvlfreight(),
            "nrdays"=>$this->getnrdays()

        ]);

    
        $this->setData($results[0]);
        


    }

    public function addProduct(Product $product){

        $sql = new Sql();

        $sql->query("INSERT INTO tb_cartsproducts (idcart, idproduct) values(:idcart, :idproduct)",[
            ":idcart"=>$this->getidcart(),
            ":idproduct"=>$product->getidproduct()
        ]);

    }

    public function removeProduct(Product $product, $all = false){

        $sql = new Sql();

        if($all){

            $sql->query("UPDATE tb_cartsproducts SET dtremoved = NOW() WHERE idcart = :idcart AND idproduct = :idproduct AND dtremoved IS NULL", [
                ":idcart"=>$this->getidcart(),
                ":idproduct"=>$product->getidproduct()
            ]);

        }else{

            $sql->query("UPDATE tb_cartsproducts SET dtremoved = NOW() WHERE idcart = :idcart AND idproduct = :idproduct AND dtremoved IS NULL LIMIT 1 ", [
                ":idcart"=>$this->getidcart(),
                ":idproduct"=>$product->getidproduct()
            ]);


        }

    }

    public function getProducts(){

        $sql = new Sql();

        return Product::checkList($sql->select("
            SELECT b.idproduct, b.desproduct, b.vlprice, b.vlwidth, b.vlheight, b.vllength, b.vlweight, b.desurl, COUNT(*) AS  nrqtde, SUM(b.vlprice) AS vltotal FROM tb_cartsproducts a 
            INNER JOIN tb_products b ON a.idproduct = b.idproduct 
            WHERE a.idcart = :idcart AND a.dtremoved IS NULL 
            GROUP BY b.idproduct, b.desproduct, b.vlprice, b.vlwidth, b.vlheight, b.vllength, b.vlweight, b.desurl
            ORDER BY b.desproduct
        ", [
            ":idcart"=>$this->getidcart()

        ]));

    }

    public function getProductsTotals(){

        $sql = new Sql();

        $results = $sql->select("
            select sum(vlprice) as vlprice, sum(vlwidth) as vlwidth, sum(vlheight) as vlheight, sum(vllength) as vllength, sum(vlweight) as vlweight, count(*) as nrqtd
            from tb_products a
            inner join tb_cartsproducts b on a.idproduct = b.idproduct
            where b.idcart = :idcart and dtremoved is null;
        ",[
            ":idcart" => $this->getidcart()
        ]);

        if(count($results[0]) > 0 ){

            return $results[0];

        }else{
            return [];
        }


    }

    public function setFreight($nrzipcode){

        $nrzipcode = \str_replace("-", "0", $nrzipcode);

        $totals = $this->getProductsTotals();

        if($totals['nrqtd'] > 0){

            if($totals['vlheight'] < 2) $totals['vlheight'] = 2;
            if($totals['vllength'] > 105) $totals['vllength'] = 105;
            if($totals['vlwidth'] > 105) $totals['vlwidth'] = 105;
            if($totals['vlheight'] > 105) $totals['vlheight'] = 105;

            $qs = http_build_query([
                'nCdEmpresa'=>'',
                'sDsSenha'=>'',
                'nCdServico'=>'40010 ',
                'sCepOrigem'=>'09853120',
                'sCepDestino'=>$nrzipcode,
                'nVlPeso'=>$totals['vlweight'],
                'nCdFormato'=>'1',
                'nVlComprimento'=>$totals['vllength'],
                'nVlAltura'=>$totals['vlheight'],
                'nVlLargura'=>$totals['vlwidth'],
                'nVlDiametro'=>'0',
                'sCdMaoPropria'=>'S',
                'nVlValorDeclarado'=>$totals['vlprice'],
                'sCdAvisoRecebimento'=>'S'
            ]);

            $xml = simplexml_load_file("http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx/CalcPrecoPrazo?".$qs);

            $result = $xml->Servicos->cServico;

            if($result->MsgErro != ""){

                // #STOP : Terminei a aula aqui. = tempo 27:24

            }

            $this->setnrdays($result->PrazoEntrega);
            $this->setvlfreight(Cart::valueToDecimal($result->Valor));
            $this->setdeszipcode($nrzipcode);
            $this->save();

        }else{

        }

    }

    public static function valueToDecimal($value):float{
        $value = \str_replace(".", "", $value);
        return \str_replace(",", ".", $value);
    }

    public static function setMsgError($msg){

        $_SESSION[Cart::SESSION_ERROR] = $msg;

    }

    public static function getMsgError(){

        return (isset($_SESSION[Cart::SESSION_ERROR])) ? $_SESSION[Cart::SESSION_ERROR] : "";

    }

    public static function clearMsgError(){

        $_SESSION[Cart::SESSION_ERROR] = NULL;        

    }

}

?>