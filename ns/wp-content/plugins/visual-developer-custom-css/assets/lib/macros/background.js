VisualDeveloper.Macro.Background = {

  textureURLPrefix : '',

  alias            : "Background",
  name             : "Texture Background",
  targetOption     : 'BackgroundImage',
  cssModel         : "image-select",
  format  : {
    texture : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {}
    }
  },

  getMacroFormat      : function() {
    var objectInstance  = this,
        newFieldOptions = {},
        format          = JSON.parse(JSON.stringify(this.format));

    jQuery.each(format.texture.fieldOptions, function(fieldKey, fieldValue) {
      newFieldOptions[fieldValue] = objectInstance.textureURLPrefix + fieldValue;
    });

    format.texture.fieldOptions = newFieldOptions;

    return format;
  },

  getMacroValueByOptionFormat : function(optionFormat) {
    return (typeof optionFormat.url == "undefined" ? '0.png' : optionFormat.url.substr(optionFormat.url.lastIndexOf("/") + 1));
  },

  composeOptionFormat : function(macroFormat) {
    return {
      url   : (macroFormat.texture == '0.png' ? '' : this.textureURLPrefix + macroFormat.texture),
      value : 'forced-background'
    };
  }

};