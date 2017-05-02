<!-- Navigation -->
    <?php
        $custom = "";
        if(!isset($_GET['menu'])){
            $custom = "navbar-custom";
        }
        echo"
            <nav id='mainNav' class='navbar navbar-default $custom navbar-fixed-top'>
        ";
    ?>
    
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="../">Sayuran Potong</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="?menu=pesanan">Pesanan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="?menu=masakan">Masakan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="?menu=pelanggan">Pelanggan</a>
                    </li>
                    <li class="dropdown">
                        <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;">Admin<span class="caret"></span></a>
                            
                            <ul class="dropdown-menu">
                                <li><a href="?menu=profil" style="color: #555">Ganti Password</a></li>
                                <li><a href="?cmd=logout" style="color: #555">Logout</a></li>
                            </ul>
                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<!-- Navigation -->