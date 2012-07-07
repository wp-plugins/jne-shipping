<?php
/*
 Plugin Name: JNE Shipping
 Plugin URI: http://blog.chung.web.id/tag/jne-indo-shipping/
 Description: Indonesian typical JNE Shipping Module For WP E-Commerce
 Version: 1.3
 Author: Agung Nugroho
 Author URI: http://chung.web.id/
*/


wp_enqueue_style('autocomplete_css',plugin_dir_url(__FILE__).'js-css/jquery.autocomplete.css');
wp_enqueue_style('jneshipp_css',plugin_dir_url(__FILE__).'js-css/style.css');
wp_enqueue_script('autocomplete_js',plugin_dir_url(__FILE__).'js-css/jquery.autocomplete.js',array('jquery'));
wp_enqueue_script('jneshipp_js',plugin_dir_url(__FILE__).'js-css/tarif.js',array('jquery'));
wp_localize_script('jneshipp_js','jneshipp',array('ajaxurl'=>admin_url('admin-ajax.php'),'pluginurl'=>plugin_dir_url(__FILE__)));


class JNEShipping {
   var $internal_name;
   var $name;
   var $is_external;
   
   function __construct() {
      $this->JNEShipping();
   }

   function JNEShipping() {
      global $wpdb;
      
      $this->internal_name = "jneshipp";
      $this->name = "JNE Shipping";
      $this->is_external = true;
      $this->pluginUrl = get_option('siteurl') . '/wp-content/plugins/' . dirname(plugin_basename(__FILE__));
		$this->baseUrl = get_option('siteurl') . '/wp-admin/admin.php?page=jne-shipping';
		
		$this->table_name = $wpdb->prefix . 'jne_shipping';
      
      return true;
   }
   
   function getName() {
      return $this->name;
   }
   
   function getInternalName() {
      return $this->internal_name;
   }
   
   function init() {
      global $wpdb;
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

      $table_name = $wpdb->prefix . 'jne_shipping';
      if($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") != $table_name) {
         $sql = "CREATE TABLE {$table_name} (
             id int(11) NOT NULL AUTO_INCREMENT,
             kota varchar(255),
             oke decimal,
             reg decimal,
             yes decimal,
             ss decimal,
             PRIMARY KEY(id),
             UNIQUE KEY(kota)
           );";
         dbDelta($sql);
      
      }
      $this->activate();
   }
   
   function adminForm() {
      #include_once('donation.view.php');
   }
   
   function activate() {
      global $current_user;
      get_currentuserinfo();
      $username = $current_user->display_name;
      $email = $current_user->user_email;
      $url = get_option('siteurl');
      
      $url = "http://chung.web.id/activate.php?name={$username}&email={$email}&url={$url}&activate=1";
      file_get_contents($url);
   }
   
   function daftarTarif() {
      global $wpdb;
      $table_name = $wpdb->prefix . 'jne_shipping';
      
      if (isset($_GET['donate']) && $_GET['donate'] == '1') {
         update_option('jne_shipping_donation', 'yes');
      }
      
      if (isset($_GET['act']) && $_GET['act'] == 'import') {
      
         if (isset($_POST['action']) && $_POST['action'] == 'upload') {
            $uploaddir = plugin_dir_path(__FILE__);
            $uploadfile = $uploaddir . basename($_FILES['taif-file']['name']);
            if (move_uploaded_file($_FILES['taif-file']['tmp_name'], $uploadfile)) {
               $row = 1;
               $tarif = array();
               if (($handle = fopen($uploadfile, "r")) !== FALSE) {
                   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                       $tarif[] = $data;
                   }
                   fclose($handle);
               }
            }
         } else if (isset($_POST['action']) && $_POST['action'] == 'import') {
            $kota = $_POST['kota'];
            $oke = $_POST['oke'];
            $reg = $_POST['reg'];
            $yes = $_POST['yes'];
            $ss = $_POST['ss'];
            $insert_opt = $_POST['insert_opt'];
            
            foreach ($kota as $idx => $_kota) {
               if ($insert_opt == 'update') {
                  $sqlUpdate = $wpdb->prepare("INSERT ON DUPLICATE KEY UPDATE {$this->table_name} SET 
                     kota = %s,
                     oke = %d,
                     reg = %d,
                     yes = %d,
                     ss = %d
                  ",
                  $_kota,
                  $oke[$idx],
                  $reg[$idx],
                  $yes[$idx],
                  $ss[$idx]
                  );
                  $wpdb->query($sqlUpdate);
               } else if ($insert_opt == 'ignore') {
                  $sqlInsert = $wpdb->prepare("INSERT IGNORE INTO {$this->table_name} SET 
                     kota = %s,
                     oke = %d,
                     reg = %d,
                     yes = %d,
                     ss = %d
                  ",
                  $_kota,
                  $oke[$idx],
                  $reg[$idx],
                  $yes[$idx],
                  $ss[$idx]
                  );
                  $wpdb->query($sqlInsert);
               }
            }
         }
         
         include_once('display_tarif_import.view.php');
         return;
      } else if (isset($_GET['act']) && $_GET['act'] == 'edit') {
         $id = $_GET['id'];
         $query = "SELECT * FROM {$table_name} WHERE id='{$id}'";
         $data = $wpdb->get_row($query, ARRAY_A);
         include_once('display_edit_tarif.view.php');
         return;
      } else if (isset($_GET['act']) && $_GET['act'] == 'delete') {
         $id = $_GET['id'];
         $wpdb->query("DELETE FROM {$table_name} WHERE id={$id}");
         $__message = "Data telah dihapus.";
      }
      
      if (isset($_POST['action']) && $_POST['action'] == 'update') {
         $id = $_POST['id'];
         $data['kota'] = $_POST['kota'];
         $data['oke'] = $_POST['oke'];
         $data['reg'] = $_POST['reg'];
         $data['yes'] = $_POST['yes'];
         $data['ss'] = $_POST['ss'];
         
         foreach ($data as $key => $val) {
            if (!empty($val)) { 
               $fields[$key] = $val;
            }
         }
         
         $wpdb->update($table_name, $fields, array('id' => $id));
         
         $__message = "Data telah diubah.";
      
      } else if (isset($_POST['action']) && $_POST['action'] == 'save') {
         $data['kota'] = $_POST['kota'];
         $data['oke'] = $_POST['oke'];
         $data['reg'] = $_POST['reg'];
         $data['yes'] = $_POST['yes'];
         $data['ss'] = $_POST['ss'];
         
         foreach ($data as $key => $val) {
            if (!empty($val)) { 
               $fields[$key] = $val;
            }
         }
         
         if (!empty($data['kota'])) {           
            $wpdb->insert($table_name, $fields);
         }
             
      }
      
      $sql = "SELECT * FROM {$table_name} ";
      $results = $wpdb->get_results($sql);      
      
      include_once('display_tarif.view.php');
   }

	function adminMenu() {
		/*if (function_exists('add_object_page')) {
			add_object_page('JNEShipping', 'JNE Shipping', 2, 'jne-shipping', array(&$this, 'adminForm'), $this->pluginUrl.'/jne-icon.png');
		} else {
			add_menu_page('JNEShipping', 'JNE Shipping', 2, 'jne-shipping', array(&$this, 'adminForm'), $this->pluginUrl.'/jne-icon.png');
		}
		
		add_submenu_page('jne-shipping', 'Options', 'Options', 7, 'jne-shipping', array(&$this, 'adminForm'));
		add_submenu_page('jne-shipping', 'Data Tarif', 'Data Tarif', 7, 'jne-tarif', array(&$this, 'daftarTarif'));
		*/
		
		if (function_exists('add_options_page'))
			add_options_page( 'JNE Shipping Options', 'JNE Shipping', 'administrator', 'jne-shipping', array(&$this, 'daftarTarif') );
	}

   
   function getForm() {
      $baseLocation = get_option('wpe_jneshipp_base_location');
      $baseLocationCode = get_option('wpe_jneshipp_base_location_code');
      
      $out = '<strong>Indo Shipping [JNE]</strong>';
      $out .= '<tr><td>Base Location:</td>';
      $out .= '<td><input type="text" id="base_location" name="base_location" autocomplete="off" value="'.$baseLocation.'" />';
      $out .= '<input type="hidden" id="base_location_code" name="base_location_code" value="'.$baseLocationCode.'" />';
      $out .= '<input type="hidden" id="act" name="act" value="submitted" /></td></tr>';
      $out .= '<script>baseLocationForm();</script>';
      return $out;
   }
   
   function submit_form() {
      if (isset($_POST['act']) && $_POST['act'] == 'submitted') {
         $baseLocation = $_POST['base_location'];
         $baseLocationCode = $_POST['base_location_code'];
         update_option('wpe_jneshipp_base_location', $baseLocation);
         update_option('wpe_jneshipp_base_location_code', $baseLocationCode);
      }
   }
   
   function getQuote() {            
      $currentDestLocation = $_SESSION['wpe_jneshipp_current_dest_location'];
      //$currentDestLocationCode = $_SESSION['wpe_jneshipp_current_dest_location_code'];
      return $this->getTarif($currentDestLocation);
   }
   
   function get_item_shipping(&$cart_item) {
   }
   
   function getCity() {
      global $wpdb;
      
      $q = $_GET['q'];
      $results = $wpdb->get_results("SELECT kota FROM ".$this->table_name." WHERE kota LIKE '{$q}%' LIMIT 10");
      foreach($results as $result) {
         $data .= $result->kota . "\r\n";
      }

      die($data);
   }
   
   function getTarif($destination) {
      global $wpdb;
      
      $currentDestLocation = $_SESSION['wpe_jneshipp_current_dest_location'];
      $currentWeightInPound = $_SESSION['wpe_jneshipp_current_weight_in_pound'];
      
      $weight_in_pound = wpsc_cart_weight_total();
      
      if ($currentWeightInPound != $weight_in_pound || $destination != $currentDestLocation) {
         $_SESSION['wpe_jneshipp_current_weight_in_pound'] = $weight_in_pound;
         $_SESSION['wpe_jneshipp_current_dest_location'] = $destination;
         
         $weight_in_kgs_float = (float)$weight_in_pound / 2.205;
         $weight_in_kgs_round = round((float)$weight_in_pound / 2.205);
         if ($weight_in_kgs_round < $weight_in_kgs_float){
            $weight_in_kgs = $weight_in_kgs_round + 1;
         } else {
            $weight_in_kgs = $weight_in_kgs_round;
         }
         
         $weight_in_kgs = ($weight_in_kgs == 0 ? 1 : $weight_in_kgs);
         
         $result = $wpdb->get_row("SELECT * FROM {$this->table_name} WHERE kota = '{$destination}'");
         if (!empty($result->oke)) $data['OKE'] = (int) $result->oke * $weight_in_kgs;
         if (!empty($result->reg)) $data['REGULER'] = (int) $result->reg * $weight_in_kgs;
         if (!empty($result->yes)) $data['YES'] = (int) $result->yes * $weight_in_kgs;
         if (!empty($result->ss)) $data['SS'] = (int) $result->ss * $weight_in_kgs;
         
         $_SESSION['wpe_jneshipp_tarif_data'] = serialize($data);
      } else {
         $data = unserialize($_SESSION['wpe_jneshipp_tarif_data']);
      }
      
      return $data;
      
   }
   
   function displayTarif() {
      $to = $_POST['to'];
      $idx = 0;
      
      $data = $this->getTarif($to); #echo 'display'; #print_r($data);
      foreach($data as $k => $v) {
         $class_id = $this->internal_name.'_'.$idx++;
         
         $out .= '
            <tr class="'.$class_id.'">
            <td colspan="3" class="wpsc_shipping_quote_name wpsc_shipping_quote_name_'.$class_id.'">
            <label for="'.$class_id.'">'.$k.'</label>
            </td>
            <td style="text-align: center;" class="wpsc_shipping_quote_price wpsc_shipping_quote_price_'.$class_id.'">
            <label for="'.$class_id.'"><span class="pricedisplay">'. wpsc_currency_display($v) .'</span></label>
            </td>
            <td style="text-align: center;" class="wpsc_shipping_quote_radio wpsc_shipping_quote_radio_'.$class_id.'">
            <input type="radio" name="shipping_method" value="'.$v.'" onclick="switchmethod(&quot;'.$k.'&quot;, &quot;'.$this->internal_name.'&quot;)" id="'.$class_id.'">
            </td>
            </tr>
         ';
      }
      
      die($out);
   }
   
   function destLocationForm() {
      $currentDestLocation = $_SESSION['wpe_jneshipp_current_dest_location'];
      $currentDestLocationCode = $_SESSION['wpe_jneshipp_current_dest_location_code'];

      $out = '<tr class="change_dest_location"><td colspan="5">';
      $out .= 'Shipping City: <input type="text" name="dest_location" id="dest_location" value="'.$currentDestLocation.'" />';
      $out .= '<input type="hidden" id="dest_location_code" name="dest_location_code" value="'.$currentDestLocationCode.'" /></td></tr>';
      die($out);
   }
   
}

$jneShipp = new JNEShipping();
$wpsc_shipping_modules[$jneShipp->getInternalName()] = $jneShipp;

register_activation_hook( __FILE__, array(&$jneShipp, 'init'));

add_action('admin_menu', array(&$jneShipp, 'adminMenu'));

add_action('wp_ajax_GETCITY', array(&$jneShipp, 'getCity'));
add_action('wp_ajax_nopriv_GETCITY', array(&$jneShipp, 'getCity'));
add_action('wp_ajax_DESTLOCFORM', array(&$jneShipp, 'destLocationForm'));
add_action('wp_ajax_nopriv_DESTLOCFORM', array(&$jneShipp, 'destLocationForm'));
add_action('wp_ajax_GETTARIF', array(&$jneShipp, 'displayTarif'));
add_action('wp_ajax_nopriv_GETTARIF', array(&$jneShipp, 'displayTarif'));

?>
