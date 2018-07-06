VisualDeveloper.ElementOption.Border = {

  group   : "Border",
  weight  : 3,
  name    : "Border",
  cssRule : "border",
  cssModel: "border",
  format  : {
    value : {
      fieldType        : "input",
      fieldValidation  : "numeric"
    },

    valueType : {
      fieldType       : 'select',
      fieldValidation : false,
      fieldOptions    : [ 'px', 'em', 'rem', '%' ]
    },

    color : {
      fieldType       : "color-picker",
      fieldValidation : "required"
    },

    type : {
      fieldType       : "select",
      fieldValidation : false,
      fieldOptions    : {
        'dotted' : 'Defines a dotted border',
        'dashed' : 'Defines a dashed border',
        'solid'  : 'Defines a solid border',
        'double' : 'Defines two borders. The width of the two borders are the same as the border-width value',
        'groove' : 'Defines a 3D grooved border. The effect depends on the border-color value',
        'ridge'  : 'Defines a 3D ridged border. The effect depends on the border-color value',
        'inset'  : 'Defines a 3D inset border. The effect depends on the border-color value',
        'outset' : 'Defines a 3D outset border. The effect depends on the border-color value'
      }
    }
  },
  affectChildren : false,

  generateRuleByFormatResponse : function(format) {
    if(format.value == 0)
      return 0;

    return (format.value instanceof Array ?
            format.valueType.join(format.valueType + " ") + format.valueType:
            format.value + format.valueType
           ) + ' ' + format.type + ' ' + format.color;
  },

  isValid : function(format) {
    return format.value !== "";
  }

};