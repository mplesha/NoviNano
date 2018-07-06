VisualDeveloper.SettingsPanel = {

  visualDeveloperInstance : {},

  _lang : {
    title                          : "Visual Developer <span>Preferences</span>",
    close                          : "Close",
    elementPanelDisplaySettings    : 'Element Panel Display Options',
    selectorOptionsDisplaySettings : 'Element Selectors Display Options',
    importExportTitle              : 'Import & Export Settings & CSS Modifications',
    importExportWarning            : 'The File APIs are not fully supported in this browser.',
    exportButton                   : 'JSON Export',
    importButton                   : 'JSON Import',
    fullExportButton               : 'CSS Export',
    exportFileName                 : 'visual-developer.json',
    fullExportZIPName              : 'visual-developer-export.zip',
    fullExportSpecifications       : 'Full Export offers you a way to download everything modified within Visual Developer, right away, easily.',
    importNotification             : "Please Wait, Visual Developer is handling the import",
    generalTitle                   : "General Preferences",
    enableSpectralModeByDefault    : 'Enable Spectral Mode by default',
    selectEMValuesByDefault        : 'Work in EM by default instead of pixel',
    enableColorPicker              : 'ColorPicker enabled where it is supported',
    enableKeyboardArrowSupport     : 'Allow arrow usage to increment and decrement numeric values',
    enableElementPanelFilter       : 'Enable Element Panel Filter Box',
    enableFieldDefaultValues       : 'Display default values in the Element Panel ( partial support )',
    enableAdvancedFeatures         : 'Enable Advanced Features, such as "Page Specific" and "Page Versions".',
    enableImportantElement         : 'Enable the option to set an CSS rule to important',
    enableElementSelectors         : 'Enable Element Pseudo Selectors, such as :active or :hover. '
  },

  _settings : {
    bodyClass              : 'settings-panel-active',
    arrangeEvents          : 'resize',
    actionEvents           : 'click',
    settingsActionEvents   : 'click change',
    fileActionEvents       : 'change',
    panelID                : 'settings-panel',
    panelTopSectionID      : 'settings-panel-top-section',
    panelTopCloseID        : 'settings-panel-top-close',
    panelContainerSectionID                       : 'settings-panel-container',
    panelContainerElementOptionContainerID        : 'settings-panel-element-option-container',
    panelContainerElementOptionClass              : 'settings-panel-element-option',
    panelContainerElementOptionActiveClass        : 'settings-panel-active-element-option',
    panelContainerElementOptionIndexAttribute     : 'settings-panel-element-option-index',
    panelContainerSelectorOptionContainerID       : 'settings-panel-selector-option-container',
    panelContainerSelectorOptionClass             : 'settings-panel-selector-option',
    panelContainerSelectorOptionActiveClass       : 'settings-panel-active-selector-option',
    panelContainerSelectorOptionIndexAttribute    : 'settings-panel-selector-option-index',
    panelContainerExportInfoClass                 : 'settings-panel-operation-export-info',
    panelContainerExportID                        : 'settings-panel-operation-export',
    panelContainerImportID                        : 'settings-panel-operation-import',
    panelContainerImportMaskID                    : 'settings-panel-operation-import-mask',
    panelContainerFullExportID                    : 'settings-panel-operation-full-export',
    panelContainerSpectralModeInputID             : 'settings-panel-default-spectral-mode',
    panelContainerSpectralModeInputName           : 'settings-panel-default-spectral-mode',
    panelContainerFieldDefaultValueInputID        : 'settings-panel-field-default-value',
    panelContainerFieldDefaultValueInputName      : 'settings-panel-field-default-value',
    panelContainerCheckboxListClass               : 'utility-svg-checkbox',
    panelContainerCheckboxListSpecificClass       : 'utility-svg-checkbox-option-checkmark',
    panelContainerSelectEMValuesInputID           : 'settings-panel-default-em-values',
    panelContainerSelectEMValuesInputName         : 'settings-panel-default-em-values',
    panelContainerColorPickerInputID              : 'settings-panel-color-picker',
    panelContainerColorPickerInputName            : 'settings-panel-color-picker',
    panelContainerKeyboardArrowSupportInputID     : 'settings-panel-keyboard-arrow-support',
    panelContainerKeyboardArrowSupportInputName   : 'settings-panel-keyboard-arrow-support',
    panelContainerElementPanelFilterInputID       : 'settings-panel-element-panel-filter',
    panelContainerElementPanelFilterInputName     : 'settings-panel-element-panel-filter',
    panelContainerEnableAdvancedFeaturesInputID   : 'settings-panel-enable-advanced-features',
    panelContainerEnableAdvancedFeaturesInputName : 'settings-panel-enable-advanced-features',
    panelContainerEnableImportantElementInputID   : 'settings-panel-enable-element-important',
    panelContainerEnableImportantElementInputName : 'settings-panel-enable-element-important',
    panelContainerEnableElementSelectorsInputID   : 'settings-panel-enable-element-selectors',
    panelContainerEnableElementSelectorsInputName : 'settings-panel-enable-element-selectors',
    fullExportBlacklistedURLPatterns              : ['fonts.googleapis.com']
  },

  currentPanelObject                             : false,
  currentPanelTopSectionObject                   : false,
  currentPanelCloseTriggerObject                 : false,
  currentPanelContainerObject                    : false,
  currentPanelOptionEMValuesObject               : false,
  currentPanelOptionSpectralModeObject           : false,
  currentPanelOptionColorPickerObject            : false,
  currentPanelOptionKeyboardArrowSupportObject   : false,
  currentPanelOptionElementPanelFilterObject     : false,
  currentPanelOptionFieldDefaultValueObject      : false,
  currentPanelOptionEnableAdvancedFeaturesObject : false,
  currentPanelOptionEnableImportantElementObject : false,
  currentPanelOptionEnableElementSelectorsElementObject : false,
  currentPanelElementOptionsObject               : false,
  currentPanelElementSelectorsObject             : false,
  currentPanelExportTriggerObject                : false,
  currentPanelImportTriggerObject                : false,
  currentPanelImportMaskTriggerObject            : false,
  currentPanelFullExportTriggerObject            : false,

  Init : function (visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.arrangeEvents = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-settings-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-settings-panel ';
    this._settings.settingsActionEvents  = this._settings.settingsActionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-settings-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-settings-panel ';
    this._settings.actionEvents  = this._settings.actionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-settings-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-settings-panel ';
    this._settings.fileActionEvents  = this._settings.fileActionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-settings-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-settings-panel ';

    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  DisplayPanel : function() {
    var objectInstance = this;

    jQuery('body')
        .addClass(this._settings.bodyClass)
        .append(this._getPanelHTML());

    this.currentPanelObject                             = jQuery('#' + this._settings.panelID);
    this.currentPanelTopSectionObject                   = jQuery('#' + this._settings.panelTopSectionID);
    this.currentPanelCloseTriggerObject                 = jQuery('#' + this._settings.panelTopCloseID);
    this.currentPanelContainerObject                    = jQuery('#' + this._settings.panelContainerSectionID);
    this.currentPanelOptionSpectralModeObject           = jQuery('#' + this._settings.panelContainerSpectralModeInputID);
    this.currentPanelOptionEMValuesObject               = jQuery('#' + this._settings.panelContainerSelectEMValuesInputID);
    this.currentPanelOptionColorPickerObject            = jQuery('#' + this._settings.panelContainerColorPickerInputID);
    this.currentPanelOptionKeyboardArrowSupportObject   = jQuery('#' + this._settings.panelContainerKeyboardArrowSupportInputID);
    this.currentPanelOptionElementPanelFilterObject     = jQuery('#' + this._settings.panelContainerElementPanelFilterInputID);
    this.currentPanelOptionFieldDefaultValueObject      = jQuery('#' + this._settings.panelContainerFieldDefaultValueInputID);
    this.currentPanelOptionEnableAdvancedFeaturesObject = jQuery('#' + this._settings.panelContainerEnableAdvancedFeaturesInputID);
    this.currentPanelOptionEnableImportantElementObject = jQuery('#' + this._settings.panelContainerEnableImportantElementInputID);
    this.currentPanelOptionEnableElementSelectorsElementObject = jQuery("#" + this._settings.panelContainerEnableElementSelectorsInputID);
    this.currentPanelElementOptionsObject               = this.currentPanelObject.find(
        '.' + this._settings.panelContainerElementOptionClass
    );
    this.currentPanelElementSelectorsObject = this.currentPanelObject.find(
        '.' + this._settings.panelContainerSelectorOptionClass
    );
    this.currentPanelExportTriggerObject      = jQuery('#' + this._settings.panelContainerExportID);
    this.currentPanelImportTriggerObject      = jQuery('#' + this._settings.panelContainerImportID);
    this.currentPanelImportMaskTriggerObject  = jQuery('#' + this._settings.panelContainerImportMaskID);
    this.currentPanelFullExportTriggerObject  = jQuery('#' + this._settings.panelContainerFullExportID);

    this._arrangePanel();
    this._assignPanelActions();

    this.visualDeveloperInstance.Utility.SVGCheckbox.InitInstance(
        this.currentPanelObject.find('.' + this._settings.panelContainerCheckboxListClass)
    );

    this.currentPanelObject.hide().fadeIn("slow");

    jQuery(window).bind(this._settings.arrangeEvents, function(){
      objectInstance._arrangePanel();
    });
  },

  HidePanel : function() {
    jQuery('body').removeClass(this._settings.bodyClass);

    jQuery(window).unbind(this._settings.arrangeEvents);
    this.currentPanelObject.find("*").unbind(this.visualDeveloperInstance.namespace + '-settings-panel');

    this.visualDeveloperInstance.EventManager.triggerEvent(
        this.visualDeveloperInstance.universalEventSettingsUpdate
    );

    this.currentPanelObject.fadeOut("slow", function(){
      jQuery(this).remove();
    });
  },

  _getPanelHTML : function() {
    var panelHTML = '';

    panelHTML += '<div id="' + this._settings.panelID + '">';
    panelHTML +=  '<div id="' + this._settings.panelTopSectionID + '">';
    panelHTML +=    '<h2>' + this._lang.title + '</h2>';
    panelHTML +=    '<span id="' + this._settings.panelTopCloseID + '">' + this._lang.close + '</span>';
    panelHTML +=    '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=  '</div>';
    panelHTML +=  '<div id="' + this._settings.panelContainerSectionID + '">';
    panelHTML +=    this._getGeneralSettingsContainerHTML();
    panelHTML +=    this._getImportExportContainerHTML();
    panelHTML +=    this._getPanelContainerHTML();
    panelHTML +=    this._getPanelSelectorOptionsHTML();
    panelHTML +=  '</div>';
    panelHTML += '</div>';

    return panelHTML;
  },

  _getGeneralSettingsContainerHTML : function() {
    var generalSettingsContainerHTML = '';

    generalSettingsContainerHTML += '<h2>' + this._lang.generalTitle + '</h2>';
    generalSettingsContainerHTML += '<ul class="' + this._settings.panelContainerCheckboxListClass + ' ' + this._settings.panelContainerCheckboxListSpecificClass + '">';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerSpectralModeInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerSpectralModeInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingSpectralModeDefaultEnabled ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerSpectralModeInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableSpectralModeByDefault;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerSelectEMValuesInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerSelectEMValuesInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEMOptionDefaultSelected ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerSelectEMValuesInputID + '">';
    generalSettingsContainerHTML +=       this._lang.selectEMValuesByDefault;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerColorPickerInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerColorPickerInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEnableColorPicker ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerColorPickerInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableColorPicker;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerKeyboardArrowSupportInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerKeyboardArrowSupportInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEnableKeyboardArrowSupport ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerKeyboardArrowSupportInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableKeyboardArrowSupport;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerElementPanelFilterInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerElementPanelFilterInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEnableElementPanelFilter ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerElementPanelFilterInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableElementPanelFilter;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerFieldDefaultValueInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerFieldDefaultValueInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingFieldDefaultValue ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerFieldDefaultValueInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableFieldDefaultValues;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerEnableAdvancedFeaturesInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerEnableAdvancedFeaturesInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEnableAdvancedFeatures ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerEnableAdvancedFeaturesInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableAdvancedFeatures;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerEnableImportantElementInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerEnableImportantElementInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEnableImportantElement ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerEnableImportantElementInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableImportantElement;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML +=   '<li>';
    generalSettingsContainerHTML +=     '<input id="' + this._settings.panelContainerEnableElementSelectorsInputID + '" ';
    generalSettingsContainerHTML +=            'name="' + this._settings.panelContainerEnableElementSelectorsInputName + '" ';
    generalSettingsContainerHTML +=            (this.visualDeveloperInstance.hasSettingEnableElementSelectors ? 'checked="checked" ' : '');
    generalSettingsContainerHTML +=            'type="checkbox">';
    generalSettingsContainerHTML +=     '<label for="' + this._settings.panelContainerEnableElementSelectorsInputID + '">';
    generalSettingsContainerHTML +=       this._lang.enableElementSelectors;
    generalSettingsContainerHTML +=     '</label>';
    generalSettingsContainerHTML +=   '</li>';
    generalSettingsContainerHTML += '</ul>';
    return generalSettingsContainerHTML;
  },

  _getImportExportContainerHTML : function() {
    var importExportContainerHTML = '';

    importExportContainerHTML += '<h2>' + this._lang.importExportTitle + '</h2>';

    if (!(window.File && window.FileReader && window.Blob)) {
      importExportContainerHTML += '<div class="warning">' + this._lang.importExportWarning + '</div>';

      return importExportContainerHTML;
    }

    importExportContainerHTML +=  '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';

    importExportContainerHTML += '<input id="' + this._settings.panelContainerImportID + '" type="file"/>';

    importExportContainerHTML += '<span id="' + this._settings.panelContainerImportMaskID + '">' +
                                    this._lang.importButton +
                                 '</span>';

    importExportContainerHTML += '<span id="' + this._settings.panelContainerExportID + '">' +
                                    this._lang.exportButton +
                                 '</span>';

    importExportContainerHTML += '<span id="' + this._settings.panelContainerFullExportID + '">' +
                                    this._lang.fullExportButton +
                                 '</span>';

    importExportContainerHTML +=  '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';

    importExportContainerHTML += '<p class="' + this._settings.panelContainerExportInfoClass + '">' +
                                    this._lang.fullExportSpecifications +
                                  '</p>';

    return importExportContainerHTML;
  },

  _getPanelContainerHTML : function() {
    var objectInstance     = this,
        panelContainerHTML = '';

    panelContainerHTML += '<h2>' + this._lang.elementPanelDisplaySettings + '</h2>';

    panelContainerHTML += '<ul id="' + this._settings.panelContainerElementOptionContainerID + '">';

    jQuery.each(this.visualDeveloperInstance.ElementOption, function(optionIndex, optionInformation) {
      var currentItemClass = objectInstance._settings.panelContainerElementOptionClass + " ";

      if(jQuery.inArray(optionIndex, objectInstance.visualDeveloperInstance.hiddenElementOptions) == - 1)
        currentItemClass += objectInstance._settings.panelContainerElementOptionActiveClass + ' ';


      panelContainerHTML += '<li class="' + currentItemClass + '" ' +
                                 objectInstance._settings.panelContainerElementOptionIndexAttribute + '="' +
                                  optionIndex + '" ' +
                              '>' +
                              '<span>' + optionInformation.name + '</span>' +
                            '</li>';
    });

    panelContainerHTML += '</ul>';

    return panelContainerHTML;
  },

  _getPanelSelectorOptionsHTML : function() {
    var objectInstance           = this,
        panelSelectorOptionsHTML = '';

    panelSelectorOptionsHTML += '<h2>' + this._lang.selectorOptionsDisplaySettings + '</h2>';

    panelSelectorOptionsHTML += '<ul id="' + this._settings.panelContainerSelectorOptionContainerID + '">';

    jQuery.each(this.visualDeveloperInstance.SelectorOption, function(optionIndex, optionInformation) {
      if(optionInformation.optional == true) {
        var currentItemClass = objectInstance._settings.panelContainerSelectorOptionClass + " ";

        if(jQuery.inArray(optionIndex, objectInstance.visualDeveloperInstance.hiddenSelectorOptions) == - 1)
          currentItemClass += objectInstance._settings.panelContainerSelectorOptionActiveClass + ' ';


        panelSelectorOptionsHTML += '<li class="' + currentItemClass + '" ' +
                                      objectInstance._settings.panelContainerSelectorOptionIndexAttribute + '="' +
                                      optionIndex + '" ' +
                                      '>' +
                                        '<span>' + optionInformation.name + '</span>' +
                                      '</li>';
      }
    });

    panelSelectorOptionsHTML += '</ul>';

    return panelSelectorOptionsHTML;
  },

  _arrangePanel : function() {
    var wpAdminBarObject = this.visualDeveloperInstance.toolbarObject,
        topDistance      = wpAdminBarObject.length > 0 ? wpAdminBarObject.height() : 0;

    this.currentPanelObject
        .css("position", "fixed")
        .css("top", topDistance)
        .css("left", 0)
        .css("height", jQuery(window).height() - topDistance)
        .css("width", jQuery(window).width());

    this.currentPanelContainerObject
        .css("overflow-y", "auto")
        .css("height", "auto");

    if(this.currentPanelContainerObject.height() + this.currentPanelTopSectionObject.height()
        > this.currentPanelObject.height()) {
      this.currentPanelContainerObject
          .css("overflow-y", "scroll")
          .css("height", this.currentPanelObject.height() - this.currentPanelTopSectionObject.height() - 50);
    }
  },

  _assignPanelActions : function() {
    var objectInstance = this;

    this.currentPanelCloseTriggerObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.HidePanel();
    });

    this.currentPanelElementOptionsObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      var optionIndex = jQuery(this).attr(objectInstance._settings.panelContainerElementOptionIndexAttribute);

      jQuery(this).toggleClass(objectInstance._settings.panelContainerElementOptionActiveClass);

      if(jQuery(this).hasClass(objectInstance._settings.panelContainerElementOptionActiveClass)) {
        objectInstance.visualDeveloperInstance.hiddenElementOptions
            .splice(
                jQuery.inArray(
                    optionIndex,
                    objectInstance.visualDeveloperInstance.hiddenElementOptions
                ), 1
            );
      } else {
        objectInstance.visualDeveloperInstance.hiddenElementOptions[
            objectInstance.visualDeveloperInstance.hiddenElementOptions.length
            ] = optionIndex;
      }
    });

    this.currentPanelElementSelectorsObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
          event.preventDefault();
          event.stopImmediatePropagation();

          var optionIndex = jQuery(this).attr(objectInstance._settings.panelContainerSelectorOptionIndexAttribute);

          jQuery(this).toggleClass(objectInstance._settings.panelContainerSelectorOptionActiveClass);

          if(jQuery(this).hasClass(objectInstance._settings.panelContainerSelectorOptionActiveClass)) {
            objectInstance.visualDeveloperInstance.hiddenSelectorOptions
                .splice(
                    jQuery.inArray(
                        optionIndex,
                        objectInstance.visualDeveloperInstance.hiddenSelectorOptions
                    ), 1
                );
          } else {
            objectInstance.visualDeveloperInstance.hiddenSelectorOptions[
                objectInstance.visualDeveloperInstance.hiddenSelectorOptions.length
                ] = optionIndex;
          }
        });

    this._assignPanelActionsForOptions();
    this._assignPanelActionsImportAndExport();
  },

  _assignPanelActionsForOptions : function() {
    var objectInstance = this;

    this.currentPanelOptionSpectralModeObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingSpectralModeDefaultEnabled = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionEMValuesObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingEMOptionDefaultSelected = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionColorPickerObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingEnableColorPicker = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionKeyboardArrowSupportObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingEnableKeyboardArrowSupport = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionElementPanelFilterObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingEnableElementPanelFilter = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionFieldDefaultValueObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingFieldDefaultValue = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionEnableAdvancedFeaturesObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingEnableAdvancedFeatures = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionEnableImportantElementObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event){
          objectInstance.visualDeveloperInstance.hasSettingEnableImportantElement = jQuery(this).is(":checked") | 0;
        });

    this.currentPanelOptionEnableElementSelectorsElementObject
        .unbind(this._settings.settingsActionEvents)
        .bind(this._settings.settingsActionEvents, function(event) {
          objectInstance.visualDeveloperInstance.hasSettingEnableElementSelectors = jQuery(this).is(":checked") | 0;
        });
  },

  _assignPanelActionsImportAndExport : function() {
    var objectInstance = this;

    this.currentPanelExportTriggerObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
          objectInstance._currentPanelExportTriggerHandler();
        });

    this.currentPanelImportMaskTriggerObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
          objectInstance.currentPanelImportTriggerObject.trigger("click");
        });

    this.currentPanelImportTriggerObject
        .unbind(this._settings.fileActionEvents)
        .bind(this._settings.fileActionEvents, function(event){
          objectInstance._currentPanelImportTriggerHandler(this);
        });

    this.currentPanelFullExportTriggerObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
          objectInstance._currentPanelFullExportTriggerHandler();
        });
  },

  _currentPanelExportTriggerHandler : function() {
    var blob = new Blob(
        [JSON.stringify(this.visualDeveloperInstance.ApplicationSynchronize.GetLayoutInformationExportJSON())],
        {type: "application/json;charset=UTF8"}
    );

    saveAs(blob, this._lang.exportFileName);
  },

  _currentPanelImportTriggerHandler : function(fileInputObject) {
    var objectInstance = this,
        reader         = new FileReader();

    this.visualDeveloperInstance.ApplicationSynchronize.displayLoader(this._lang.importNotification);

    reader.onload = function(e) {
      var jsonInformation = JSON.parse(reader.result);

      objectInstance.visualDeveloperInstance.ApplicationSynchronize.UpdateLayoutInformationFromExportJSON(
          jsonInformation
      );
      objectInstance.visualDeveloperInstance.Panel.currentPanelDisableTriggerObject.trigger("click");
      setTimeout(function(){
        objectInstance.HidePanel();
        objectInstance.visualDeveloperInstance.ApplicationSynchronize.hideLoader();
      }, 1000);
    };

    reader.readAsText(fileInputObject.files[0]);
  },

  _currentPanelFullExportTriggerHandler : function() {
    var objectInstance = this,
        zipObject      = new JSZip();
    zipObject.file(
        "import.json",
        JSON.stringify(this.visualDeveloperInstance.ApplicationSynchronize.GetLayoutInformationExportJSON())
    );

    var stylesheetInfo  = this.visualDeveloperInstance.ApplicationSynchronize.GetCurrentLayoutStylesheet(),
        imageLinks      = this._getAllAssetsLinksFromStylesheetInfo(stylesheetInfo);

    if(imageLinks.length > 0) {
      this._currentPanelFullExportTriggerHandlerRecursiveAssetsHandler(
          zipObject, stylesheetInfo, imageLinks, 0
      );
    } else {
      this._currentPanelFullExportTriggerHandlerAddStylesheetAndDeliverZIPObject(
          zipObject, stylesheetInfo
      );
    }
  },

  _currentPanelFullExportTriggerHandlerRecursiveAssetsHandler : function(
      zipObject, stylesheetInfo, imageLinks, currentPosition
  ) {
    if(imageLinks.length < currentPosition + 1)
      return this._currentPanelFullExportTriggerHandlerAddStylesheetAndDeliverZIPObject(
        zipObject, stylesheetInfo
      );

    var objectInstance = this;

    var xmlHTTP = new XMLHttpRequest();
    xmlHTTP.open('GET',imageLinks[currentPosition],true);
    xmlHTTP.responseType = 'arraybuffer';
    xmlHTTP.onload = function(e) {
      var arr     = new Uint8Array(this.response);
      var content = btoa(String.fromCharCode.apply(null,arr));

      var fileName = "assets/" + currentPosition + "." +
          (imageLinks[currentPosition].split('.').pop());

      zipObject.file(fileName, content, {base64: true});
      stylesheetInfo = stylesheetInfo.replace(
          new RegExp(imageLinks[currentPosition], "g"),
          fileName
      );

      objectInstance._currentPanelFullExportTriggerHandlerRecursiveAssetsHandler(
          zipObject, stylesheetInfo, imageLinks, currentPosition + 1
      );
    };

    xmlHTTP.send();

    return true;
  },

  _currentPanelFullExportTriggerHandlerAddStylesheetAndDeliverZIPObject : function(
      zipObject, stylesheetInfo
  ) {
    zipObject.file("style.css", stylesheetInfo);

    saveAs(zipObject.generate({type:"blob"}), this._lang.fullExportZIPName);
  },

  _getAllAssetsLinksFromStylesheetInfo : function(stylesheetInfo) {
    var imageLinksRegex = /url\("(.+)"\)/g,
        imageLinkMatch,
        imageLinks      = [];

    while (imageLinkMatch = imageLinksRegex.exec(stylesheetInfo)) {
      var isBlacklisted = 0;

      jQuery.each(this._settings.fullExportBlacklistedURLPatterns, function(key, urlPattern) {
        if(imageLinkMatch[1].indexOf(urlPattern) !== -1)
          isBlacklisted = 1;
      });

      if(isBlacklisted == 0)
        imageLinks.push(imageLinkMatch[1]);
    }

    imageLinks      = imageLinks.filter(function(elem,idx,arr){ return arr.indexOf(elem) >= idx; });

    return imageLinks;
  }

};