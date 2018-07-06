VisualDeveloper.Macro.TextAlign = {

  alias            : "TextAlign",
  name             : "Text Alignment",
  targetOption     : 'TextAlign',
  cssModel         : "image-select",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        'inherit'       : 'inherit',
        'left'          : 'left',
        'center'        : 'center',
        'right'         : 'right'
      }
    }
  },

  optionImages   : {},
  composedFormat : false,

  getMacroFormat      : function() {
    if(this.cssModel == 'single')
      return this.format;

    if(this.composedFormat != false)
      return this.composedFormat;

    var objectInstance  = this;

    this.composedFormat = JSON.parse(JSON.stringify(this.format));

    jQuery.each(this.composedFormat.value.fieldOptions, function(fieldKey, fieldValue) {
      objectInstance.composedFormat.value.fieldOptions[fieldKey] = objectInstance.optionImages[fieldValue];
    });

    return this.composedFormat;
  },

  getMacroValueByOptionFormat : function(optionFormat) {
    return optionFormat.value;
  },

  composeOptionFormat : function(macroFormat) {
    return {
      value : macroFormat.value
    };
  }

};