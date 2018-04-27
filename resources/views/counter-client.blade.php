<form action="counter-event" method="POST">
	<center>
		<button type="button" id="next" style="height: 200px; width: 450px; font-size: 50px;"> NEXT </button>	
	</center>
</form>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$("#next").on('click', function(){
		url = "/counter-event?counter=1";
		$.post({
		  type: "POST",
		  url: url
		});
	});
</script>