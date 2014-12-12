<?php
/**
 *  Emilio Rojas
 *  2014
 *  Config
 *  manages settings
 */
class Config
{
	/**
	 * Constructor
	 * sets settings
	 */
	private function __construct()
	{
		$this->set( 'appName' , 'SISO' )
		     ->set( 'appUrl' , 'http://siso.esy.es/ow/' )

		     ->set( 'dbHost' , 'mysql.hostinger.es' )
		     ->set( 'dbUser' , 'u112869436_siso' )
		     ->set( 'dbPass' , 'colacho117' )
		     ->set( 'dbName' , 'u112869436_ow' )
		     ->set( 'dbPref' , 'ow_' )
		       
		     ->set( 'passSalt' , '54890f8dbc8dc')
		     ->set( 'passEncrypt' , 'sha256')

		     ->set( 'accountType' , '290365aadde35a97f11207ca7e4279cc' );
	}

	/**
	 *  Array config
	 *  Holds man settings	   
	 */
	private static $config = array();

	/**
	 *  Config instance
	 *  Singleton
	 */
	private static $instance;
	public static function getInstance()
	{
		if( !isset( self::$instance ) )
		{
			$obj = __CLASS__;
			self::$instance = new $obj;
		}
		return self::$instance;
	}

	private function set( $name , $val , $replace=false )
	{
		if ( isset( self::$config[$name] ) && $replace === false )
		{
			throw new Exception( "La opción indicada ya existe" , 1 );
		}
		else
		{
			self::$config[$name] = $val;
		}

		return $this;
	}

	public function get( $name )
	{
		$val = "";
		if ( isset( self::$config[$name] ) )
		{
			$val = self::$config[$name];
		}
		else
		{
			throw new Exception("La opcion " . $name . " no existe", 1);
		}

		return $val;
	}
}