<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Student Logs</title>
        {{-- <script src="{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script> --}}
        <link rel="stylesheet" href="css/app.css">
</head>
<body>

<div id="app">
        
        	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img src="images/banner_final.jpg" width="100%">
			     
			    </div>
			    <div class="item">
			      <img src="images/banner-cpa.jpg" width="100%">
			    </div>
			    <div class="item">
			      <img src="images/banner1.jpg" width="100%">
			    </div>
			    <div class="item">
			      <img src="images/banner4.jpg" width="100%">
			    </div>
			    {{-- <div class="item">
			      <img src="images/banner3.jpg" alt="...">
			    </div> --}}
			   
			  </div>

			  <!-- Controls -->
			 
			</div>

        
        <data-message></data-message>
        
</div>


<script src='js/app.js' charset="utf-8"></script>



</body>
</html>