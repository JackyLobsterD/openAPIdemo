<?php
	require_once( 'lib/snappay-sign-utils.php' );

	//MUST keep sign key secretly. Best to load from somewhere else, like database.
	$signKey = '42fa0a3a1bf293f9c58d556ac1b67ea0';

	if(!isset($_REQUEST['out_order_no']) || !isset($_REQUEST['merchant_no']) || !isset($_REQUEST['notify_url'])
		|| empty($_REQUEST['out_order_no']) || empty($_REQUEST['merchant_no']) || empty($_REQUEST['notify_url'])
		){
		echo 'out_order_no, merchant_no or notify_url can\'t be null'; 
	}else{
		$out_order_no = $_REQUEST['out_order_no'];
		$merchant_no = $_REQUEST['merchant_no'];
		$notify_url = $_REQUEST['notify_url'];
		if(isset($_REQUEST['sign_key']) && !empty($_REQUEST['sign_key'])){
			$signKey = $_REQUEST['sign_key'];
		}

		$post_data = array(
	            'charset' => 'UTF-8',
	            'version' => '0.01',
	            'sign_type' => 'MD5',

	            'out_order_no' => $out_order_no,
	            'merchant_no' => $merchant_no,
	            'method' => 'pay.notify',
	            'trans_status' => 'SUCCESS'
	        );

		$post_data_sign = snappay_sign_post_data($post_data, $signKey);

		//echo print_r($post_data_sign);

		$url = $notify_url;

		$options = array(
		  'http' => array(
		    'method'  => 'POST',
		    'content' => json_encode( $post_data_sign ),
		    'header'  =>  "Content-Type: application/json\r\n"."Accept: application/json\r\n"
		    )
		);

		$context  = stream_context_create( $options );
		$result = file_get_contents( $url, false, $context );
		echo $result;

	}

?>
