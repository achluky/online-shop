<?php include "include/koneksi.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php" ?>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="padding-bottom:2px; padding-top:5px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Sayuran Potong</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Masakan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team">Team</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li style="padding-left: 15px; padding-right: 0px; margin-top:-2px">
                        <div>
                            <span class="fa-stack fa-2x" title="Bayar" >
                                <a class="page-scroll" href="#bayar" >
                                    <div id="warna" ><i class="fa fa-circle fa-stack-2x text-danger" style="color: gray;"></i></div>
                                    <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                                </a>
                            </span><strong id="count" style="color: red;">0</strong>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <?php
                    if(isset($_GET['cmd'])){
                        switch ($_GET['cmd']) {
                            case 'login':
                                @include "include/login.php";
                                exit();
                                break;
                            
                            default:
                                echo "<meta http-equiv='refresh' content='0,../sayuran-potong'>";
                                exit();
                                break;
                        }
                    }
                ?>
                <!--<div class="intro-lead-in">Selamat Datang Di Toko Sayuran Potong</div>-->
                <div class="intro-heading">Selamat Datang</div>
                <a href="#portfolio" class="page-scroll btn btn-xl">Pilih Menu</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Cara Pemesanan</h2>
                    <h3 class="section-subheading text-muted">Tiga Langkah Cara Memesan</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <a class="page-scroll" href="#portfolio">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">Pilih Menu Pesanan</h4>
                    <p class="text-muted">DeskripsDeskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat |DeskripsDeskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat |Deskripsi Singkat | </p>
                </div>
                <div class="col-md-4">
                    <a class="page-scroll" href="#bayar">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h4 class="service-heading">Isi Data Pemesanan</h4>
                    <p class="text-muted">DeskripsDeskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat |DeskripsDeskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat |Deskripsi Singkat | </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Pesananan Diantar</h4>
                    <p class="text-muted">DeskripsDeskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat |DeskripsDeskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat | Deskripsi Singkat |Deskripsi Singkat | </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <form action="pelanggan/?action=pemesanan#services" method="POST">
        <section id="portfolio" class="bg-light-gray">
            <div class="container">
                <?php
                    $a = 1;
                    $b = 1;
                    $c = 1;
                    $d = 1;
                    $n = 1;
                    $sarapan = array(array());
                    $mknSiang = array(array());
                    $mknMalam = array(array());
                    $all = array(array());
                    $query = "SELECT *FROM masakan ORDER BY id_masakan DESC";
                    $sql = PdoQuery($query);
                    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                        if($data['jenis']=="Sarapan"){
                            $sarapan[$a][1] = $data['id_masakan'];
                            $sarapan[$a][2] = $data['nama'];
                            $sarapan[$a][3] = $data['jenis'];
                            $sarapan[$a][4] = $data['keterangan'];
                            $sarapan[$a][5] = $data['foto'];
                            $sarapan[$a][6] = $data['harga'];
                            $sarapan[$a++][7] = $n++;
                        }elseif($data['jenis']=="Makan Siang"){
                            $mknSiang[$b][1] = $data['id_masakan'];
                            $mknSiang[$b][2] = $data['nama'];
                            $mknSiang[$b][3] = $data['jenis'];
                            $mknSiang[$b][4] = $data['keterangan'];
                            $mknSiang[$b][5] = $data['foto'];
                            $mknSiang[$b][6] = $data['harga'];
                            $mknSiang[$b++][7] = $n++;
                        }elseif($data['jenis']=="Makan Malam"){
                            $mknMalam[$c][1] = $data['id_masakan'];
                            $mknMalam[$c][2] = $data['nama'];
                            $mknMalam[$c][3] = $data['jenis'];
                            $mknMalam[$c][4] = $data['keterangan'];
                            $mknMalam[$c][5] = $data['foto'];
                            $mknMalam[$c][6] = $data['harga'];
                            $mknMalam[$c++][7] = $n++;
                        }
                        $all[$d][1] = $data['id_masakan'];
                        $all[$d][2] = $data['nama'];
                        $all[$d][3] = $data['jenis'];
                        $all[$d][4] = $data['keterangan'];
                        $all[$d][5] = $data['foto'];
                        $all[$d++][6] = $data['harga'];
                    }
                ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Menu Masakan</h2>
                        <h3 class="section-subheading text-muted">Terdapat Tiga Jenis Menu Masakan</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <div class="portfolio-caption" style="background: #fed136">
                            <p class="text-muted"><strong>Sarapan</strong></p>
                        </div>
                        <?php
                            if(count($sarapan) > 0){
                                for($i=1; $i<count($sarapan); $i++){ ?>                                    
                                    <div class="portfolio-item">
                                        <a href="#masakan_<?php echo $sarapan[$i][1]; ?>" class="portfolio-link" data-toggle="modal">
                                            <div class="portfolio-hover" style="background: rgba(0, 0, 0, 0.7);">
                                                <div class="portfolio-hover-content">
                                                    <i class="fa fa-eye fa-3x" title="Lihat Deskripsi <?php echo $sarapan[$i][2]; ?>"></i>
                                                </div>
                                            </div>
                                            <img src="<?php echo "img/masakan/".$sarapan[$i][5]; ?>" style="width: 100%; height: 250px;" class="img-responsive" alt="">
                                        </a>
                                        <div class="portfolio-caption">
                                            <h4><?php echo $sarapan[$i][2]; ?></h4>
                                            <p class="text-muted">Rp.<?php echo $sarapan[$i][6]; ?></p>
                                            <input type="checkbox" id="cek" name="pesanan[]" value="<?php echo $sarapan[$i][1]; ?>" onclick="updateJumlah(this);" onload="load();" style="width: 30px; height: 30px;">
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </div>

                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <div class="portfolio-caption" style="background: #fed136">
                            <p class="text-muted"><strong>Makan Siang</strong></p>
                        </div>
                        <?php
                            if(count($mknSiang) > 0){
                                for($i=1; $i<count($mknSiang); $i++){ ?>
                                    <div class="portfolio-item">
                                        <a href="#masakan_<?php echo $mknSiang[$i][1]; ?>" class="portfolio-link" data-toggle="modal">
                                            <div class="portfolio-hover" style="background: rgba(0, 0, 0, 0.7);">
                                                <div class="portfolio-hover-content">
                                                    <i class="fa fa-eye fa-3x" title="Lihat Deskripsi <?php echo $mknSiang[$i][2]; ?>"></i>
                                                </div>
                                            </div>
                                            <img src="<?php echo "img/masakan/".$mknSiang[$i][5]; ?>" style="width: 100%; height: 250px;" class="img-responsive" alt="">
                                        </a>
                                        <div class="portfolio-caption">
                                            <h4><?php echo $mknSiang[$i][2]; ?></h4>
                                            <p class="text-muted">Rp.<?php echo $mknSiang[$i][6]; ?></p>
                                            <input type="checkbox" id="cek" name="pesanan[]" value="<?php echo $mknSiang[$i][1]; ?>" onclick="updateJumlah(this);" style="width: 30px; height: 30px;">
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </div>

                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <div class="portfolio-caption" style="background: #fed136">
                            <p class="text-muted"><strong>Makan Malam</strong></p>
                        </div>
                        <?php
                            if(count($mknMalam) > 0){
                                for($i=1; $i<count($mknMalam); $i++){ ?>
                                    <div class="portfolio-item">
                                        <a href="#masakan_<?php echo $mknMalam[$i][1]; ?>" class="portfolio-link" data-toggle="modal">
                                            <div class="portfolio-hover" style="background: rgba(0, 0, 0, 0.7);">
                                                <div class="portfolio-hover-content">
                                                    <i class="fa fa-eye fa-3x" title="Lihat Deskripsi <?php echo $mknMalam[$i][2]; ?>"></i>
                                                </div>
                                            </div>
                                            <img src="<?php echo "img/masakan/".$mknMalam[$i][5]; ?>" style="width: 100%; height: 250px;" class="img-responsive" alt="">
                                        </a>
                                        <div class="portfolio-caption">
                                            <h4><?php echo $mknMalam[$i][2]; ?></h4>
                                            <p class="text-muted">Rp.<?php echo $mknMalam[$i][6]; ?></p>
                                            <input type="checkbox" id="cek" name="pesanan[]" value="<?php echo $mknMalam[$i][1]; ?>" onclick="updateJumlah(this);" style="width: 30px; height: 30px;">
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pembayaran -->
        <div id="pembayaran">
           
        </div>
    </form>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/1.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2009-2011</h4>
                                    <h4 class="subheading">Our Humble Beginnings</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/2.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>March 2011</h4>
                                    <h4 class="subheading">An Agency is Born</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/3.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>December 2012</h4>
                                    <h4 class="subheading">Transition to Full Service</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="img/about/4.jpg" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>July 2014</h4>
                                    <h4 class="subheading">Phase Two Expansion</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>Be Part
                                    <br>Of Our
                                    <br>Story!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/1.jpg" class="img-responsive img-circle" alt="">
                        <h4>Kay Garland</h4>
                        <p class="text-muted">Lead Designer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/2.jpg" class="img-responsive img-circle" alt="">
                        <h4>Larry Parker</h4>
                        <p class="text-muted">Lead Marketer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="team-member">
                        <img src="img/team/3.jpg" class="img-responsive img-circle" alt="">
                        <h4>Diana Pertersen</h4>
                        <p class="text-muted">Lead Developer</p>
                        <ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/envato.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Your Website 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->

    <!-- Portfolio Modal 1 -->
    <?php
        for($i=1; $i < count($all); $i++){ ?>
            <div class="portfolio-modal modal fade" id="masakan_<?php echo $all[$i][1]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="close-modal" data-dismiss="modal">
                            <div class="lr">
                                <div class="rl">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="modal-body">
                                        <!-- Project Details Go Here -->
                                        <h2><?php echo $all[$i][2]; ?></h2>
                                        <p class="item-intro text-muted">Menu <?php echo $all[$i][3]; ?></p>
                                        <img class="img-responsive img-centered" src="img/masakan/<?php echo $all[$i][5]; ?>" alt="">
                                        <p>
                                            <?php echo $all[$i][4]; ?>
                                        <p>
                                        <ul class="list-inline">
                                            <li>Harga: Rp.<?php echo $all[$i][6]; ?></li>
                                        </ul>
                                        <form action="" method="POST">
                                            <!--<button type="submit" class="btn btn-success" name="beli_satu" value="<?php echo $all[$i][1]; ?>"><i class="fa fa-shopping-cart"></i> Beli</button>-->
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    ?>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>


</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#data').DataTable();
    } );

    function updateJumlah(checkbox){
        //var j = parseInt(document.getElementById("jumlah"))+1;
        var b = document.getElementById("count").innerHTML;
        var x = parseInt(b);
        //alert(b);
        if (checkbox.checked){
            if(x == 0){
                document.getElementById("pembayaran").innerHTML="<section id='bayar' style='padding: 100px;'><div class='container'><div class='row'><div class='col-lg-12 text-center'><h2 class='section-heading'>Lengkapi <br>Data Pemesanan</h2><h3 class='section-subheading text-muted'>Apabila anda telah selesai memilih menu masakan, klik tombol <strong>SELANJUTNYA</strong> untuk melakukan proses pemesanan</h3><button type='submit' class='btn btn-info btn-lg' name='beli_banyak' value='true'><span class='glyphicon glyphicon-arrow-right'></span> SELANJUTNYA</button></div><div class='row'><div class='col-lg-12'></div></div></div></div></section><div class='bg-light-gray' style='height: 100px;'></div>";
            }
            x += 1;
            document.getElementById("count").innerHTML = ""+x;
            document.getElementById("warna").innerHTML = "<i class='fa fa-circle fa-stack-2x text-danger'></i>";
        }else{
            if(x <= 0){
                x = 0;
            }else{
                x -= 1;
            }
            if(x > 0){
                document.getElementById("count").innerHTML = ""+x;
                document.getElementById("warna").innerHTML = "<i class='fa fa-circle fa-stack-2x text-danger'></i>";
            }else{
                document.getElementById("count").innerHTML = "0";
                document.getElementById("pembayaran").innerHTML="";
                document.getElementById("warna").innerHTML = "<i class='fa fa-circle fa-stack-2x text-danger' style='color: gray;'></i>";
            }
        }
    }
</script>
