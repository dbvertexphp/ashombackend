<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verfications : Ashoms.App</title>
    <link rel="icon" href="https://www.ashom.app/assets/logo2.svg" type="image/svg" />
    <style>
        body{
            background-color: #eee;
        }
        #confirm_dialog{
            border: 1px solid grey;
            box-shadow: 2px 2px 5px 2px #aaa;
            width: 350px;
            height: 250px;
            position: fixed;
            top: 40%;
            left: 50%;
            background-color: white;
            transform: translate(-50%, -50%);
            border-radius: 5px;
        }
        #confirm_dialog::after{
            content: "Powered by : Ashom.App";
            position: absolute;
            bottom: -40px;
            color: grey;
            left: 50%;
            transform: translateX(-50%);
          	width: fit-content;
          	text-align: center;
        }
        #donetick{
            width: 70px;
            height: 70px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 50px;
        }
        h1{
            top: 42%;
            width: fit-content;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }
        span{
            top: 83%;
            position: absolute;
            color: grey;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <div id="confirm_dialog">
        <img id="donetick" src="https://www.pinclipart.com/picdir/big/155-1555769_home-inspections-done-right-check-mark-clipart.png" alt="">
        <h1>Your Email Address has been Verified</h1>
        <span><?=$email?></span>
    </div>
</body>
</html>
