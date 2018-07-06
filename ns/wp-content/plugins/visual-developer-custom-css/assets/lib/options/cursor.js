VisualDeveloper.ElementOption.Cursor = {

  group   : "Misc",
  weight  : 3,
  name    : "Cursor",
  cssRule : "cursor",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        'inherit'     : 'Inherits this property from its parent element',
        'default' 	  : 'The default cursor',
        'pointer'     : 'The cursor is a pointer and indicates a link',
        'auto'        : 'Default. The browser sets a cursor',
        'none'        : 'No cursor is rendered for the element',
        'ew-resize'   : 'Indicates a bidirectional resize cursor',
        'help'        : 'The cursor indicates that help is available',
        'move'        : 'The cursor indicates something is to be moved'
      }
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    return format.value;
  },

  generateFormatByRule : function(cssValue) {
    return {
      value     : cssValue
    };
  }

};