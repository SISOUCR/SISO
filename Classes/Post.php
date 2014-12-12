<?php
/*
Emilio Rojas
2014
*/

class Post extends Request
{
	
	public function createAccount( $user , $email , $pass )
	{
		$created = false;
		$userExists = $emailExists = false;
		$userResp = $emailResp = "";

		$userExists = $this->accountExists( 'username' , $user );
		$emailExists = $this->accountExists( 'email' , $email );
		$userResp = $userExists ? 'El nombre de usuario ya existe' : "";
		$emailResp = $emailExists ? 'El email ha sido registrado previamente' : "";

		$this->setResponse( $userResp . " " . $emailResp );

		if( $userExists || $emailExists )
		{
			return $created;
		}

		$this->connectDatabase();

		$pass = hash( $this->config->get( 'passEncrypt' ) , $this->config->get( 'passSalt' ) . $pass );
		$joinstamp = $activitystamp = microtime()/1000;
		$accountType = $this->config->get( 'accountType' );
		$joinIp = $_SERVER['REMOTE_ADDR'];

		try
		{
			$pref = $this->config->get( 'dbPref' );
			$stmt = self::$dbh
				->connection
				->prepare("INSERT INTO " . $pref . "base_user 
					       (username, email, password, joinStamp, activityStamp , accountType , emailVerify , joinIp ) 
					VALUES (?,        ?,        ?,        ?,         ?,              1,            1,         2)");
	
			$stmt->bindParam( 1 , $user , PDO::PARAM_STR );
			$stmt->bindParam( 2 , $email , PDO::PARAM_STR );
			$stmt->bindParam( 3 , $pass , PDO::PARAM_STR );
			$stmt->bindParam( 4 , $joinstamp , PDO::PARAM_STR );
			$stmt->bindParam( 5 , $activitystamp , PDO::PARAM_STR );

			$stmt->execute();
			$created = true;
			$this->setResponse('Se ha creado el usuario');

			$this->disconnectDatabase();
		}
		catch ( Exception $e )
		{
			$this->setResponse('El usuario no ha sido creado' . $e->getMessage() );
			$created = false;
		}
		
		return $created;
	}

	public function createEvent( $title, $description, $location, $startTimeStamp , $userId )
	{
		$created = false;
		$this->connectDatabase();

		try
		{
			$pref = $this->config->get( 'dbPref' );
			$now = microtime()/1000;
			$stmt = self::$dbh
				->connection
				->prepare("INSERT INTO " . $pref . "event_item 
					       (title, description, location, createTimeStamp, startTimeStamp  , userId , whoCanView , whoCanInvite , status , endTimeDisabled ) 
					VALUES (?,     ?,           ?,        " . $now . ",    ?,                ?,       1,           1,             1,       1)");
	
			$stmt->bindParam( 1 , $title , PDO::PARAM_STR );
			$stmt->bindParam( 2 , $description , PDO::PARAM_STR );
			$stmt->bindParam( 3 , $location , PDO::PARAM_STR );
			$stmt->bindParam( 4 , $startTimeStamp , PDO::PARAM_INT );
			$stmt->bindParam( 5 , $userId , PDO::PARAM_INT );

			$stmt->execute();
			$created = true;
			$this->setResponse('Se ha creado el evento');

			$this->disconnectDatabase();
		}
		catch ( Exception $e )
		{
			$this->setResponse('El evento no se ha creado: ' . $e->getMessage() );
			$created = false;
		}
		
		return $created;
	}
}
