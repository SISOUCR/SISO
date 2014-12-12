<?php
/**
 *  Emilio Rojas
 *  2014
 *  Key
 *  Manages keys accepted to access the system
 */
class Key
{
	private static $accepted = array();
	private function __construct()
	{
		$this->set( 'sisoucr87436' , 'siso8721' , 'SISOSISO' );
	}

	/**
	 *  Key instance
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

	/**
	 *  set
	 *  sets accepted keys
	 *	indefinite amount of arguments, separated by comma,
	 *  each is an accepted key
	 */
	private function set() 
	{ 
    	foreach ( func_get_args() as $key ) 
    	{
	        self::$accepted[] = $key; 
	    }
		
		return $this; 
	}

	/**
	 *  isAccpted  
	 *  checks if a given key is ok to keep working
	 *  returns boolean
	 */
	public function isAccepted( $key )
	{
		$found = false;
		if ( in_array( $key , self::$accepted ) )
		{
			$found = true;
		}

		return $found;
	}
}