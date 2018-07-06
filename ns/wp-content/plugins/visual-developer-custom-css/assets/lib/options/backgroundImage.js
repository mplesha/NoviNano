VisualDeveloper.ElementOption.BackgroundImage = {

  group   : "Background",
  weight  : 2,
  name    : "Background Image",
  cssRule : "background-image",
  cssModel: "single",
  format  : {
    url : {
      fieldType       : "url",
      fieldValidation : "required",
      placeholder     : "Image URL"
    },
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : ['inherit', 'initial', 'url', 'none', "full-background", "forced-background"]
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    if(format.value == "full-background")
      return 'url("' + format.url + '");' + "\n" +
             'background: url("' + format.url + '") no-repeat center center fixed;' + "\n" +
             '-webkit-background-size: cover;' + "\n" +
             '-moz-background-size: cover;' + "\n" +
             '-o-background-size: cover;' + "\n" +
             'background-size: cover';

    if(format.value == "forced-background")
      return 'url("' + format.url + '") !important';

    return (format.value == "url" ? 'url("' + format.url + '")' : format.value);
  },

  isValid : function(format) {
    return !(format.url === "" && (format.value == "url" || format.value == "full-background" || format.value == "forced-background"));
  }

};