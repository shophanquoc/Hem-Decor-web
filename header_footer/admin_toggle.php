<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    </head>
    <body id = "admin">
        <div class="topbar">
			<div class="toggle" onclick="toggleMenu()"></div>
		</div>
		<script type="text/javascript">
		function toggleMenu(){
			let navigation = document.querySelector('.navigation');
			let toggle = document.querySelector('.toggle');
			let main = document.querySelector('.main');
			navigation.classList.toggle('active');
			toggle.classList.toggle('active');
			main.classList.toggle('active');
		}
	</script> 
    </body>
</html>