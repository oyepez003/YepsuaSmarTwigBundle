var jq4php = {
  grid : {
    selectedRow : function(obj){
      return jQuery(obj).jqGrid('getGridParam','selrow');
    },
    hasSelectedRow : function(obj, message){
      hasSelected = jQuery(obj).jqGrid('getGridParam','selrow') != null;
      if(message != undefined && !hasSelected){
        jQuery.pnotify(message);
      }
      return hasSelected;
    },
    toogleCheckbox : function(obj){
      $(this).toggle(
        function(){
        $(obj).jqGrid().hideCol('cb')
        }, 
        function(){
        $(obj).jqGrid().showCol('cb')
      });
    }
  }
}
var SmarTwig = jq4php;