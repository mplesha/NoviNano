VisualDeveloper.ElementOption.TextIndent = {

  group   : "Text",
  weight  : 8,
  name    : "Text Indent",
  cssRule : "text-indent",
  cssModel: "default",
  format  : {
    value : {
      fieldType       : "input"
    },
    valueType : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : [ 'px', 'em', 'rem', '%' ]
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    if(format.value === 0)
      return 0;

    return format.value + format.valueType;
  },

  isValid : function(format) {
    return format.value !== "";
  },

  generateFormatByRule : function(cssValue) {
    return VisualDeveloper.Utility.getDefaultCSSFormatByRule(cssValue);
  }

};