
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Snappay mobile payment demo</title>
</head>

<?php
	require_once( 'lib/snappay-sign-utils.php' );

	//MUST keep sign key secretly. Best to load from somewhere else, like database.
	$signKey = '7e2083699dd510575faa1c72f9e35d43';
	$app_id = '9f00cd9a873c511e';
	
	//Initializing variable
	$trans_amount = "";
	$payment_method = "";
	$out_order_no = "";
	$timestamp = "";
	$notify_url = "";
	$description = "";
	$merchant_no = "";
	$return_url = "";
	$browser_type = "";
	
	$trans_amount = isset($_REQUEST['trans_amount'])? $_REQUEST['trans_amount'] : '';
	$payment_method = isset($_REQUEST['payment_method'])? $_REQUEST['payment_method'] : '';
	$out_order_no = isset($_REQUEST['out_order_no'])? $_REQUEST['out_order_no'] : '';
	$timestamp = isset($_REQUEST['timestamp'])? $_REQUEST['timestamp'] : '';
	$notify_url = isset($_REQUEST['notify_url'])? $_REQUEST['notify_url'] : '';
	$description = isset($_REQUEST['description'])? $_REQUEST['description'] : '';
	$merchant_no = isset($_REQUEST['merchant_no'])? $_REQUEST['merchant_no'] : '';
	
	$return_url = isset($_REQUEST['return_url'])? $_REQUEST['return_url'] : '';
	$browser_type = isset($_REQUEST['browser_type'])? $_REQUEST['browser_type'] : '';

	$post_data = array(
        'app_id' => $app_id,
        'format' => 'JSON',
        'charset' => 'UTF-8',
        'sign_type' => 'MD5',
        'version' => '1.0',
        'timestamp' => $timestamp,

        'method' => 'pay.webpay',
        'merchant_no' => $merchant_no,
        'payment_method' => $payment_method,
        'out_order_no' => $out_order_no,
        'trans_amount' => $trans_amount,
        'notify_url' => $notify_url,
        'return_url' => $return_url,
        'description' => $description,
        'browser_type' => $browser_type
    );

	$post_data_sign = snappay_sign_post_data($post_data, $signKey);

	//echo print_r($post_data_sign);

	$url = 'https://open.snappay.ca/api/gateway';

	$options = array(
		'http' => array(
		    'method'  => 'POST',
		    'header'  =>  "Content-Type: application/json\r\n"."Accept: application/json\r\n",
		    'content' => json_encode($post_data_sign)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) {  
		//Handle error  
	}

	var_dump($result);
	
	$result_json = json_decode($result, true);
	if($result_json['code'] === '0'){
		$webpay_url = $result_json['data'][0]['webpay_url'];
		//echo print_r($webpay_url);
		header('Location: '.$webpay_url);
		exit();
	}

?>

<body>
	
</body>
</html>
