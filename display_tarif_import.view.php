<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Import Data Tarif</h2>

<br class="clear">

<?php include_once('donation.view.php'); ?>

<p>Anda dapat memasukkan data tarif JNE dari file csv (comma sparated value) dengan format <strong>"KOTA TUJUAN, TARIF OKE, TARIF REGULER, TARIF YES, TARIF SS"</strong> dan tanpa header, artinya dari baris 1 adalah dianggap data.</p>

<br class="clear">
<?php if (isset($tarif)):  ?>
<h3>Preview Data Tarif</h3>
<p>Ada <b><?php echo count($tarif); ?> data</b>, preview hanya sebagian data.</p>
<form method="post">
<div class="tablenav top">
<div class="alignleft">
   <select name="insert_opt">
      <option value="update">Update Data</option>
      <option value="ignore">Ignore Data</option>
   </select>
   <input type="submit" value="Proses Import" class="button-primary" />
   <input type="hidden" value="import" name="action" />
   <span><i>Jika data sudah ada dalam database, anda dapat memilih opsi untuk meng-<strong>Update</strong> atau <strong>Ignore</strong> terhadap data.</i></span>
</div>
</div>
<table class="wp-list-table widefat pages" cellspacing="0">
<thead>
   <tr>
      <th>Kota Tujuan</th>
      <th>OKE</th>
      <th>REGULER</th>
      <th>YES</th>
      <th>SS</th>
   </tr>
</thead>
<tfoot>
   <tr>
      <th>Kota Tujuan</th>
      <th>OKE</th>
      <th>REGULER</th>
      <th>YES</th>
      <th>SS</th>
   </tr>
</tfoot>
<tbody>
<?php foreach($tarif as $idx => $_tarif): if ($idx > 100) break; ?>
<tr>
   <td><?php echo $_tarif[0];?><input type="hidden" name="kota[<?php echo $idx;?>]" value="<?php echo $_tarif[0];?>" /></td>
   <td><?php echo $_tarif[1];?><input type="hidden" name="oke[<?php echo $idx;?>]" value="<?php echo $_tarif[1];?>" /></td>
   <td><?php echo $_tarif[2];?><input type="hidden" name="reg[<?php echo $idx;?>]" value="<?php echo $_tarif[2];?>" /></td>
   <td><?php echo $_tarif[3];?><input type="hidden" name="yes[<?php echo $idx;?>]" value="<?php echo $_tarif[3];?>" /></td>
   <td><?php echo $_tarif[4];?><input type="hidden" name="ss[<?php echo $idx;?>]" value="<?php echo $_tarif[4];?>" /></td>
</tr>
<?php endforeach; ?>
</tbody></table>
<input type="hidden" name="uploadfile" id="taif-file" value="<?php echo $uploadfile;?>"/>
</form>
<?php else: ?>

<h4>Import data tarif JNE dalam format .csv</h4>
<p class="install-help">Jika anda memiliki file tarif JNE dalam fomat .xls maka anda perlu mengconvertnya terlebih dahulu ke dalam fomat .csv dengan struktur kolom seperti yang telah dijelaskan diatas.</p>
<form action="" enctype="multipart/form-data" method="post">
	<label for="taif-file" class="screen-reader-text">File Tarif</label>
   <input type="file" name="taif-file" id="taif-file">
   <input type="submit" value="Import Tarif" class="button">
   <input type="hidden" value="upload" name="action" />
</form>

<?php endif; ?>

<?php if (isset($log)) echo '<p>'.$log.'</p>'; ?>

</div>
