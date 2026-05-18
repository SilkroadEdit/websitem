<?php 
class dbConnection{
	
	public $db_conn_shard;
	public $db_conn_account;
	public $db_conn_pann;
	public $db_conn_logger;
	public $db_conn_log;
	public $db_shard;
	public $db_account;
	public $db_pann;
	public $db_logger;
	public $db_user;
	public $db_pass;
	public $db_host;
  
  public function __construct(){
	   $serverName = "DESKTOP-Q7FASMR\SQLEXPRESS";
		$serverUser = "sa";
		$serverPass = "1907Fener";
		$dbShard 	= "SRO_VT_SHARD";
		$dbAccount	= "SRO_VT_ACCOUNT";
		$dbPann 		= "Panel";
		$dbLogger 		= "PureLogger";
		$dbLog 		= "SRO_VT_LOG";
		
		$config['db']=array(
    'host'  	=>  $serverName,
    'dbshard'	=>  $dbShard,
	'dbaccount'	=>  $dbAccount,
	'dblog'		=> 	$dbLog,
	'dbpann'		=> 	$dbPann,
	'dblogger'		=> 	$dbLogger,
    'user'  	=>  $serverUser,
    'pass'  	=>  $serverPass
    );
		
		
	   $this->db_shard	 = $config['db']['dbshard'];
	   $this->db_account = $config['db']['dbaccount'];
	   $this->db_log	 = $config['db']['dblog'];
	   $this->db_pann	 = $config['db']['dbpann'];
	   $this->db_logger	 = $config['db']['dblogger'];
	   $this->db_user	 = $config['db']['user'];
	   $this->db_pass	 = $config['db']['pass'];
	   $this->db_host	 = $config['db']['host'];
	   
  }
   
   public  function connect(){
		try{
		 $this->db_conn_shard=new PDO("sqlsrv:server=$this->db_host;Database=$this->db_shard",$this->db_user,$this->db_pass);
		 $this->db_conn_account=new PDO("sqlsrv:server=$this->db_host;Database=$this->db_account",$this->db_user,$this->db_pass);
		 $this->db_conn_log=new PDO("sqlsrv:server=$this->db_host;Database=$this->db_log",$this->db_user,$this->db_pass);
		 $this->db_conn_pann=new PDO("sqlsrv:server=$this->db_host;Database=$this->db_pann",$this->db_user,$this->db_pass);
		 $this->db_conn_logger=new PDO("sqlsrv:server=$this->db_host;Database=$this->db_logger",$this->db_user,$this->db_pass);
		 }catch(Exception $e){
		 die( print_r( $e->getMessage() ) ); 
		 }
   }
}