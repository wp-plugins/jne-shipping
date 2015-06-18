<?php if (get_option('jne_shipping_donation') != 'yes'): ?>
<div class="donation claerfix clear" style="clear:both;border:1px solid #ddd; background:#eee;padding:5px 15px;">
<p style="float:left; width:75%;">Jika anda merasa plugin ini bermanfaat, dan anda ingin mendonasikan sebagian harta anda untuk pengembangan plugin ini saya ucapkan banyak terimakasih. Untuk melakukan donasi, anda tinggal menekan tombol donasi yang ada di samping melalui akun paypal anda. Jika anda tidak memiliki akun paypal tapi anda tetap ingin berdonasi, jangan khawatir, anda  tetap bisa berdonasi dengan mengkontak saya melalui blog saya yang ada postingan tentang plugin ini. Terima kasih.</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations" />
<input type="hidden" name="business" value="kangmasagung@yahoo.com" />
<input type="hidden" name="return" value="<?php echo get_option('siteurl'); ?> /wp-admin/options-general.php?page=jne-shipping&donate=1" />
<input type="hidden" name="item_name" value="JNE Shipping" />
<input type="hidden" name="currency_code" value="USD" />
<div style="float:right;width:20%;padding:15px 5px;text-align:center;">
   <select name="amount" style="width:85px;">
      <option value="5">USD 5</option>
      <option value="10">USD 10</option>
      <option value="15" selected>USD 15</option>
      <option value="20">USD 20</option>
      <option value="25">USD 25</option>
      <option value="50">USD 50</option>
   </select><br />
   <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online." />
</div>
</form>
<br class="clear" />
</div>
<br class="clear" />
<?php endif; ?>
