VisualDeveloper.ElementOption.TextTransform = {

  group   : "Text",
  weight  : 8,
  name    : "Text Transform",
  cssRule : "text-transform",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : [ 'none', 'capitalize', 'uppercase', 'lowercase', 'initial', 'inherit' ]
    }
  },
  affectChildren : true,

  generateRuleByFormatResponse : function(format) {
    if(format.value === 0)
      return 0;

    return format.value;
  },

  isValid : function(format) {
    return format.value !== "";
  },

  generateFormatByRule : function(cssValue) {
    return VisualDeveloper.Utility.getDefaultCSSFormatByRule(cssValue);
  }

};