<?php 

if(isset($_POST['beli_banyak']) || isset($_POST['beli_satu'])) { 
/*extract($_POST);
$id_masakan = "";
$jml_pesanan = count($pesanan);
for($i=0; $i < count($pesanan); $i++){
    if($i == 0){
        $id_masakan = " id_masakan='$pesanan[$i]'";
    }else{
        $id_masakan .= " OR id_masakan='$pesanan[$i]'";
    }
}
if($jml_pesanan > 0){
    $empty = false;
}else{
    $empty = true;
}*/
?>


<li class="dropdown" style="padding-left: 15px; padding-right: 0px; margin-top:-2px">
    <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="javascript:;" style="padding:0px;">
        <span class="fa-stack fa-2x" title="Pesanan">
            <i class="fa fa-circle fa-stack-2x text-danger"></i>
            <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
        </span><strong id="count" style="color: red;"><?php echo $jml_pesanan; ?></strong>
    </a>
    <ul class="dropdown-menu" style="overflow: auto; width:400px;">
		<li style="padding:15px;"><center><strong>DAFTAR PESANAN</strong></center></li>
		<li class="devider"></li>
        <li>
        	<table class="table table-hover" style="margin-bottom:0px;">
            	<?php
            		//$sql = PdoQuery("SELECT *FROM masakan WHERE $id_masakan");
            		$no=1;
            		$total = 0;
            		foreach ($barang->result() as $list){ ?>
                        <tr>
                        	<td style="vertical-align: middle; padding-left:15px;"><?php echo $no++." &nbsp;"; ?></td>
                        	<td style="vertical-align: middle;"><a href="<?= URL_ ?>img/masakan/<?php echo $list->foto; ?>" style="color: #5bc0de" target="_blank">
                        		<img src="<?= URL_ ?>img/barang/<?php echo $list->foto; ?>" class="img-circle" style="width:30px; height:30px;">
                        		</a>
                        	</td>
                        	<td style="vertical-align: middle;">&nbsp; <?php echo $list->nama_barang; ?></td>
                        	<td style="text-align: right; vertical-align: middle; padding-right:15px;"><?php echo " Rp. ".number_format($list->harga); ?></td> 
                        </tr>
            		<?php
            		$total += $list->harga;
            		}
            	?>
            </table>
        </li>
        <li class="devider" style="margin-top:0px;"></li>
        <li>
        	<table class="table table-hover" style="margin-bottom:0px;">
                <tr>
                	<td colspan="2">
                		<a class="page-scroll" href="#services">
                		<button type="submit" class="btn btn-info" name="beli_banyak" value="true" style="width:100%">
                			<span class="glyphicon glyphicon-arrow-down"></span> 
                			SELANJUTNYA
                		</button>
                		</a>
                	</td>
                </tr>
        	</table>
        </li>
    </ul>
</li>

<?php } else { ?>

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

<?php } ?>