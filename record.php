<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
			FredTools-录音
		</title>
    	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	</head>
	<body>
		<?php echo '<form action="recorded.php?timu='.$_GET['timu'].'" method="post">';?>
        	<h1>请点击录音：<input type="file" accept="audio/*" capture="microphone" name="Upload"></h1>
        </form>
	</body>
</html>