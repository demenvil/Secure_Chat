<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ?></title>
		<link rel="stylesheet" type="text/css" href="/public/css/style.css">
	</head>
    <body>
        <?php echo Popup::display() ?>
        <?php echo $content ?>
         <script src="/public/js/jquery-2.1.1.min.js"></script>
         <script src="/public/js/ajax.js"></script>
         </body>
</html>
