VisualDeveloper.ElementOption.BackgroundColor = {

  group   : "Background",
  weight  : 1,
  name    : "Background Color",
  cssRule : "background-color",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : "color-picker",
      fieldValidation : "required"
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    return format.value;
  },

  isValid : function(format) {
    return format.value !== "";
  },

  generateFormatByRule : function(cssValue) {
    return {
      value : cssValue
    };
  }

};