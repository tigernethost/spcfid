<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Student Logs</title>
        {{-- <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script> --}}
        <link rel="stylesheet" href="css/app.css">
</head>
<body>

<div id="app">
        <h2>SPCF RFID</h2>
        
        <data-message></data-message>
        
</div>


<script src='js/app.js' charset="utf-8"></script>



</body>
</html>