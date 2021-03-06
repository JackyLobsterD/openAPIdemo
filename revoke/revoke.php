<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Revoke Order</title>
    <style>
        body {
            width: 100%;
            height: 100%;
        }
        
        * {
            box-sizing: border-box;
            font-family: Helvetica;
            margin: 0;
            padding: 0;
        }
        
        .header-canvas {
            background-color: #023594;
            width: 100%;
            height: 95px;
            padding: 10px 40px;
        }
        
        .header-canvas img {
            margin: 20px 1em 0 0;
            height: 40px;
            width: 200px;
            cursor: pointer;
        }
        
        .header-canvas div {
            width: 25px;
            display: inline;
            vertical-align: top;
            color: white;
            font-size: 14px;
            line-height: 80px;
            letter-spacing: 0.15px;
            margin-right: 1em;
        }
        
        .header-line {
            border-left: thin solid #FFFFFF;
            height: 17px;
            width: 186px;
            padding: 0.5%;
            opacity: 0.22;
        }
        
        .body-canvas {
            padding: 40px;
            width: 100%;
        }
        
        h1 {
            font-size: 22px;
            color: #023594;
            padding: 0;
            margin: 70px 0 47px 25.75%;
        }
        
        h2 {
            color: #023594;
            font-size: 16px;
            margin: 29px 0 10px 25.75%;
            font-weight: 100;
        }
        
        .red-required {
            color: red;
            margin-right: 0.2em;
        }
        
        .entry-box {
            width: 49%;
            padding: 1.25%;
            border: 0.75px solid #023594;
            border-radius: 6px;
            overflow: hidden;
            margin: 0 auto;
        }
        
         .payment-dropdown {
            width: 49%;
            border: 0.75px solid #023594;
            border-radius: 6px;
            margin: 0 auto auto 25.5%;
            background-color: white;
            font-size: 16px;
        }
        
        select{
        	color: #4A4A4A;
         	height: 3.5em;  
        }

        input {
            width: 571px;
            color: #4A4A4A;
            font-size: 16px;
            border: none;
        }
        
        input:focus {
            outline: none;
        }
        
        .button {
            height: 30%;
            width: 49%;
            padding: 1.25%;
            border: 0.75px solid #023594;
            border-radius: 6px;
            background-color: #023594;
            margin: 40px auto 0 25.5%;
            cursor: pointer;
        }
        
        .button div {
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        
        .footer-canvas {
            background-color: #023594;
            width: 100%;
            height: 140px;
            padding: 10px 50px;
            margin-top: 20%;
        }
        
        .footer-canvas img {
            margin: 40px 0 0 0;
            height: 40px;
            width: 200px;
            position: absolute;
        }
        
        .footer-canvas div div {
            margin-top: 30px;
            float: right;
            clear: both;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header-canvas">
        <img class="header-logo-image" src="./snappay-logo.png" alt="SnapPay">
        <div class="header-line"></div>
        <div>Trusted Payment Platform</div>
    </div>
    
	<?php
		$milliseconds = round(microtime(true) * 1000);
		$milliseconds = substr($milliseconds, 3);
		$randnum = rand(100, 999);
		$orderId = $milliseconds.$randnum;
	?>

    <form action="cancelorder.php" method="post" class="body-canvas">


        <h1>Revoke Order</h1>

        <div>
            <h2><span class= "red-required">*</span>Out Order No.</h2>
            <div class="entry-box">
                <input type="text" name="out_order_no">
            </div>
        </div>

        <div>
            <h2><span class= "red-required">*</span>Sign Key</h2>
            <div class="entry-box">
                <input type="text" name="sign_key" value="7e2083699dd510575faa1c72f9e35d43">
            </div>
        </div>
        
        <div>
            <h2><span class= "red-required">*</span>Merchant No.</h2>
            <div class="entry-box">
                <input type="text" name="merchant_no" value="901800000116">
            </div>
        </div>

        <div>
            <button class="button" type="submit" >
                <div>Create Order</div>
            </button>
                <a href="../demo.zip">Download PHP Demo files</a>

        </div>

    </form>

    <div class="footer-canvas">
        <img class="header-logo-image" src="./snappay-logo.png" alt="SnapPay">
        <div>
            <div>Custom Service: 1-888-660-7729</div>
            <div>4307 Village Centre Court, Mississauga, ON, L4Z 1S2</div>
        </div>
    </div>

</body>

</html>
