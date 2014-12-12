<?php

include_once 'init.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = NULL;
$response = array( 'status' => false , 'data' => array() , 'error' => 'La petición no ha sido procesada.' );

if ( $method == 'GET' ) { $request = $_GET; }
else if ( $method == 'POST' ) { $request = $_POST; }

if ( $request === NULL )
{
	$jr = json_encode( $response );
	print $jr;
	die();
}

$keyAccepted = false;
$apiKey = "";
$key = Key::getInstance();

if ( $request != NULL && isset( $request['apiKey'] ) )
{	
	$response['error'] = 'No se ha podido realizar su pedido';
	$apiKey = $request['apiKey'];
}

if ( $key->isAccepted( $apiKey ) )
{
	$response['error'] = 'No se ha solicitado una acción';
	switch ( $request['action'] )
	{
		case 'postCreateAccount':
		$response['error'] = 'No se han recibido los datos correctos';
		if ( isset( $request['user'] , $request['email'] , $request['pass'] ) )
		{
			$post = new Post;
			$created = $post->createAccount( $request['user'] , $request['email'] , $request['pass'] );
			$response['status'] = true;
			$response['data'] = array( 'created' => $created , 'message' => $post->getResponse() );
			$response['error'] = '';
		}
			break;

		case 'postCreateEvent':
		$response['error'] = 'No se han recibido los datos correctos';
		if ( isset( $request['title'] , $request['description'] , $request['location'] , $request['startTimestamp'] , $request['userId'] ) )
		{
			$post = new Post;
			$created = $post->createEvent( $request['title'] , $request['description'] , $request['location'] , $request['startTimestamp'] , $request['userId'] );
			$response['status'] = true;
			$response['data'] = array( 'created' => $created , 'message' => $post->getResponse() );
			$response['error'] = '';
		}
			break;

		case 'getLogin':
		$response['error'] = 'No se han recibido los datos correctos';
		if ( isset( $request['user'] , $request['pass'] ) )
		{
			$get = new Get;
			$logged = $get->login( $request['user'] , $request['pass'] );
			$response['status'] = true;
			$response['data'] = array( 'logged' => $logged , 'message' => $get->getResponse() );
			$response['error'] = '';
		}
			break;

		case 'getEvents':
		$response['error'] = 'No se han recibido los datos correctos';
		if ( isset( $request['user'] , $request['pass'] , $request['first'] , $request['count'] ) )
		{
			$get = new Get;
			$login = $get->login( $request['user'] , $request['pass'] );
			$data = $get->getEvents();
			$response['status'] = true;
			$response['data'] = $data;
			$response['error'] = "";


		}
			break;

		default:
			$response['error'] = 'La acción solicitada no existe';
			break;
	}

}

header( 'Content-Type: application/json; charset=utf-8' );
$jsonResponse = json_encode( $response );
print $jsonResponse;
