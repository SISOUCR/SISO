<?php
/*
Emilio Rojas
2014
*/

class Request
{

	/*
	Boolean logged
	Is the user making the request logged or not
	*/
	protected $logged;

	/*
	Response
	*/
	protected $response;

	/*
	Int userId
	User id
	*/
	protected $userId = NULL;

	/*
	String username
	User Name
	*/
	protected $username;

	/*
	String errorMessage
	In case we catch an exception, it´s 
	message should be stored here
	Also works as a way to check wether any
	error has ocurred
	*/
	protected $errorMessage = NULL;


	/*
	PDO database
	PDO object of the datbase
	*/
	protected static $dbh = NULL;


	/*
	Config config
	Config object
	*/
	protected $config;


	/* Getters */
	public function getErrorMessage() { return $this->errorMessage; }
	public function getId() { return $this->userId; }
	public function getResponse() { return $this->response; }

	/* Setters */
	public function setErrorMessage( $errorMessage ) { $this->errorMessage = $errorMessage; return $this; }
	public function setResponse( $response ) { $this->response = $response; return $this; }


	/*
	Sets our PDO object in Request object
	http://php.net/manual/es/class.pdostatement.php
	*/
	protected function connectDatabase()
	{
		$this->config = Config::getInstance();
		if( self::$dbh == NULL )
		{
			try
			{
				$instance = Database::getInstance();
				self::$dbh = $instance;
			}
			catch ( Exception $e )
			{
				$this->errorMessage = $e->getMessage();
				die();
			}
		}
	}

	/*
	Disconnect database from object
	*/
	protected function disconnectDatabase()
	{
		self::$dbh = NULL;
	}

	protected function accountExists( $column , $val )
	{
		$exists = true;
		$count = 0;
		
		if( $column != 'username' && $column != 'email' )
		{
			throw new Exception("El argumento no es valido", 1);
			return NULL;
		}

		$this->connectDatabase();
		$pref = $this->config->get( 'dbPref' );
		if( $column == 'username' )
		{
			$stmt = self::$dbh->connection->prepare( "SELECT id FROM " . $pref . "base_user WHERE username=? " );
		}
		else if( $column == 'email' )
		{
			$stmt = self::$dbh->connection->prepare( "SELECT id FROM " . $pref . "base_user WHERE email=? " );
		}
		else
		{
			return NULL;
		}

		try
		{
			$stmt->bindParam( 1 , $val , PDO::PARAM_STR );
			$stmt->execute();
			$stmt->setFetchMode( PDO::FETCH_NUM );
			$count = $stmt->fetchall();
			$count = count($count);
		}
		catch ( Exception $e )
		{
			$exists = true;
			return $exists;
		}

		$this->disconnectDatabase();

		if ( $count == 0 )
		{
			$exists = false;
		}

		return $exists;
	}
}