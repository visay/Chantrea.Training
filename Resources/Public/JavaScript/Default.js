/*!
 * Chantrea.Training v0.0.1
 *
 * Copyright 2013 Keo Visay
 * Licensed under the LGPL-3.0+
 */

jQuery(document).ready(function(){
	jQuery('#trainingDateFrom').datetimepicker({minDate: 0});
	jQuery('#trainingDateTo').datetimepicker({minDate: 0});
});

//view report by filter
jQuery('#userFilter, #statusFilter, #categoryFilter').change(function() {

	jQuery.ajax({
		url: '/topic/showreportbyfilter' ,
		type: 'POST',
		data: $('#report').serialize(),
		beforeSend: function(){
			$('#ajaxLoading').show();
		}
	}).done(function(data) {
		jQuery("#resultFilter").html(data);
		$('#ajaxLoading').hide();
	});
});