VisualDeveloper.Utility = {

  visualDeveloperInstance : {},

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;

    this.NiceSelect.Init(visualDeveloperInstance);
    this.SplitSelect.Init(visualDeveloperInstance);
    this.InputMAP.Init(visualDeveloperInstance);
    this.InputColorpicker.Init(visualDeveloperInstance);
    this.Modal.Init(visualDeveloperInstance);
    this.ImageSelect.Init(visualDeveloperInstance);
    this.DomRuleBuilder.Init(visualDeveloperInstance);
    this.ColorSelect.Init(visualDeveloperInstance);
    this.SplitInlineSelect.Init(visualDeveloperInstance);
  },

  isNumber : function(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  },

  getDefaultCSSFormatByRule : function(cssValue) {
    if(cssValue == 'auto')
      return { value : '' };

    var presentDigit = parseFloat(cssValue, 10);

    if(isNaN(presentDigit))
      return { value : '' };

    return {
      value     : presentDigit,
      valueType : cssValue.replace(presentDigit, "")
    };
  }

};

// @codekit-append "utilities/splitSelect.js"
// @codekit-append "utilities/niceSelect.js"
// @codekit-append "utilities/inputMAP.js"
// @codekit-append "utilities/inputColorpicker.js"
// @codekit-append "utilities/svgCheckbox.js"
// @codekit-append "utilities/modal.js"
// @codekit-append "utilities/imageSelect.js"
// @codekit-append "utilities/domRuleBuilder.js"
// @codekit-append "utilities/colorSelect.js"
// @codekit-append "utilities/splitInlineSelect.js"

