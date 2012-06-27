<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Edit Data Tarif</h2>

<br class="clear">

<form action="options-general.php?page=jne-shipping" method="post">

<table class="form-table">
	<tbody>
		<tr class="form-field form-required">
			<th valign="top" scope="row"><label for="kota">Kota Tujuan</label></th>
         <td><input type="text" aria-required="true" size="40" value="<?php echo $data['kota'];?>" id="kota" name="kota">
         <p class="description"><i>Kota tujuan bisa berupa kabupaten/kota atau kecamatan.</i></p></td>
		</tr>
		
      <tr class="form-field">
         <th valign="top" scope="row"><label for="oke">OKE</label></th>
         <td><input type="text" size="20" value="<?php echo $data['oke'];?>" id="oke" name="oke"></td>
      </tr>
      <tr class="form-field">
         <th valign="top" scope="row"><label for="reg">Reguler</label></th>
         <td><input type="text" size="20" value="<?php echo $data['reg'];?>" id="reg" name="reg"></td>
      </tr>
      <tr class="form-field">
         <th valign="top" scope="row"><label for="yes">YES</label></th>
         <td><input type="text" size="20" value="<?php echo $data['yes'];?>" id="yes" name="yes"></td>
      </tr>
      <tr class="form-field">
         <th valign="top" scope="row"><label for="ss">SS</label></th>
         <td><input type="text" size="20" value="<?php echo $data['ss'];?>" id="ss" name="ss"></td>
      </tr>
	</tbody>
</table>

<p class="submit"><input type="submit" class="button-primary" value="Simpan" name="save">
<input type="hidden" name="id" value="<?php echo $data['id'];?>" />
<input type="hidden" name="action" value="update" />
</p>
</form>

</div>