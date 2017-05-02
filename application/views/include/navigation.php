<!-- Navigation -->
    <?php if(isset($_POST)) { ?>
        <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top affix">
    <?php } else { ?>
        <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <?php } ?>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Online Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#pemesanan">Pemesanan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Belanja</a>
                    </li>
                    <li class="dropdown">
                        <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;">Kategori <span class="caret"></span></a>
                        <ul class="dropdown-menu btn-primary">
                            <?php foreach ($kategori->result() as $kat) { ?>
                                <li><a href="<?= URL_ ?>belanja/kategori/<?= $kat->kode_kategori ?>" style="color: #555"><?= $kat->nama_kategori ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!-- <li>
                        <a class="page-scroll" href="#tentang">Tentang</a>
                    </li> -->
                    <li>
                        <a class="page-scroll" href="#kontak">Kontak</a>
                    </li>
                    <?php if($is_pelanggan) { ?>
                    <li>
                        <a  class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;" href='<?= URL_ ?>signout'><?= $session_data['nama'] ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu btn-primary">
                            <li>
                                <a href="<?= URL_ ?>" style="color: #555">Riwayat Pemesanan</a>
                            </li>
                            <li>
                                <a href="<?= URL_ ?>" style="color: #555">Edit Profil</a>
                            </li>
                            <li>
                                <a href="<?= URL_ ?>signout" style="color: #555">Logout</a>
                            </li>                     
                        </ul>
                    </li>
                    <?php } else { ?>
                    <li>
                        <a  data-toggle="modal" href='#login'>Login</a>
                    </li>
                    <?php } 
                    $this->load->view('include/cart');
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<!-- Navigation -->
