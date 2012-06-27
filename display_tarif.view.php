<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Data Tarif JNE
   <!--a class="add-new-h2" href="admin.php?page=jne-tarif&act=import">Import Tarif</a-->
   <a class="add-new-h2" href="options-general.php?page=jne-shipping&act=import">Import Tarif</a>
</h2>

<?php if ($__message): ?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);"><p><?php echo $__message; ?></p></div><br />
<?php endif; ?>

<br class="clear" />

<?php include_once('donation.view.php'); ?>

<div id="col-container">
<div id="col-right">



<div class="tablenav top">
<div class="alignleft">
   <select name="">
      <option>Bulk Actions</option>
      <option>Hapus</option>
   </select>
   <input type="submit" name="submit" class="button" value="Apply" />
</div>

<!--div class="tablenav-pages one-page"><span class="displaying-num"></span>
<span class="pagination-links"><a href="http://localhost/wp3/wp-admin/edit.php?post_type=wpsc-product" title="Go to the first page" class="first-page disabled">«</a>
<a href="http://localhost/wp3/wp-admin/edit.php?post_type=wpsc-product&amp;paged=1" title="Go to the previous page" class="prev-page disabled">‹</a>
<span class="paging-input"><input type="text" size="1" value="1" name="paged" title="Current page" class="current-page" id="acpro_inp20"> of <span class="total-pages">1</span></span>
<a href="http://localhost/wp3/wp-admin/edit.php?post_type=wpsc-product&amp;paged=1" title="Go to the next page" class="next-page disabled">›</a>
<a href="http://localhost/wp3/wp-admin/edit.php?post_type=wpsc-product&amp;paged=1" title="Go to the last page" class="last-page disabled">»</a></span></div-->
		<br class="clear">
	</div>
	
<table class="wp-list-table widefat pages" cellspacing="0">
<thead>
   <tr>
      <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
      <th>Kota Tujuan</th>
      <th>OKE</th>
      <th>REGULER</th>
      <th>YES</th>
      <th>SS</th>
   </tr>
</thead>
<tfoot>
   <tr>
      <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
      <th>Kota Tujuan</th>
      <th>OKE</th>
      <th>REGULER</th>
      <th>YES</th>
      <th>SS</th>
   </tr>
</tfoot>

<tbody>
<?php if ($results): foreach ($results as $idx => $result): if ($idx % 2) $class="alternate"; else $class=""; ?>
   <tr class="<?php echo $class;?>">
      <th class="check-column" scope="row"><input type="checkbox" value="<?php echo $result->id;?>" name="post[]"></th>
      <td><strong><?php echo $result->kota;?></strong>
         <div class="row-actions"><span class="edit"><a title="Edit this item" href="options-general.php?page=jne-shipping&act=edit&id=<?php echo $result->id;?>">Edit</a> | </span><!-- span class="inline hide-if-no-js"><a title="Edit this item inline" class="editinline" href="#">Quick&nbsp;Edit</a> | </span--><span class="trash"><a href="options-general.php?page=jne-shipping&act=delete&id=<?php echo $result->id;?>" title="Move this item to the Trash" class="submitdelete delete-tag" onclick="return confirm('Anda yakin akan menghapus data?');">Delete</a></span></div>
      </td>
      <td><?php if (!empty($result->oke)) echo number_format($result->oke, 0, ',', '.');?></td>
      <td><?php if (!empty($result->reg))echo number_format($result->reg, 0, ',', '.');?></td>
      <td><?php if (!empty($result->yes))echo number_format($result->yes, 0, ',', '.');?></td>
      <td><?php if (!empty($result->ss))echo number_format($result->ss, 0, ',', '.');?></td>
   </tr>
<?php endforeach; endif; ?>
</tbody>
</table>


</div>
<div id="col-left">
<?php include_once('display_add_tarif.view.php'); ?>
</div>

</div>

</div>