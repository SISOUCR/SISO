<?php
/*
Emilio Rojas
2014
*/
class Get extends Request
{
	/*
	Returns boolean
	Stores user id if logged
	App stores wether user is logged or not,
	App stores username and password(in some way)
	*/
	public function login( $user , $pass )
	{

		$isLogged = false;

		$this->setResponse("No se ha tramitado la acción");
		try
		{
			$this->connectDatabase();
			$pass = hash( $this->config->get( 'passEncrypt' ) , $this->config->get( 'passSalt' ) . $pass );
			$stmt = self::$dbh->connection->prepare( 'SELECT id FROM ' . $this->config->get( 'dbPref' ) . 'base_user WHERE username=? AND password=? LIMIT 1' );
			$stmt->setFetchMode( PDO::FETCH_ASSOC );

			$stmt->bindParam( 1 , $user , PDO::PARAM_STR );
			$stmt->bindParam( 2 , $pass , PDO::PARAM_STR );

			$stmt->execute();
			$stmt->setFetchMode( PDO::FETCH_ASSOC );
			$data = $stmt->fetchall();
			$this->disconnectDatabase();
		}
		catch ( Exception $e )
		{
			$this->errorMessage = $e->getMessage();
			$this->setResponse( 'Ocurrió un problma con la base de datos' );
			return $isLogged;
		}
		if( count( $data ) == 1 )
		{
			$this->userId = $data[0]['id'];
			$isLogged = true;
			$this->setResponse( 'Se ha logueado correctamente' );
		}
		else
		{
			$isLogged = false;
			$this->setResponse( 'El usuario o contraseña es incorrecta' );
		}

		return $isLogged;
	}

	public function getEvents( $first=1 , $count=10 )
	{
		try
		{
			$max = $first+$count-1;
			$min = $first;
			$this->connectDatabase();

			$stmt = self::$dbh
					->connection
					->prepare('SELECT id, title, description, location, startTimestamp FROM ' . $this->config->get( 'dbPref' ) . 'event_item WHERE id>=? AND id<=?');
			$stmt->setFetchMode( PDO::FETCH_ASSOC );

			$stmt->bindParam( 1 , $min , PDO::PARAM_INT );
			$stmt->bindParam( 2 , $max , PDO::PARAM_INT );

			$stmt->execute();
			$data = $stmt->fetchall();
			$this->disconnectDatabase();
		}
		catch ( Exception $e )
		{
			$this->errorMessage = $e->getMessage();
			$this->setResponse( 'Ocurrió un problma con la base de datos' );
			return false;
		}

		$this->setResponse( 'Se han obtenido los eventos' );
		return $data;
	}
}