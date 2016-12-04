jQuery(document).ready(function(){
// tuto:
// http://fearlessflyer.com/how-to-create-super-easy-jquery-tabbed-containers/
jQuery('#tabs a:not(:first)').addClass('inactive');
jQuery("#tabs .tab-link .tab-tiret:last").hide();
jQuery('.container:not(:first)').hide();

jQuery('#tabs a').click(function(){
    var t = jQuery(this).attr('href');
    jQuery('#tabs a').addClass('inactive');		
    jQuery(this).removeClass('inactive');
    jQuery('.container').hide();
    jQuery(t).fadeIn('slow');
    return false;
})

// if(jQuery(this).hasClass('inactive')){ //this is the start of our condition 
//     jQuery('#tabs a').addClass('inactive');		 
//     jQuery(this).removeClass('inactive');
//     jQuery('.container').hide();
//     jQuery(t).fadeIn('slow');	
// }

}); // end document ready