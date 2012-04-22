/*
* WARNING! Use this file only if you want to make translation
* Please submit your translation to:
* oyepez003@gmail.com || the-team@yepsua.com
*/
/*
* YOUR_LANGUAGE_TRANSLATION translation
* @author NAME <EMAIL>
* @version 201x-xx-xx
*/
jQuery(function($){
  $.fn.dynamicselect.defaults = {
    layout : '<div class="ui-widget ui-widget-content ui-corner-all mselect mselect-list">'
    +'%items%'
    +'<a href="#" class="mselect-button-add"><span class="ui-state-default mselect-button-add-icon"><span class="ui-icon ui-icon-plusthick"/></span>%addText%</a>'
    +'<div class="mselect-input-container">'
    +'<input type="text" class="ui-widget-content ui-corner-all mselect-input" title="%inputTitle%"/>'
    +'<a href="#" class="ui-state-default mselect-button-cancel" title="%cancelText%"><span class="ui-icon ui-icon-closethick"/></a>'
    +'</div>'
    +'</div>',
    item : '<div  class="mselect-list-item"><label><input type="checkbox" value="%value%" %checked%/>%label%</label></div>',
    addText : 'New value',
    cancelText : 'Cancel',
    inputTitle : 'Separate values by space',
    size : 5,
    itemHoverClass : 'ui-state-hover',
    toggleAddButton : true,
    parse : function(v) {
      return v.split(/\s+/)
    }
  }
});

