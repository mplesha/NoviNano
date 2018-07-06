VisualDeveloper.ElementOption.MaxHeight = {

  group   : "Size",
  weight  : 6,
  name    : "Maximum Height",
  cssRule : "max-height",
  cssModel: "default",
  format  : {
    value : {
      fieldType       : "input",
      fieldValidation : "numeric"
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

    return (format.value instanceof Array ?
            format.valueType.join(format.valueType + " ") + format.valueType:
            format.value + format.valueType
           );
  },

  isValid : function(format) {
    return format.value !== "";
  },

  generateFormatByRule : function(cssValue) {
    return VisualDeveloper.Utility.getDefaultCSSFormatByRule(cssValue);
  }

};