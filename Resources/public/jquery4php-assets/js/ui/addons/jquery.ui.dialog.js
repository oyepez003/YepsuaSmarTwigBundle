;(function($){
  jQuery.extend($.ui.dialog.prototype.options, {
      dragStart: function(event, ui) {
        jQuery(this).parent().addClass('ui-widget-shadow');
      },
      dragStop: function(event, ui) {
        jQuery(this).parent().removeClass('ui-widget-shadow');
      },
      resizeStart: function(event, ui) {
        jQuery(this).parent().addClass('ui-widget-shadow');
      },
      resizeStop: function(event, ui) {
        jQuery(this).parent().removeClass('ui-widget-shadow');
      }
  });
  jQuery.extend( jQuery.wijmo.wijdialog.prototype.options, {
      dragStart: function(event, ui) {
        jQuery(this).parent().addClass('ui-widget-shadow');
      },
      dragStop: function(event, ui) {
        jQuery(this).parent().removeClass('ui-widget-shadow');
      },
      resizeStart: function(event, ui) {
        jQuery(this).parent().addClass('ui-widget-shadow');
      },
      resizeStop: function(event, ui) {
        jQuery(this).parent().removeClass('ui-widget-shadow');
      }
  });
})(jQuery);
