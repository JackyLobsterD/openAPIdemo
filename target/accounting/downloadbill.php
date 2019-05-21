<?php
	require_once( 'lib/snappay-sign-utils.php' );

	//MUST keep sign key secretly. Best to load from somewhere else, like database.
	$signKey = '42fa0a3a1bf293f9c58d556ac1b67ea0';
	$app_id = '6bf9403d0c97bd24';

	if( !isset($_REQUEST['trans_date']) || !isset($_REQUEST['merchant_no'])){
		echo 'trans_date and merchant_no can\'t be null'; 
	}else{
		$trans_date = $_REQUEST['trans_date'];
		$merchant_no = $_REQUEST['merchant_no'];

		if(!empty($_REQUEST['sign_key'])){
			$signKey = $_REQUEST['sign_key'];
		}

		// Must be UTC time here
		$timestamp = date_create('',timezone_open("UTC"));
		$timestamp = date_format($timestamp, 'Y-m-d H:i:s');

		$post_data = array(
			'app_id' => $app_id,
            'format' => 'JSON',
            'charset' => 'UTF-8',
            'version' => '1.0',
            'timestamp' => $timestamp,
            'sign_type' => 'MD5',

			'method' => 'accounting.downloadbill',
            'trans_date' => $trans_date,
            'merchant_no' => $merchant_no
	        );

		$post_data_sign = snappay_sign_post_data($post_data, $signKey);

		//echo print_r($post_data_sign);

		$url = 'http://open-test.snappay.ca/api/gateway';

		$options = array(
			'http' => array(
			    'method'  => 'POST',
			    'header'  => "Content-Type: application/json\r\n"."Accept: application/json\r\n",
			    'content' => json_encode($post_data_sign)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { 
			//Handle error 
		}

		//var_dump($result);

		$result = preg_replace('#&(?=[a-z_0-9]+=)#', '&amp;', $result);

		echo $result;
		
	}

?>
