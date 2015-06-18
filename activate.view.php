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
<div style="width:620px;text-align:center;border:1px solid #e9e9e9; padding: 0 14px 14px;background:#fff;margin:0 auto;">
	<h3>Please register the plugin...</h3>
	<p>Registrasi <b>gratis</b> dan hanya perlu satu kali saja.</p>
	<p>Selain itu, Anda akan menerima Email Newsletter yang akan memberi Anda banyak berita dan tips menarik. Tentu saja, Anda dapat berhenti berlangganan kapan saja Anda inginkan.</p>
	<br>
	<form method="post" action="http://chung.web.id/activatejne.php">
		<div>
			<label>Nama</label>
			<input type="text" name="name" required>
		</div>
		<div>
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email;?>" required>
		</div>
		<input type="submit" value="Register" class="button-primary">
		<input type="hidden" name="act" value="subscribe">
		<input type="hidden" name="return" value="<?php echo $this->baseUrl;?>">
	</form>
	<br>
	<p><i>Disclaimer: Informasi kontak Anda akan ditangani dengan rahasia dan tidak akan pernah dijual atau dibagi dengan pihak ketiga.</i></p>
</div>

</div>
