VisualDeveloper.Macro.BorderRadius = {

  alias            : "BorderRadius",
  name             : "Border Radius",
  targetOption     : 'BorderRadius',
  cssModel         : "single",// image-select if received from Server
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        '0'           : 'Inactive',
        '5,5,5,5'     : 'All',
        '5,5,0,0'     : 'Top',
        '0,0,5,5'     : 'Bottom',
        '5,0,0,0'     : 'Top Left',
        '0,5,0,0'     : 'Top Right',
        '0,0,5,0'     : 'Bottom Right',
        '0,0,0,5'     : 'Bottom Left'
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