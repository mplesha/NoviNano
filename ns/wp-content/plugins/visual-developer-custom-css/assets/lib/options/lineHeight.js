VisualDeveloper.ElementOption.LineHeight = {

  group   : "Text",
  weight  : 7,
  name    : "Line Height",
  cssRule : "line-height",
  cssModel: "single",
  format  : {
    input : {
      fieldType       : "url",
      placeholder     : "Input Based Value"
    },
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : [ "inherit", "initial" , "normal", "input" ]
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    return (format.value === "input" ? format.input : format.value);
  }

};