<?php

class Syncr{
	public $remoteDb = 'adexsimp_csmtsms';
	public $localDb = 'csmt';
	public $remote, $local;

	public function __construct(){
		//$this->remote = new mysqli('192.254.235.133:3306','goldng_test','goldng_test',$this->remoteDb);

		//$this->remote = new mysqli('192.185.236.198:3306','goldng_wrdp2','mXbWImWfxIt6NdA',$this->remoteDb);
		$this->remote = new mysqli('192.254.236.51:3306','adexsimp_csmt','Acc355c0d35',$this->remoteDb);
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
	public  function localQuery($query,$multi=false){
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
	public  function remoteQuery($query,$multi=false){

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





	/*See currently running script*/
	public function processList($loc='r'){

		$query = 'SHOW FULL PROCESSLIST';

		/*Drop local database tables*/
		if(self::isLocal($loc))
			$list = $this->localQuery($query);

		/*Drop remote database*/
			else if(self::isRemote($loc))
				$list = $this->remoteQuery($query);
		return $list;
	}


}
	

$Syncr = new Syncr;
	
	$locTables = $Syncr->localQuery('SHOW TABLES FROM '.$Syncr->localDb);
	$locTables = $locTables->num_rows;

		
	$remTables = $Syncr->remoteQuery('SHOW TABLES FROM '.$Syncr->remoteDb);
	$remTables = $remTables->num_rows;

	/*Check current process*/
	$process = $Syncr->processList('r')->fetch_array()['State'];

	if(strtolower($process) == 'unlocking tables'){
		$done = round((($locTables - $remTables) / $locTables) * 100,0);
		echo "<div class='progress'>    
				<div class='progress-bar progress-bar-primary' style='width:".$done."%'>Removing old data</div>
			</div>";
	}

	else if(strtolower($process) == 'creating table'){
		$done = round(($remTables / $locTables) * 100,0);
		echo "<div class='progress'>    
				<div class='progress-bar progress-bar-primary' style='width:".$done."%'>Uploading latest data</div>
			</div>";

		// echo '<h1 class="alert alert-success">'.$remTables.' of '.$locTables.' uploaded...</1>';
	}
	else
		echo '<h5 class="alert alert-warning"><i class="fas fa-circle-o-notch fa-spin"></i> Saving changes, please wait, this process will take some few minutes</h>';
	
?>
