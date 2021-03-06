
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Snappay mobile payment demo</title>
</head>

<?php
	require_once( 'lib/snappay-sign-utils.php' );

	//MUST keep sign key secretly. Best to load from somewhere else, like database.
	$signKey = '42fa0a3a1bf293f9c58d556ac1b67ea0';
	$app_id = '6bf9403d0c97bd24';

	$trans_amount = $_REQUEST['trans_amount'];
	$payment_method = $_REQUEST['payment_method'];
	$out_order_no = $_REQUEST['out_order_no'];
	$timestamp = $_REQUEST['timestamp'];
	$notify_url = $_REQUEST['notify_url'];
	$description = $_REQUEST['description'];
	$merchant_no = $_REQUEST['merchant_no'];
	
	$auth_code = $_POST['auth_code'];

	$post_data = array(
            'app_id' => $app_id,
            'format' => 'JSON',
            'charset' => 'UTF-8',
            'sign_type' => 'MD5',
            'version' => '1.0',
            'timestamp' => $timestamp,

            'method' => 'pay.barcodepay',
            'merchant_no' => $merchant_no,
            'payment_method' => $payment_method,
            'out_order_no' => $out_order_no,
            'trans_amount' => $trans_amount,
            'notify_url' => $notify_url,
            'auth_code' => $auth_code,
            'description' => $description
        );

	$post_data_sign = snappay_sign_post_data($post_data, $signKey);

	//echo print_r($post_data_sign);

	$url = 'http://open-test.snappay.ca/api/gateway';

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

	//var_dump($result);

	$result = preg_replace('#&(?=[a-z_0-9]+=)#', '&amp;', $result);
	echo $result;

?>

<body>
	
</body>
</html>
