var VisualDeveloper = {

  namespace      : 'visual-developer',
  styleNamespace : 'visual-developer-',
  fieldNamespace : 'visual_developer_',

  _settings : {
    clearClass                      : "clear",
    externalCSSResourcesContainerID : 'external-css-resources',
    supportStylesheetID             : 'synchronize_support_stylesheet',
    supportFooterStylesheetID       : 'synchronize_support_footer_stylesheet'
  },

  hiddenElementOptions                 : [],
  hiddenSelectorOptions                : [],
  hasSettingSpectralModeDefaultEnabled : 0,
  hasSettingEMOptionDefaultSelected    : 0,
  hasSettingEnableColorPicker          : 1,
  hasSettingEnableKeyboardArrowSupport : 1,
  hasSettingEnableElementPanelFilter   : 1,
  hasSettingFieldDefaultValue          : 0,
  hasSettingEnableAdvancedFeatures     : 1,
  hasSettingEnableImportantElement     : 1,
  hasSettingEnableElementSelectors     : 0,
  externalCSSResources                 : [],
  externalCSSResourcesContainerObject  : false,

  universalEventSettingsUpdate  : 'settings_update',
  universalFilterSettingsExport : 'settings_export',
  universalFilterStylesheetFile : 'stylesheet_file',

  /**
   * This object is very complex and required for the Element Generic Path generation
   */
  _classInterpretationSettings : {
    "*"  : [
      "visual-developer-^"
    ],
    post : [
      "hentry", "status-publish",
      "category-^", "post-^", "format-^"
    ],
    page_item : [
      "page-item-^"
    ]
  },

  _absoluteClassInterpretationSettings : {
    "*"  : [
      "visual-developer-^"
    ]
  },

  toolbarObject : {},
  toolbarIdentifier : "#wpadminbar",

  Init : function() {
    this._initSettings();
    this._initEventAndFilterManager();
    this._initFunctionalityModules();

    this._registerFunctionalityEvents();
  },

  _initSettings : function() {
    this.toolbarObject        = jQuery(this.toolbarIdentifier);
    this._settings.clearClass = this.styleNamespace + this._settings.clearClass;
    this._settings.externalCSSResourcesContainerID = this.styleNamespace + this._settings.externalCSSResourcesContainerID;
  },

  _initEventAndFilterManager : function() {
    this.EventManager             = jQuery.extend(true, {}, this.EventManager);
    VisualDeveloper.EventManager.Init(this);

    this.FilterManager             = jQuery.extend(true, {}, this.FilterManager);
    VisualDeveloper.FilterManager.Init(this);

    this.EventManager.registerEvent(this.universalEventSettingsUpdate);
    this.FilterManager.registerFilter(this.universalFilterSettingsExport);
  },

  /**
   * Initiate Different Instances, keep it all clean.
   * @private
   */
  _initFunctionalityModules : function() {
    this.Panel                    = jQuery.extend(true, {}, this.Panel);
    this.Navigation               = jQuery.extend(true, {}, this.Navigation);
    this.NavigationPanel          = jQuery.extend(true, {}, this.NavigationPanel);
    this.ElementPanel             = jQuery.extend(true, {}, this.ElementPanel);
    this.ElementOperations        = jQuery.extend(true, {}, this.ElementOperations);
    this.SettingsPanel            = jQuery.extend(true, {}, this.SettingsPanel);
    this.ProgressPanel            = jQuery.extend(true, {}, this.ProgressPanel);
    this.MacroInterface           = jQuery.extend(true, {}, this.MacroInterface);
    this.MacroInterfaceOperations = jQuery.extend(true, {}, this.MacroInterfaceOperations);
    this.PageVersions             = jQuery.extend(true, {}, this.PageVersions);
    this.PageVersionsPanel        = jQuery.extend(true, {}, this.PageVersionsPanel);
    this.ApplicationSynchronize   = jQuery.extend(true, {}, this.ApplicationSynchronize);
    this.Utility                  = jQuery.extend(true, {}, this.Utility);
    this.SyntaxSelectionPanel     = jQuery.extend(true, {}, this.SyntaxSelectionPanel);

    VisualDeveloper.Panel.Init(this);
    VisualDeveloper.Navigation.Init(this);
    VisualDeveloper.NavigationPanel.Init(this);
    VisualDeveloper.ElementPanel.Init(this);
    VisualDeveloper.ElementOperations.Init(this);
    VisualDeveloper.SettingsPanel.Init(this);
    VisualDeveloper.ProgressPanel.Init(this);
    VisualDeveloper.MacroInterface.Init(this);
    VisualDeveloper.MacroInterfaceOperations.Init(this);
    VisualDeveloper.PageVersions.Init(this);
    VisualDeveloper.PageVersionsPanel.Init(this);
    VisualDeveloper.ApplicationSynchronize.Init(this);
    VisualDeveloper.Utility.Init(this);
    VisualDeveloper.SyntaxSelectionPanel.Init(this);
  },

  _registerFunctionalityEvents : function() {
    this.FilterManager.listenFilter(
        this.universalFilterSettingsExport,
        this,
        '_filterExportStylesheet'
    );

    this.FilterManager.listenFilter(
        this.universalFilterSettingsExport,
        this,
        '_filterExportJSON'
    );

    this.EventManager.listenEvent(
        this.universalEventSettingsUpdate,
        this,
        '_eventSettingsUpdate'
    );
  },

  _filterExportStylesheet : function(currentInformation) {
    currentInformation.stylesheet = '';

    jQuery.each(this.externalCSSResources, function(key, value) {
      currentInformation.stylesheet += '@import url("' + value + '");' + "\n";
    });

    currentInformation.stylesheet = this.FilterManager.parseFilter(
        this.universalFilterStylesheetFile, currentInformation.stylesheet
    );

    return currentInformation;
  },

  _eventSettingsUpdate : function(JSONInformation) {
    var objectInstance = this;

    jQuery('#' + this._settings.supportStylesheetID).remove();
    jQuery('#' + this._settings.supportFooterStylesheetID).remove();

    if(typeof JSONInformation.supportStylesheet !== "undefined" && JSONInformation.supportStylesheet != false)
      jQuery("head").append('<style id="' + this._settings.supportStylesheetID + '">@import url("' + JSONInformation.supportStylesheet + '")</style>');

    if(typeof JSONInformation.supportFooterStylesheet !== "undefined" && JSONInformation.supportFooterStylesheet != false)
      jQuery("body").append('<style id="' + this._settings.supportFooterStylesheetID + '">@import url("' + JSONInformation.supportFooterStylesheet + '")</style>');

    if(typeof JSONInformation['settings'] !== "undefined")
      objectInstance.hiddenElementOptions = JSONInformation['settings'];

    if(typeof JSONInformation['optionsJSON'] !== "undefined") {
      jQuery.each(JSONInformation.optionsJSON, function(key, value){
        objectInstance[key] = (value === "0" ? 0 : value);
      });
    }

    if(typeof JSONInformation.selectorOptionsJSON !== "undefined")
      objectInstance.hiddenSelectorOptions = JSONInformation['selectorOptionsJSON'];

    if(typeof JSONInformation.dependency !== "undefined") {
      this._injectDependencyWithinApplication(JSONInformation.dependency);
    }
  },

  _filterExportJSON : function(currentInformation) {
    currentInformation.settingsArrayPack   = this.hiddenElementOptions;
    currentInformation.selectorOptionsJSON = this.hiddenSelectorOptions;
    currentInformation.optionsJSON         = {
      'hasSettingSpectralModeDefaultEnabled' : this.hasSettingSpectralModeDefaultEnabled,
      'hasSettingEMOptionDefaultSelected'    : this.hasSettingEMOptionDefaultSelected,
      'hasSettingEnableColorPicker'          : this.hasSettingEnableColorPicker,
      'hasSettingEnableKeyboardArrowSupport' : this.hasSettingEnableKeyboardArrowSupport,
      'hasSettingEnableElementPanelFilter'   : this.hasSettingEnableElementPanelFilter,
      'hasSettingFieldDefaultValue'          : this.hasSettingFieldDefaultValue,
      'hasSettingEnableAdvancedFeatures'     : this.hasSettingEnableAdvancedFeatures,
      'hasSettingEnableImportantElement'     : this.hasSettingEnableImportantElement,
      'hasSettingEnableElementSelectors'     : this.hasSettingEnableElementSelectors
    };

    return currentInformation;
  },

  /**
   * @return {string}
   */
  GetElementAbsolutePath : function( jQueryElement, jQueryBaseElement ) {
    var elementPath    = '',
        currentElement = jQueryElement,
        baseElement    = ( typeof jQueryBaseElement == "undefined" ? false : jQueryBaseElement );

    var i = 1;do {
      var currentElementPath = currentElement[0].tagName.toLowerCase();

      if(typeof currentElement.attr("id") !== "undefined")
        if(jQuery.trim(currentElement.attr("id")) != "")
          currentElementPath += '#' + currentElement.attr("id");

      if(currentElement[0].tagName !== "BODY" && currentElement[0].tagName !== "body" &&
          typeof currentElement.attr("class") !== "undefined") {
        var currentClassList = currentElement.attr("class").split(" ");

        jQuery.each(this._absoluteClassInterpretationSettings, function(presentInterpretationClass, removedClasses) {
          if(jQuery.inArray(presentInterpretationClass, currentClassList) || presentInterpretationClass === "*") {
            jQuery.each(removedClasses, function(index, currentRemovedClass) {
              for(var indexLevel = 0; indexLevel < currentClassList.length; indexLevel++) {
                var currentClass = currentClassList[indexLevel];

                if(currentClass === currentRemovedClass) {
                  currentClassList.splice(indexLevel, 1);
                  indexLevel--;
                } else if(currentRemovedClass.indexOf("^") !== -1 &&
                    currentClass.indexOf(currentRemovedClass.substr(0, currentRemovedClass.length - 1)) === 0) {
                  currentClassList.splice(indexLevel, 1);
                  indexLevel--;
                }
              }
            });
          }
        });

        if(currentClassList.length > 0) {
          var currentClassNode = jQuery.trim("." + currentClassList.join("."));

          currentElementPath += (currentClassNode != "." ? currentClassNode : '');

        }
      }

      elementPath    = currentElementPath + (elementPath !== '' ? ' > ' : '') + elementPath;
      currentElement = currentElement.parent();i++;

      if( baseElement != false && currentElement.is( baseElement ) )
        break;

    } while(currentElement[0].tagName !== 'HTML' && currentElement[0].tagName !== 'html');

    return elementPath;
  },

  /**
   * @return {string}
   */
  GetElementGenericPath : function(jQueryElement, ignoreClass) {
    var elementPath    = '',
        currentElement = jQueryElement;
        ignoreClass    = (typeof ignoreClass === "undefined" ? true : ignoreClass);

    var i = 1;do {
      var currentElementPath = currentElement[0].tagName.toLowerCase();

      if(currentElement[0].tagName !== "BODY" && currentElement[0].tagName !== "body" &&
          typeof currentElement.attr("class") !== "undefined" && ignoreClass == false) {
        var currentClassList = currentElement.attr("class").split(" ");

        jQuery.each(this._classInterpretationSettings, function(presentInterpretationClass, removedClasses) {
          if(jQuery.inArray(presentInterpretationClass, currentClassList) !== -1 || presentInterpretationClass === "*") {
            jQuery.each(removedClasses, function(index, currentRemovedClass) {
              for(var indexLevel = 0; indexLevel < currentClassList.length; indexLevel++) {
                var currentClass = currentClassList[indexLevel];

                if(currentClass === currentRemovedClass) {
                  currentClassList.splice(indexLevel, 1);
                  indexLevel--;
                } else if(currentRemovedClass.indexOf("^") !== -1 &&
                    currentClass.indexOf(currentRemovedClass.substr(0, currentRemovedClass.length - 1)) === 0) {
                  currentClassList.splice(indexLevel, 1);
                  indexLevel--;
                }
              }
            });
          }
        });

        if(currentClassList.length > 0) {
          var currentClassNode = jQuery.trim("." + currentClassList.join("."));

          currentElementPath += (currentClassNode != "." ? currentClassNode : '');

        }
      }

      elementPath    = currentElementPath + (elementPath !== '' ? ' > ' : '') + elementPath;
      currentElement = currentElement.parent();i++;
    } while(currentElement[0].tagName !== 'HTML' && currentElement[0].tagName !== 'html');

    return elementPath;
  },

  PrefixNonEventSettings : function(settingsObject, namespace) {
    jQuery.each(settingsObject, function(key, value){
      if (key.endsWith("ID")
          || key.endsWith("Class"))
        settingsObject[key] = namespace + value;

      if(key.endsWith("Attribute") || key.endsWith("Attr"))
        settingsObject[key] = 'data-' + namespace + value;
    });

    return settingsObject;
  },

  SyncLayoutWithExternalCSSDependencies : function() {
    var styleSheetContent = '';

    jQuery.each(this.externalCSSResources, function(key, value) {
      styleSheetContent += '@import url("' + value + '");' + "\n";
    });

    if(styleSheetContent == '') {
      if(this.externalCSSResourcesContainerObject != false) {
        this.externalCSSResourcesContainerObject.remove();
        this.externalCSSResourcesContainerObject = false;
      }

      return;
    }

    if(this.externalCSSResourcesContainerObject == false) {
      jQuery("head").append('<style id="' + this._settings.externalCSSResourcesContainerID + '"></style>');

      this.externalCSSResourcesContainerObject = jQuery("#" + this._settings.externalCSSResourcesContainerID);
    }

    this.externalCSSResourcesContainerObject.html(styleSheetContent);
  },

  _injectDependencyWithinApplication : function(injectionObject, currentPattern) {
    currentPattern = typeof currentPattern == "undefined" ? '' : currentPattern;

    var objectInstance                     = this,
        currentInjectedObject              = this,
        currentInjectedObjectPatternTokens = currentPattern.split(".");

    jQuery.each(currentInjectedObjectPatternTokens, function(patternKey, patternValue){
      if(patternValue != '' && typeof currentInjectedObject[patternValue] !== "undefined")
        currentInjectedObject = currentInjectedObject[patternValue];
    });

    jQuery.each(injectionObject, function(currentInjectionIndex, injection){
      if(typeof currentInjectedObject[currentInjectionIndex] !== "undefined")
        currentInjectedObject[currentInjectionIndex] = jQuery.extend(true, currentInjectedObject[currentInjectionIndex], injection);
      else
        objectInstance._injectDependencyWithinApplication(injection, currentPattern + '.' + currentInjectionIndex);
    });
  }

};

if (typeof String.prototype.endsWith !== 'function') {
  String.prototype.endsWith = function(suffix) {
    return this.indexOf(suffix, this.length - suffix.length) !== -1;
  };
}

if (typeof String.prototype.startsWith != 'function') {
  String.prototype.startsWith = function (str){
    return this.indexOf(str) == 0;
  };
}

// @codekit-append  "lib/filterManager.js",  "lib/eventManager.js", "lib/stylesheetSupport.js", "lib/navigation.js", "lib/navigationPanel.js", "lib/panel.js", "lib/pageVersions.js", "lib/pageVersionsPanel.js"
// @codekit-append "lib/elementPanel.js", "lib/elementOption.js", "lib/elementOptions.js", "lib/elementOperations.js"
// @codekit-append "lib/applicationSynchronize.js", "lib/utility.js", "lib/settingsPanel.js", "lib/selectorOption.js"
// @codekit-append "lib/macro.js", "lib/macroInterface.js", "lib/macroInterfaceOperations.js", "lib/progressPanel.js"
// @codekit-append "lib/quickAccessOptions.js", "lib/syntaxSelectionPanel.js"

jQuery(document).ready(function(){
  VisualDeveloper.Init();
});