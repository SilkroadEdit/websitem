<?php 

class Sorgu{
	
		public $link;
		
		public function __construct(){

				include('config.php');
				$this->link=new dbConnection();
				$this->link->connect();
				return $this->link;
		
		}
	 
	 public function onlineuser($fake=0){
	 
		$query=$this->link->db_conn_account->query("SELECT TOP 1 nUserCount FROM _ShardCurrentUser ORDER BY dLogDate DESC");
		foreach($query as $row)
		{
			return $row['nUserCount'] + $fake;
		}
		
	 }
		//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function fortressJangan(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 1");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "KALE KAPALI"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
	public function fortressHotan(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 3");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "KALE KAPALI"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
	public function fortressBandit(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 6");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "KALE KAPALI"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
	public function fortressConstantinople(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 4");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "KALE KAPALI"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
}