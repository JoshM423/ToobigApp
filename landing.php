<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Landing Page</title>
    <meta charset="=utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1">
    <link rel="stylesheet" href="landing.css">
   
</head>
<body>
    <div id="left-frame">
       
        <button class="button" onclick="openAnalytics()">Analytics</button>
        <button class="button" id="Accounts">Accounts</button>
        <button class="button" onclick="openSalesInvoice()">Sales Invoice</button>
        <button class="button" onclick="openSettings()">Settings</button>
    </div>
    <script type="text/javascript">
    document.getElementById("Accounts").onclick = function () {
        location.href = "clients.php";
    };
    </script>

    
</body>
</html>
