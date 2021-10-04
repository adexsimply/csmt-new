<?php
namespace App\Plugin;

class Syncr{
	private $remoteDb = 'goldng_test';
	private $localDb = 'csmt';
	private $remote, $local;

	public function __construct(){
		$this->remote = new mysqli('192.254.235.133:3306','goldng_test','goldng_test',$this->remoteDb);

		// $this->remote = new mysqli('localhost','root','',$this->remoteDb);
		$this->local = new mysqli('localhost','root','',$this->localDb);


		/*Deactivate relationship checks*/
		$this->localQuery('SET FOREIGN_KEY_CHECKS=0;');
		$this->remoteQuery('SET FOREIGN_KEY_CHECKS=0;');
	}


	public function __destruct(){
		/*Activate relationship checks*/
		$this->localQuery('SET FOREIGN_KEY_CHECKS=1;');
		$this->remoteQuery('SET FOREIGN_KEY_CHECKS=1;');
		$this->remote->close();
		$this->local->close();
	}



	/*Run query on local database*/
	private  function localQuery($query,$multi=false){
		/*Run multiple queries*/
		if($multi){

			/*Initialise transaction*/
			$this->local->autocommit(false);

			if($this->local->multi_query($query)){

				while ($this->local->more_results()) {
					$this->local->next_result();
				}

			}

			/*Check for error*/
			if($this->local->error){
				$this->local->rollback();
				die($this->local->error."<hr>".$query);
			}
			else{
				$this->local->commit();
				return true;
			}

		}

		/*Run single query*/
		else
			$check = $this->local->query($query) or die($this->local->error."<hr>".$query);

		return $check;
	}



	/*Run query on remote database*/
	private  function remoteQuery($query,$multi=false){

		/*Run multiple queries*/
		if($multi){

			/*Initialise transaction*/
			$this->remote->autocommit(false);

			if($this->remote->multi_query($query)){
				while ($this->remote->more_results()) {
					$this->remote->next_result();
				}
			}

			/*Check for error*/
			if($this->remote->error){
				$this->remote->rollback();
				die($this->remote->error."<hr>".$query);
			}
			else{
				$this->remote->commit();
				return true;
			}
		}

		/*Run single query*/
		else
			$check = $this->remote->query($query) or die($this->remote->error."<hr>".$query);

		return $check;
	}




	/*Check local location*/
	private static function isRemote($loc){
		if($loc == 'r' || $loc == 'remote')
			return true;
		
		return false;
	}

	/*Check remote location*/
	private static function isLocal($loc){
		if($loc == 'l' || $loc == 'local')
			return true;

		return false;
	}







	/*Collect tables*/
	public function tables($loc='l'){

		if(self::isLocal($loc))
			$tables = $this->localQuery('SHOW TABLES FROM '.$this->localDb);

		else if(self::isRemote($loc))
			$tables = $this->remoteQuery('SHOW TABLES FROM '.$this->remoteDb);
		else 
			return false;

		if($tables->num_rows > 0){
			$output=[];
			while($rows = $tables->fetch_array()){
				$output[]=$rows;
			}

			return $output;
		}

		else
			return false;
	}



	/*Check if database has table*/
	public function hasTables($loc='r'){
		if(self::isLocal($loc))
			$tables = $this->localQuery('SHOW TABLES FROM '.$this->localDb);

		else if(self::isRemote($loc))
			$tables = $this->remoteQuery('SHOW TABLES FROM '.$this->remoteDb);
		else 
			return false;

		if($tables->num_rows > 0){
			return true;
		}

		else
			return false;
	}








	/*Update remote db 
		@ string loc: 
			r >> upadte remove db 
			l >> Update local db

		@Default : r >> Update remote db

	*/
	public function updateTable($loc='r',$lazyLoad=true){

		$local = self::isLocal($loc);
		$remote = self::isRemote($loc);

		/*Collect local tables*/
		if($remote)
			$tables = $this->tables('l');

		/*Collect remote tables*/
		else if($local)
			$tables = $this->tables('r');


		/*Check if local db has tables*/
		if(!$tables)
			return false;

		$bulkQuery='';


		foreach($tables as $table){

			/*Get local table definition*/
			if($remote)
				$tableDefinition = $this->localQuery('DESCRIBE '.$table[0]);

			/*Get remote table definition*/
			else 
				$tableDefinition = $this->remoteQuery('DESCRIBE '.$table[0]);


			/*Create table*/
			$create = 'CREATE TABLE IF NOT EXISTS '.$table[0].' (';

			$key = false;

			while($row = $tableDefinition->fetch_assoc()){

				/*Define primary key*/
				if($row['Key'] == 'PRI')
					$key.=$row['Field'].' ,';

				/*Define auto increment fields*/
				$extra = $row['Extra'] == 'auto_increment' ? 'auto_increment' : '';

				/*Define null fields*/
				$null = $row['Null'] ? 'NULL' : 'NOT NULL';

				/*Get it all together*/
				$create.=$row['Field'].' '.$row['Type'].' '.$null.' '.$extra.' ,';
			}

			/*Remove the last comma*/
			$create = rtrim($create,',');

			/*Add primary keys*/
			if($key)
				$create.=',PRIMARY KEY ('.rtrim($key,',').')';
			
			$create.='); ';

			if($lazyLoad){
				/*lazily sync to to remote db*/
				if($remote)
					if(!$this->remoteQuery($create));

				/*Lazily sync to local db*/
				else
					if(!$this->localQuery($create));

			}

			/*Collect table creation queries*/
			else
				$bulkQuery.=$create;
		}


		/*Faster syncr*/
		if(!$lazyLoad){
			/*Run bulk query to remote db*/
			if($remote)
				if($this->remoteQuery($bulkQuery,true))
					return true;
				else
					return false;

			/*Run bulk query to local db*/
			if($local)
				if($this->localQuery($bulkQuery,true))
					return true;
				else
					return false;
		}
			
			
		return true;
	}





	public function updateData($loc='r'){

		$local = self::isLocal($loc);
		$remote = self::isRemote($loc);

		/*If is local get remote tables else get local table*/
		$tables = $remote ?  $this->tables('l') :  $this->tables('r') ;

		
			foreach($tables as $table){


				/*Collect table data*/
				$data = $remote ? $this->localQuery('SELECT * FROM '.$table[0]) : $this->remoteQuery('SELECT * FROM '.$table[0]);


				if($data->num_rows > 0){

					$values = '';

					while ($row = $data->fetch_array(MYSQLI_NUM)) {
						$value='(';
						foreach($row as $field){
							if($field)
								$value.='"'.$field.'"'.' ,';
							else
								$value.="'' ,";
						}
						$value = rtrim($value,',');

						$values.=$value.') ,';
					}


					/*Collect table columns*/
					$data = $remote ? $this->localQuery('DESCRIBE '.$table[0]) : $this->remoteQuery('DESCRIBE '.$table[0]);

					$fields='';

					while($row = $data->fetch_assoc()){
						$fields.= $row['Field'].' ,';
					}

					$fields = rtrim($fields,',');
					$values = rtrim($values,',');


					$query = sprintf('INSERT INTO %s (%s) VALUES %s;',$table[0],$fields,$values);

					if($remote){
						$this->remoteQuery('TRUNCATE '.$table[0]);
						$this->remoteQuery($query);
					}

					else if($local){
						$this->localQuery('TRUNCATE '.$table[0]);
						$this->localQuery($query);
					}

					else
						return false;
						

				}

				return false;
			}

			return true;
		
	}




	/*Drop tables in specified database*/
	public function dropTable($loc='r',$lazyLoad=true){

		/*collect table list*/
		$tables = $this->tables($loc);

		if(!$tables)
			return false;

		$bulkQuery='';

		foreach($tables as $table){
			$query = 'DROP TABLE '.$table[0];

			if($lazyLoad){

				/*Drop local database tables*/
				if(self::isLocal($loc))
					$this->localQuery($query);

				/*Drop remote database*/
				else if(self::isRemote($loc))
					$this->remoteQuery($query);
				
			}

				$bulkQuery.=$query.'; ';
		}


		/*Run bulk query*/
		if(!$lazyLoad){
			if(self::isLocal($loc))
				$this->localQuery($bulkQuery,true);

			else if(self::isRemote($loc))
				$this->remoteQuery($bulkQuery,true);
		}

		return true;		

	}


	/*Update remote database*/
	public function remotePilot(){
		if(	
			$this->dropTable('r',false) && 
			$this->updateTable('r',false) && 
			$this->updateData('r',false) 
			)
			return true;

		return false;
	}


	/*Update local database*/
	public function localPilot(){
		if($this->dropTable('l',false) &&
		$this->updateTable('l',false) &&
		$this->updateData('l',false) )
			return true;

		return false;
	}



}
	

$Syncr = new Syncr;
	
	var_dump($Syncr->dropTable('r',false));
	var_dump($Syncr->updateTable('r',false));
	var_dump($Syncr->updateData('r',false));
	// var_dump($Syncr->remotePilot());
	
?>