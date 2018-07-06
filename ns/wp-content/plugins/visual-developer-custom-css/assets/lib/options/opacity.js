VisualDeveloper.ElementOption.Opacity = {

  group   : "Misc",
  weight  : 9,
  name    : "Opacity",
  cssRule : "Opacity",
  cssModel: "single",
  format  : {
    input : {
      fieldType       : "input",
      fieldValidation : "numeric",
      placeholder     : "Input Based Value"
    },
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : [ "inherit", "input" ]
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    return (format.value === "input" ? format.input : format.value);
  }

};