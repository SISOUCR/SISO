<?php
/*
Emilio Rojas
2014

This class allows to make a single instance 
of a database using the singleton pattern

This class uses the php PDO object, 
for a reference pleaso go to 
http://php.net/manual/es/book.pdo.php
*/
class Database
{
	//MAIN DATABASE SETTINGS
	private $host;
	private $user;
	private $pass;
	private $name;

	//DATABASE OBJECT
	public $connection;
	private static $instance;


	private function __construct()
	{

		$this->getParams();

		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;

		//connection to database
		$this->connection = new PDO( $dsn , $this->user , $this->pass );
		$this->connection->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
	}

	public static function getInstance()
	{
		if( !isset( self::$instance ) )
		{
			$obj = __CLASS__;
			self::$instance = new $obj;
		}
		return self::$instance;
	}


	private function getParams()
	{
		try
		{
			$config = Config::getInstance();
			$this->host = $config->get( 'dbHost' );
			$this->user = $config->get( 'dbUser' );
			$this->pass = $config->get( 'dbPass' );
			$this->name = $config->get( 'dbName' );
		}
		catch ( Exception $e )
		{
			print $e->getMessage();
			die();
		}
	}
}