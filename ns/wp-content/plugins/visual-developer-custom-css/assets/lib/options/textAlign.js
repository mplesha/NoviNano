VisualDeveloper.ElementOption.TextAlign = {

  group   : "Text",
  weight  : 3,
  name    : "Text Align",
  cssRule : "text-align",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        'inherit'       : 'Inherits this property from its parent element',
        'initial'       : 'Sets this property to its default value',
        'left'          : 'Aligns the text to the left',
        'right'         : 'Aligns the text to the right',
        'center'        : 'Centers the text',
        'justify'       : 'Stretches the lines so that each line has equal width (like in newspapers and magazines)'
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