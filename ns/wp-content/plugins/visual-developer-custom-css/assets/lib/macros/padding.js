VisualDeveloper.Macro.Padding = {

  alias            : "Padding",
  name             : "Inner Spacing",
  targetOption     : 'Padding',
  cssModel         : "single",// image-select if received from Server
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        ''            : 'Inactive',
        '20,20,20,20' : 'Center',
        '0,20,20,0'   : 'Right Bottom',
        '20,0,0,20'   : 'Top Left',
        '20,0,0,0'    : 'Top',
        '0,20,0,0'    : 'Right',
        '0,0,20,0'    : 'Bottom',
        '0,0,0,20'    : 'Left'
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
      value     : (macroFormat.value == 0 || macroFormat.value == '0' ?
          macroFormat.value : macroFormat.value.split(",")
      ),
      valueType : (macroFormat.value == 0 || macroFormat.value == '0' ?
          "px" : ["px", "px", "px", "px"]
      )
    };
  }

};