<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>
    <link href="<?= URL_?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL_?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= URL_?>css/animate.css" rel="stylesheet">
    <link href="<?= URL_?>css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <h3 class="font-bold"><?php echo $heading; ?></h3>
        <div class="well">
			<?php echo $message; ?>
			<a href="<?= URL_ ?>dashboardFMC" class="btn btn-primary m-t">Dashboard</a>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?= URL_?>js/jquery-2.1.1.js"></script>
    <script src="<?= URL_?>js/bootstrap.min.js"></script>
</body>
</html>