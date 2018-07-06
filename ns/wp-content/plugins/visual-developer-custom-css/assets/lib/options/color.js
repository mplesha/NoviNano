VisualDeveloper.ElementOption.Color = {

  group   : "Text",
  weight  : 1,
  name    : "Color",
  cssRule : "color",
  cssModel: "single",
  format  : {
    value : {
      fieldType       : "color-picker",
      fieldValidation : "required"
    }
  },
  affectChildren : true,

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