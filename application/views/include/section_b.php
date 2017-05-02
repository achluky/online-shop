<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Daftar Barang</h2>
                <h3 class="section-subheading text-muted">Temukan barang impian anda.</h3>
            </div>
        </div>
        <div class="row">
            <?php foreach($barang->result() as $b ) { ?>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="#barang_<?= $b->kode_barang ?>" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover" style="background: rgba(0, 0, 0, 0.7);">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                    </div>
                    <img src="<?php echo URL_."img/barang/".$b->foto; ?>" class="img-responsive fit-view" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4><?= $b->nama_barang ?></h4>
                    <p class="text-muted"><?= "Rp.".number_format($b->harga); ?></p><input type="checkbox" id="cek" name="pesanan[]" value="<?= $b->kode_barang; ?>" onclick="updateJumlah(this);" onload="load();" style="width: 30px; height: 30px;">
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php foreach($barang->result() as $b ) { ?>
<div class=" modal fade" id="barang_<?= $b->kode_barang ?>" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            
                <div class="modal-header">
                    <button type="back" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title"><?= $b->nama_barang ?></h4></center>
                </div>
                <div class="row">
                    <div class="modal-body" style="padding: 0px 30px 15px 30px">
                        <!-- Project Details Go Here -->
                        <!-- <h2>Project Name</h2>
                        <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p> -->
                        <img class="img-responsive img-centered " src="<?php echo URL_."img/barang/".$b->foto ?>" alt="" style="width:100%; padding-bottom: 10px;">
                        <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                        <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                        <!-- <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button> -->
                    </div>
                </div>
            
        </div>
    </div>
</div>
<?php } ?>