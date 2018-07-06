VisualDeveloper.ElementOptions = {

  visualDeveloperInstance : {},

  _elementPattern     : "",
  _elementObject      : {},
  _uniqueLayoutID     : '',
  _uniqueLayoutObject : false,
  options : {

  },

  activeOptions : {

  },

  affectChildrenOptions : {

  },

  importantOptions : {

  },

  registeredExternalResources : [],

  Init : function(visualDeveloperInstance, elementPattern) {
    this.visualDeveloperInstance = visualDeveloperInstance;

    this.options          = jQuery.extend(1, {}, this.options);
    this.activeOptions    = jQuery.extend(1, {}, this.activeOptions);
    this.importantOptions = jQuery.extend(1, {}, this.importantOptions);

    this._elementPattern = elementPattern;
    this._elementObject  = jQuery(elementPattern);
    this._uniqueLayoutID = this.visualDeveloperInstance.styleNamespace + CryptoJS.MD5(this._elementPattern);

    this._syncOptionsObject();
  },

  _syncOptionsObject : function() {
    var objectInstance = this;

    jQuery.each(this.visualDeveloperInstance.ElementOption, function(optionIndex, optionObject){
      objectInstance.options[optionIndex] = (
            typeof objectInstance.options[optionIndex] === "undefined" ?
                objectInstance.options[optionIndex] : {}
          );

      objectInstance.activeOptions[optionIndex] = (
          typeof objectInstance.activeOptions[optionIndex] === "undefined" ?
              objectInstance.activeOptions[optionIndex] : 0
          );

      objectInstance.importantOptions[optionIndex] = (
          typeof objectInstance.importantOptions[optionIndex] === "undefined" ?
              objectInstance.importantOptions[optionIndex] : 0
          );

    });
  },

  SetOptionValues : function(optionIndex, fieldValues) {
    this.options[optionIndex] = fieldValues;

    this._syncOptionWithLayout();
  },

  EnableOption    : function(optionIndex) {
    this.activeOptions[optionIndex] = 1;

    this._syncOptionWithLayout();
  },

  DisableOption   : function(optionIndex) {
    this.activeOptions[optionIndex] = 0;

    this._syncOptionWithLayout();
  },

  EnableOptionImportant    : function(optionIndex) {
    this.importantOptions[optionIndex] = 1;

    this._syncOptionWithLayout();
  },

  DisableOptionImportant   : function(optionIndex) {
    this.importantOptions[optionIndex] = 0;

    this._syncOptionWithLayout();
  },

  GetCurrentActiveOptionsMap : function() {
    var objectInstance = this,
        ret            = {};

    this._resetRegisteredExternalResources();

    jQuery.each(this.activeOptions, function(optionIndex, isActiveOption){
      if(isActiveOption
          && typeof objectInstance.options[optionIndex] !== "undefined") {
        var includeRule   = true;

        if(typeof objectInstance.visualDeveloperInstance.ElementOption[optionIndex].isValid === "function"
            && objectInstance.visualDeveloperInstance.ElementOption[optionIndex].isValid(objectInstance.options[optionIndex]) == false)
          includeRule = false;

        if(includeRule) {
          ret[optionIndex] = objectInstance
                              .visualDeveloperInstance
                              .ElementOption[optionIndex]
                              .generateRuleByFormatResponse(
                                  objectInstance.options[optionIndex]
                              );

          if(typeof objectInstance.visualDeveloperInstance.ElementOption[optionIndex].generateDependencyImportURL == "function") {
            var externalCSS = objectInstance
                                .visualDeveloperInstance
                                .ElementOption[optionIndex]
                                .generateDependencyImportURL(objectInstance.options[optionIndex]);

            if(jQuery.inArray(externalCSS, objectInstance.visualDeveloperInstance.externalCSSResources) == -1) {
              objectInstance.visualDeveloperInstance.externalCSSResources[
                  objectInstance.visualDeveloperInstance.externalCSSResources.length
              ] = externalCSS;

              objectInstance.registeredExternalResources[
                  objectInstance.registeredExternalResources.length
              ] = externalCSS;
            }
          }
        }
      }
    });

    return ret;
  },

  _resetRegisteredExternalResources : function() {
    var objectInstance = this;

    jQuery.each(this.registeredExternalResources, function(key, value) {
      var arrayPosition = jQuery.inArray(value, objectInstance.visualDeveloperInstance.externalCSSResources);

      if(arrayPosition !== -1)
        objectInstance.visualDeveloperInstance.externalCSSResources.splice(arrayPosition, 1);
    });

    this.registeredExternalResources = [];
  },

  _syncOptionWithLayout : function() {
    var stylesheetObject = this._getStyleSheetObject();

    stylesheetObject.html( this.GetStylesheetCSSRulesText( true ) );

    this.visualDeveloperInstance.SyncLayoutWithExternalCSSDependencies();
  },

  /**
   * @return {string}
   */
  GetStylesheetCSSRulesText : function( isPreview ) {
    isPreview = ( typeof isPreview == "undefined" ? false : isPreview );

    var objectInstance   = this,
        stylesheetRule   = "";

    // Ideally we're looking to not modify the Visual Developer Tool during preview.
    if( isPreview )
      if( this._elementPattern.indexOf("body") !== 0 && this._elementPattern.indexOf("html") !== 0 )
        stylesheetRule += 'body > *:not([id^="visual-developer"]) ';

    stylesheetRule += this._elementPattern + " { \n";

    jQuery.each(this.GetCurrentActiveOptionsMap(), function(optionIndex, cssValue) {
      stylesheetRule +=
          "    " + objectInstance._getStylesheetCSSRuleByOptionIndexAndCSSValue(
              optionIndex, cssValue
          ) + "\n";
    });

    stylesheetRule += "}\n";

    return stylesheetRule;
  },

  _getStylesheetCSSRuleByOptionIndexAndCSSValue : function(optionIndex, cssValue){
    return this.visualDeveloperInstance.ElementOption[optionIndex].cssRule + " : " + cssValue +
            ( typeof this.importantOptions[optionIndex] !== "undefined" && this.importantOptions[optionIndex] == 1
                ? ' !important' : '' ) +
            ";";
  },

  _getStyleSheetObject : function() {
    if(this._uniqueLayoutObject != false)
      return this._uniqueLayoutObject;

    jQuery("head").append('<style id="' + this._uniqueLayoutID + '"></style>');

    this._uniqueLayoutObject = jQuery("#" + this._uniqueLayoutID);

    return this._uniqueLayoutObject;
  },

  Reset : function() {
    this.options       = {};
    this.activeOptions = {};

    this._syncOptionsObject();
    this._syncOptionWithLayout();
  },

  GetInformationPackJSON : function() {
    return {
      _elementPattern  : this._elementPattern,
      options          : this.options,
      activeOptions    : this.activeOptions,
      importantOptions : this.importantOptions
    };
  },

  _unpackInformationFromJSON : function(packedJSONObject) {
    var objectInstance = this;

    jQuery.each(packedJSONObject, function(key, value) {
      objectInstance[key] = value;
    });

    this._syncOptionWithLayout();
  },

  InitFromPackedJSONObject : function(visualDeveloperInstance, packedJSONObject) {
    this.Init(visualDeveloperInstance, packedJSONObject._elementPattern);
    this._unpackInformationFromJSON(packedJSONObject);
  }

};