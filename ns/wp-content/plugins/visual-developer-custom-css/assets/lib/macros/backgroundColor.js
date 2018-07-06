VisualDeveloper.Macro.BackgroundColor = {

  alias            : "BackgroundColor",
  name             : "Background Color",
  targetOption     : 'BackgroundColor',
  cssModel         : "single-color-select",
  format  : {
    value : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : {
        ''            : 'X',
        '#16a085'     : 'Green Sea',
        '#2ecc71'     : 'Emerald',
        '#27ae60'     : 'Nephritis',
        '#3498db'     : 'Peter River',
        '#2980b9'     : 'Belize Hole',
        '#f1c40f'     : 'Sun Flower',
        '#f39c12'     : 'Orange',
        '#e67e22'     : 'Carrot',
        '#d35400'     : 'Pumpkin',
        '#e74c3c'     : 'Alizarin',
        '#c0392b'     : 'Pomegranate',
        '#9b59b6'     : 'Amethyst',
        '#8e44ad'     : 'Wisteria',
        '#ecf0f1'     : 'Clouds',
        '#bdc3c7'     : 'Silver',
        '#95a5a6'     : 'Concrete',
        '#7f8c8d'     : 'Asbestos',
        '#34495e'     : 'Wet Asphalt',
        '#2c3e50'     : 'Midnight Blue'
      }
    }
  },

  optionImages   : {},
  composedFormat : false,

  getMacroFormat      : function() {
    if(this.cssModel == 'single' || this.cssModel == 'single-color-select')
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
