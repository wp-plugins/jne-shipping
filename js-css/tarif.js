function clearData() {
	jQuery("#base_location_code").val(''); 
}

function formatItem(row) {
	return row[0];;
}

function findBaseLocationValue(event,data) { 
	jQuery("#base_location").val(data[0]); 
	jQuery("#base_location_code").val(data[1]);
		
	if(jQuery.trim(data[1])=='null')
	{
		jQuery("#base_location").val(''); 
		jQuery("#base_location_code").val('');
	} 
};

function findValueDestination(event,data) { 
	jQuery("#dest_location").val(data[0]); 
	jQuery("#dest_location_code").val(data[1]);
		
	if(jQuery.trim(data[1])=='null')
	{
		jQuery("#dest_location").val(''); 
		jQuery("#dest_location_code").val('');
	} 
	
	jQuery("*[class^='jneshipp']").remove();
   jQuery('.wpsc_shipping_header').after('<tr class="load-tarif"><td colspan="5">Loading...</td></tr>');
	
	jQuery.post(jneshipp.ajaxurl, {action: 'GETTARIF', to: data[0], destination_code: data[1]}, function(data) {
      jQuery("*[class^='jneshipp']").remove();
      jQuery("*[class^='load-tarif']").remove();
      jQuery('.wpsc_shipping_header').after(data);
	});
	
   jQuery('input[title="billingcity"], input[title="shippingcity"]').val(jQuery('#dest_location').val()).attr('readonly', 'true');
      
};

function destLocationForm() {
   jQuery.get(jneshipp.ajaxurl, {action: 'DESTLOCFORM'}, function(data) {
      jQuery('.wpsc_change_country').after(data);
      jQuery('.wpsc_change_country, .wpsc_shipping_info').remove();

      //destination
      jQuery("#dest_location").autocomplete(jneshipp.ajaxurl + "?action=GETCITY",{width:250,minChars:3, matchSubset:1, matchContains:1, max:10, cacheLength:20, formatItem:formatItem, selectOnly:1, autoFill:false, cleanUrl:false, multiple:true, multipleSeparator:'|', scroll:false});	
      jQuery("#dest_location").result(findValueDestination).next().click(function(){ });
   }); 
}

function baseLocationForm() {
	//base location
	jQuery("#base_location").autocomplete(jneshipp.ajaxurl + "?action=GETCITY&ind=0",{minChars:3, matchSubset:1, matchContains:1, max:10, cacheLength:20, formatItem:formatItem, selectOnly:1, autoFill:false, cleanUrl:false, multiple:true, multipleSeparator:'|', scroll:false});	
	jQuery("#base_location").result(findBaseLocationValue).next().click(function(){	});
}


jQuery(document).ready(function(){

	//base location
	jQuery("#base_location").autocomplete(jneshipp.ajaxurl + "?action=GETCITY&ind=0",{minChars:3, matchSubset:1, matchContains:1, max:10, cacheLength:20, formatItem:formatItem, selectOnly:1, autoFill:false, cleanUrl:false, multiple:true, multipleSeparator:'|', scroll:false});	
	jQuery("#base_location").result(findBaseLocationValue).next().click(function(){	});
	
	//destination
   destLocationForm();
   
   if (jQuery('#dest_location').val() != '' && jQuery('#dest_location').length > 0) {
   	jQuery('input[title="billingcity"], input[title="shippingcity"]').val(jQuery('#dest_location').val()).attr('readonly', 'true');
   }
});
