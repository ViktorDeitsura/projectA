<?php
namespace App\Application;
require_once '../Domain/Users/UserEntity.php'; use App\Domain\Users\UserEntity;
require_once '../Infrastructure/sdbh.php'; use sdbh\sdbh;

class AdminService {

    /** @var UserEntity */
    public $user;

    public function __construct()
    {
        $this->user = new UserEntity();
    }

    public function addNewProduct()
    {
        if (!$this->user->isAdmin) return;
        $dbh = new sdbh();

        $arr = explode(",",$_POST['tariff']);

        $str = "";
        $count = 0;
        foreach ( $arr as $key => $value ) {
            if ( $value != "" ) {
                $str .= "i:".$key.";";
                $str .= "i:".$value.";";
                $count++;
            }
        }
        $str .= "}";
        $str = "a:".$count.":{".$str;

        $arr_to = array("name"=>$_POST['name'],"price"=>$_POST['price'],"tariff"=>$str);
        $dbh->insert_row("a25_products", $arr_to);
        echo json_encode( $arr_to );
    }
}

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $adm_serv = new AdminService();
    $adm_serv->addNewProduct();
}