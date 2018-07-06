VisualDeveloper.ElementOption.Position = {

  group   : "Position",
  weight  : 1,
  name    : "Position",
  cssRule : "position",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : [ "initial", "static" , "absolute", "relative", "fixed", "inherit" ]
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