<?php

/**
 * Class Veritabani
 */

class Database //implements VeritabaniArayuz
{
    private $databaseConnection;

    /**
     * @var :oluşan nesneyi gösterir (tutar). nesne oluşturmadan önce buraya bakacağımız için
     *(nesne zaten oluşturulmuş mu diye) static olması gerekir.
     */
    private static $instance;
    /**
     * @return mysqli
     */
    public function getDatabaseConnection()
    {
        return $this ->databaseConnection;
    }

    /**
     *Dışarıda nesne oluşturulamasın diye private ya da protected yapılır.
     * getInstance fonksiyonu nesne oluşturabilir.
     */
    private function __construct()
    {
        require_once(__DIR__.'/../Configuration/DatabaseCredentials.php');

        try
        {   //echo "$vtys:dbname=$veritabaniAdi";
            $this->databaseConnection = new PDO("$vtys:dbname=$veritabaniAdi;   host=$sunucu;   user=$kullaniciAdi;   password=$sifre");
            //echo $this->databaseConnection;
            //$this->databaseConnection = new PDO('pgsql:dbname=OgrenciBilgiSistemi;   host=localhost;   user=postgres;   password=LecturePassword');

        } catch ( PDOException $e ){
           // echo "deneme";
            print $e->getMessage();
        }


    }

    /**
     *Nesne kopyalanmaya çalışılırsa (clone) bu fonksiyon private olduğu için hata verecek ve engellenecektir
     */
    private function __clone() {}

    //used static function so that, this can be called from other classes

    /**
     * @return Veritabani
     */
    public static function getInstance(){

        if( !(self::$instance instanceof self) ){

            self::$instance = new self();

        }
        return self::$instance;
    }

    /**
     *
     */
    public function __destruct()
    {

       $this->databaseConnection=null;

    }

}
