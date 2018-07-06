VisualDeveloper.ElementOption.TextDecoration = {

  group   : "Text",
  weight  : 6,
  name    : "Text Decoration",
  cssRule : "text-decoration",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        'inherit'       : 'Inherits this property from its parent element',
        'none'          : 'Defines a normal text.',
        'underline'     : 'Defines a line below the text',
        'overline'      : 'Defines a line above the text',
        'line-through'  : 'Defines a line through the text',
        'initial'       : 'Sets this property to its default value'
      }
    }
  },
  affectChildren : true,

  generateRuleByFormatResponse : function(format) {
    return format.value;
  },

  generateFormatByRule : function(cssValue) {
    return {
      value     : cssValue
    };
  }

};