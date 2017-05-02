<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Shop</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= URL_ ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= URL_ ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="<?= URL_ ?>css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->
    <style type="text/css">
        .fit-view{
          width: 100%;
          min-height: 250px;
          height: auto;
          object-fit: cover;
          background-position: center center;
          background-repeat: no-repeat;
          overflow: hidden;
        }
    </style>

</head>
<header>
    <div class="container">
        <div class="intro-text">
            <center>
                <div id="login">
                    <div class="panel panel-primary" style="box-shadow:0 0px 0px 0px #87B0D4;max-width:90%; width:500px;height:30%;max-height:70%;background-color:rgba(0,0,0,0.0); border:0px;">
                        <form action="signin/auth" method="POST">
                            <div id="form-user" class="form-group " style="">
                                <input id="username" type="text" name="username" class="form-control" placeholder="Nama Pengguna" style="color:white;font-size:20px;height:50px;background-color:rgba(0,0,0,0.6);">
                            </div>
                            <div id="form-pass" class="form-group ">
                                <input id="password" type="password" name="password" class="form-control" placeholder="Kata Sandi" style="color:white;font-size:20px;font-size:20px;height:50px;background-color:rgba(0,0,0,0.6);">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Login" style="font-size:20px;width:100%;height:50px;background-color:rgba(254, 209, 36, 0.85);">
                        </form>
                    </div>
                </div>
            </center>
        </div>
    </div>
</header>

<?php $this->load->view('include/js'); ?>