<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Data Tarif JNE
   <a class="add-new-h2" href="options-general.php?page=jne-shipping&act=import">Import Tarif</a>
</h2>

<br class="clear" />

<style>
form div > label {width:50px;display:inline-block;}
form > div {margin-bottom:5px;}
</style>
<div style="width:620px;text-align:left;border:1px solid #e9e9e9; padding: 0 14px 14px;background:#fff;margin:0 auto;">
	<h3 style="text-align:center;">Hampir selesai...</h3>
	<br>
	<h3>Step 1:</h3>
	<p>Sebuah email konfirmasi telah dikirim ke email Anda "<?php echo get_option('jne_shipping_email');?>". Anda harus mengklik link konfirmasi dalam email untuk mendaftarkan plugin.</p>
	<h3>Step 2:</h3>
	<p>Klik tombol di bawah untuk Verifikasi dan Aktifkan plugin.</p>
	<form method="post" action="http://chung.web.id/activatejne.php">
		<input type="submit" value="Verify and Activate" class="button-primary">
		<input type="hidden" name="act" value="member-info">
		<input type="hidden" name="return" value="<?php echo $this->baseUrl;?>">
		<input type="hidden" name="email" value="<?php echo get_option('jne_shipping_email');?>">
	</form>
</div>

</div>
