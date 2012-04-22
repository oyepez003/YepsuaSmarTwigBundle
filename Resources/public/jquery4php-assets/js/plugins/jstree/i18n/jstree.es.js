/**
 * WARNING! Use this file only if you want to make translation
 * Spanish translation
 * @author Omar Yepez <oyepez003@gmail.com>
 * @version 2011-18-10
 */
(function(jQuery) {
  jQuery.jstree.defaults.core = {
      strings		: {
        loading		: "Cargando ...",
        new_node	: "Nuevo",
        multiple_selection : "Selección múltiple"
      }
  };

  jQuery.jstree.defaults.contextmenu = {
      items : { // Could be a function that should return an object like this one
        "create" : {
          "separator_before"	: false,
          "separator_after"	: true,
          "label"				: "Crear",
          "action"			: function (obj) { this.create(obj); }
        },
        "rename" : {
          "separator_before"	: false,
          "separator_after"	: false,
          "label"				: "Renombrar",
          "action"			: function (obj) { this.rename(obj); }
        },
        "remove" : {
          "separator_before"	: false,
          "icon"				: false,
          "separator_after"	: false,
          "label"				: "Borrar",
          "action"			: function (obj) { if(this.is_selected(obj)) { this.remove(); } else { this.remove(obj); } }
        },
        "ccp" : {
          "separator_before"	: true,
          "icon"				: false,
          "separator_after"	: false,
          "label"				: "Editar",
          "action"			: false,
          "submenu" : { 
            "cut" : {
              "separator_before"	: false,
              "separator_after"	: false,
              "label"				: "Cortar",
              "action"			: function (obj) { this.cut(obj); }
            },
            "copy" : {
              "separator_before"	: false,
              "icon"				: false,
              "separator_after"	: false,
              "label"				: "Copiar",
              "action"			: function (obj) { this.copy(obj); }
            },
            "paste" : {
              "separator_before"	: false,
              "icon"				: false,
              "separator_after"	: false,
              "label"				: "Pegar",
              "action"			: function (obj) { this.paste(obj); }
            }
          }
        }
      }
    };
})(jQuery);