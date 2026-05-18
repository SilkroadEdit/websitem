<?php 
error_reporting(E_ALL); ini_set("display_errors", 1);

  class fy_mssql {

     public $shard,$account,$logger,$pann;
     private $dsn,$dsn2,$dsn3,$dsn4,$user,$pass;
     
     function __construct() {
        require_once('config.php');
        
        $host=$config['db']['host'];
        $dbshard=$config['db']['dbshard'];
		$dbaccount=$config['db']['dbaccount'];
		$dbpann=$config['db']['dbpann'];
		$dbpann=$config['db']['dblogger'];
       
        $this->dsn="sqlsrv:server=$host;Database=$dbshard";
        $this->dsn2="sqlsrv:server=$host;Database=$dbaccount";
		$this->dsn3="sqlsrv:server=$host;Database=$dbpann";
		$this->dsn3="sqlsrv:server=$host;Database=$dblogger";
        $this->user=$config['db']['user'];
        $this->pass=$config['db']['pass'];
        
        $this->Start();
        }
        
        protected function Start(){
            try {
                $this->shard = new PDO($this->dsn,$this->user,$this->pass);
                $this->account = new PDO($this->dsn2,$this->user,$this->pass);
				$this->pann = new PDO($this->dsn3,$this->user,$this->pass);
				$this->logger = new PDO($this->dsn4,$this->user,$this->pass);
                   
            } catch (Exception $e) {
                
               die( print_r( $e->getMessage() ) ); 
			}
		}
  }