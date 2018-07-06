VisualDeveloper.ElementOption.Left = {

  group   : "Position",
  weight  : 5,
  name    : "Left",
  cssRule : "left",
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

    return format.value + format.valueType;
  },

  isValid : function(format) {
    return format.value !== "";
  },

  generateFormatByRule : function(cssValue) {
    return VisualDeveloper.Utility.getDefaultCSSFormatByRule(cssValue);
  }

};