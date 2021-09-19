<html>
  <head>
    <title>Index Page</title>
  </head>
  <body>
    <h1>Index Page</h1>
    <p>this is test View.</p>
	<p><?php echo "string from controller: $string" ?></p>
	<p>langs from controller:</p>
	<ol>
		<?php
			foreach($langs as $l){
				print("<li>$l</li>");
			}
		?>
	</ol>
  </body>
</html>
