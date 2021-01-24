<?php include 'day.class.php'; ?>
<?php include 'month.class.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Calendar</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div style="display: flex;justify-content: space-between;">
		<div>
			<?php
				for ($i=1; $i <= 12 ; $i++) {
					$calendar = new Month($i, 2021);
					echo '<h1>Month '.$i.'</h1>';
					echo $calendar->get_calendar();
				}
			?>
		</div>
	</div>

	
</body>
</html>

