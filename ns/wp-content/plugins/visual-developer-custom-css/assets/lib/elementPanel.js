VisualDeveloper.ElementPanel = {

  visualDeveloperInstance : {},

  _lang : {
    toggleSpectralMode : 'Spectral Mode',
    reset              : 'Reset Element',
    filter             : 'Find Option(s)',
    macro              : 'Interactive Mode',
    selector           : 'Pseudo Selector',
    selectorIcon       : 'selector-options',
    selectorModalTitle : 'Change Customization Selector',
    resetModalTitle    : 'Are you sure ?'
  },

  _settings : {
    arrangeEvents                                 : 'resize scroll',
    elementPanelActivePatternClass                : 'element-panel-active-pattern',
    spectralModeBodyClass                         : 'spectral-mode',
    spectralModeOverlayID                         : 'spectral-mode-overlay',
    spectralModeArrangeEvent                      : 'resize scroll',
    panelID                                       : 'element-panel',
    panelOperationsContainerID                    : 'element-panel-operations-container',
    panelOperationsContainerActiveSelectorClass   : 'element-panel-operations-container-has-selector',
    panelOperationsContainerActiveSearchClass     : 'element-panel-operations-container-has-search',
    panelOperationsOptionsContainerID             : 'element-panel-operations-options-container',
    panelOperationsOptionActiveClass              : 'element-panel-option-active',
    panelOperationsOptionToggleSpectralModeID     : 'element-panel-option-toggle-spectral-mode',
    panelOperationsOptionResetID                  : 'element-panel-option-reset',
    panelOperationsOptionMacroID                  : 'element-panel-option-macro',
    panelOperationsOptionFilterID                 : 'element-panel-option-filter',
    panelOperationsOptionSelectorID               : 'element-panel-option-selector',
    panelOperationsOptionSelectorActiveClass      : 'element-panel-option-selector-active',
    panelOperationsOptionTrigger                  : 'click',
    panelOperationsInputOptionTrigger             : 'change keyup',
    panelOperationGroupClass                      : 'operation-group',
    panelOperationGroupAliasAttribute             : 'operation-group-name',
    panelOperationElementOptionClass              : 'operation-element-option',
    panelOperationElementOptionAliasAttribute     : 'operation-element-alias',
    linkDisableEventTrigger                       : 'click'
  },

  eventElementPanelDisplay  : 'element_panel_display',
  eventElementPanelClose    : 'element_panel_close',

  baseElementPattern        : false,
  baseElementObject         : false,
  elementPattern            : "",
  elementPatternMD5         : "",
  elementObject             : false,
  elementOptionsObjectList  : {},

  currentElementPosition                : "left",
  currentPanelObject                    : false,
  currentPanelOptionsContainerObject    : false,
  currentPanelOptionResetObject         : false,
  currentPanelOptionSpectralModeObject  : false,
  currentPanelOptionMacroObject         : false,
  currentPanelOptionFilterObject        : false,
  currentPanelOptionSelectorObject      : false,
  currentPanelOperationsObject          : false,
  currentPanelOperationsOptionsObject   : false,
  currentPanelOperationsLabels          : false,
  currentPanelOperationsGroups          : false,
  spectralModeOverlayObject             : false,

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
    this._registerFilterAndEvents();
  },

  _initDependencies : function() {
    this._prefixCSSSettings();

    this._settings.arrangeEvents  = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-element-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-element-panel ';

    this._settings.panelOperationsOptionTrigger  = this._settings.panelOperationsOptionTrigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-element-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-element-panel ';

    this._settings.panelOperationsInputOptionTrigger  = this._settings.panelOperationsInputOptionTrigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-element-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-element-panel ';

    this._settings.linkDisableEventTrigger  = this._settings.linkDisableEventTrigger
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-link-disable ') +
        '.' + this.visualDeveloperInstance.namespace + '-link-disable ';

    this._settings.spectralModeArrangeEvent  = this._settings.spectralModeArrangeEvent
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-spectral-mode ') +
        '.' + this.visualDeveloperInstance.namespace + '-spectral-mode ';
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  _registerFilterAndEvents : function() {
    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.universalEventSettingsUpdate,
        this,
        '_universalEventSettingsUpdateHandler'
    );

    this.visualDeveloperInstance.FilterManager.listenFilter(
        this.visualDeveloperInstance.universalFilterSettingsExport,
        this,
        '_filterExportSettingsLayoutInformation'
    );

    this.visualDeveloperInstance.FilterManager.listenFilter(
        this.visualDeveloperInstance.universalFilterStylesheetFile,
        this,
        '_filterExportStylesheet'
    );

    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.Panel.eventPanelRefresh,
        this,
        '_arrangePanel'
    );


    this.visualDeveloperInstance.EventManager.registerEvent(this.eventElementPanelDisplay);
    this.visualDeveloperInstance.EventManager.registerEvent(this.eventElementPanelClose);
  },

  InitPatternCustomization : function(elementPattern) {
    this._reset();

    this.baseElementPattern = this.baseElementPattern == false ?
        elementPattern : this.baseElementPattern;

    if(elementPattern.startsWith(this.baseElementPattern) == false
        || this.baseElementPattern.split(">").length != elementPattern.split(">").length)
      this.baseElementPattern = elementPattern;

    this.baseElementObject    = jQuery(this.baseElementPattern);

    this.elementPattern       = elementPattern;
    this.elementPatternMD5    = CryptoJS.MD5(this.elementPattern).toString(CryptoJS.enc.Hex);
    this.elementObject        = jQuery(elementPattern);

    if(this.baseElementObject.eq(0).offset().left > jQuery(window).width() / 2)
      this.currentElementPosition = "right";

    if(typeof this.elementOptionsObjectList[this.elementPatternMD5] === "undefined") {
      this.elementOptionsObjectList[this.elementPatternMD5] =
          jQuery.extend(1, {}, this.visualDeveloperInstance.ElementOptions);
      this.elementOptionsObjectList[this.elementPatternMD5]
          .Init(this.visualDeveloperInstance, elementPattern);
    }

    this.baseElementObject.addClass(this._settings.elementPanelActivePatternClass);

    jQuery("a")
        .unbind(this._settings.linkDisableEventTrigger)
        .bind(this._settings.linkDisableEventTrigger, function(event) {
          event.stopImmediatePropagation();
          event.stopPropagation();
          event.preventDefault();
        });

    this._displayPanel();
  },

  _displayPanel : function() {
    var objectInstance = this;

    if(this.currentPanelObject == false) {
      this.visualDeveloperInstance.Panel.currentPanelObject.append(this._getPanelHTML());

      this.currentPanelObject                    = jQuery('#' + this._settings.panelID);
      this.currentPanelOptionsContainerObject    = jQuery('#' + this._settings.panelOperationsOptionsContainerID);
      this.currentPanelOperationsObject          = jQuery('#' + this._settings.panelOperationsContainerID);
      this.currentPanelOperationsOptionsObject   = jQuery('#' + this._settings.panelOperationsOptionsContainerID);
      this.currentPanelOperationsGroups          = this.currentPanelOperationsObject.find('> .' + this._settings.panelOperationGroupClass);

      this.currentPanelOptionResetObject         = this.currentPanelObject.find("#" + this._settings.panelOperationsOptionResetID);
      this.currentPanelOptionSpectralModeObject  = this.currentPanelObject.find("#" + this._settings.panelOperationsOptionToggleSpectralModeID);
      this.currentPanelOptionFilterObject        = this.currentPanelObject.find("#" + this._settings.panelOperationsOptionFilterID);
      this.currentPanelOptionSelectorObject      = this.currentPanelObject.find("#" + this._settings.panelOperationsOptionSelectorID);
      this.currentPanelOptionMacroObject         = this.currentPanelObject.find("#" + this._settings.panelOperationsOptionMacroID);

      this.currentPanelObject.hide().fadeIn("slow");

      this._assignPanelActions();
      this._arrangePanel();

      jQuery(window).unbind(this._settings.arrangeEvents).bind(this._settings.arrangeEvents, function(){
        objectInstance._arrangePanel();
      });
    } else {
      this.RefreshPanelOperationsContent();
      this._arrangePanel();
    }

    this.visualDeveloperInstance.EventManager.triggerEvent(this.eventElementPanelDisplay, {});
  },

  _universalEventSettingsUpdateHandler : function(JSONInformation) {
    if(typeof JSONInformation.layout_information !== "undefined") {
      var objectInstance = this;

      jQuery.each(JSONInformation['layout_information'], function(index, elementOptionJSONPack){
        var md5Hash = CryptoJS.MD5(elementOptionJSONPack._elementPattern).toString(CryptoJS.enc.Hex);

        objectInstance.elementOptionsObjectList[md5Hash] = jQuery.extend(
            1, {}, objectInstance.visualDeveloperInstance.ElementOptions
        );
        objectInstance.elementOptionsObjectList[md5Hash].InitFromPackedJSONObject(
                objectInstance.visualDeveloperInstance, elementOptionJSONPack
        );
      });
    }

    if(this.currentPanelObject != false) {
      this.RefreshPanelOperationsContent();
      this._arrangePanel();
    }
  },

  RefreshPanelOperationsContent : function() {
    this.currentPanelOperationsObject.html(this._getPanelOperationsContainer());
    this.currentPanelOperationsGroups = this.currentPanelOperationsObject.find('> .' + this._settings.panelOperationGroupClass);

    this._assignPanelActions(true);
  },

  /**
   * @returns {string}
   * @private
   */
  _getPanelHTML : function() {
    var panelHTML = '';

    panelHTML += '<div id="' + this._settings.panelID + '">';
    panelHTML +=  '<div id="' + this._settings.panelOperationsOptionsContainerID + '">';
    panelHTML +=    this._getPanelOperationsOptionsContainer();
    panelHTML +=  '</div>';
    panelHTML +=  '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=  '<div id="' + this._settings.panelOperationsContainerID + '">';
    panelHTML +=    this._getPanelOperationsContainer();
    panelHTML +=  '</div>';
    panelHTML +=  '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML += '</div>';

    return panelHTML;
  },

  _arrangePanel : function() {
    if(this.currentPanelObject == false)
      return;

    var topDistance  = this.visualDeveloperInstance.Panel.currentPanelContainerObject.height() +
        this.visualDeveloperInstance.Panel.currentPanelUserNotificationObject.innerHeight() +
        (this.visualDeveloperInstance.toolbarObject.length > 0 ? this.visualDeveloperInstance.toolbarObject.height() : 0);

    this.currentPanelObject.height(jQuery(window).height() - topDistance);
    this.currentPanelOperationsObject.css("height",
      this.currentPanelObject.height() - this.currentPanelOperationsOptionsObject.height()
    );
  },

  _assignPanelActions : function(isRefresh) {
    isRefresh = typeof isRefresh == "undefined" ? false : isRefresh;
    var objectInstance = this;

    if( this.visualDeveloperInstance.hasSettingEnableElementSelectors )
      this.currentPanelOptionsContainerObject.addClass(this._settings.panelOperationsContainerActiveSelectorClass);
    else
      this.currentPanelOptionsContainerObject.removeClass(this._settings.panelOperationsContainerActiveSelectorClass);

    if( this.visualDeveloperInstance.hasSettingEnableElementPanelFilter )
      this.currentPanelOptionsContainerObject.addClass(this._settings.panelOperationsContainerActiveSearchClass);
    else
      this.currentPanelOptionsContainerObject.removeClass(this._settings.panelOperationsContainerActiveSearchClass);

    this.currentPanelOptionSpectralModeObject
        .unbind(this._settings.panelOperationsOptionTrigger)
        .bind(this._settings.panelOperationsOptionTrigger, function(event){
      event.stopImmediatePropagation();
      event.preventDefault();

      if(objectInstance.spectralModeOverlayObject !== false)
        objectInstance._cancelSpectralMode();
      else
        objectInstance._enableSpectralMode();
    });

    this.currentPanelOptionResetObject
        .unbind(this._settings.panelOperationsOptionTrigger)
        .bind(this._settings.panelOperationsOptionTrigger, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          objectInstance.visualDeveloperInstance.Utility.Modal.InitInstance(
              objectInstance._lang.resetModalTitle,
              {
                yes : {
                  name   : "Yes",
                  danger : true
                },

                no  : {
                  name   : "No"
                }
              }, objectInstance, objectInstance._getPanelOperationsOptionResetContainerModalCallback
          );
        });

    this.currentPanelOptionFilterObject
        .unbind(this._settings.panelOperationsInputOptionTrigger)
        .bind(this._settings.panelOperationsInputOptionTrigger, function(event) {
          event.stopImmediatePropagation();
          event.preventDefault();
          var optionAttribute  = objectInstance.visualDeveloperInstance.ElementOperations._settings.fieldElementContainerOptionAttribute,
              currentValue     = jQuery(this).val().trim().toLowerCase(),
              groupOptionsList = objectInstance.currentPanelOperationsGroups.find(
              '.' + objectInstance.visualDeveloperInstance.ElementOperations._settings.fieldElementContainerClass
          );

          if(currentValue == '')
            groupOptionsList.show();
          else
            groupOptionsList
                .hide()
                .filter(function( index ) {
                  return (jQuery(this).attr(optionAttribute).toLowerCase().indexOf(currentValue) !== -1);
                }).show();
        });

    this.currentPanelOptionSelectorObject
        .unbind(this._settings.panelOperationsOptionTrigger)
        .bind(this._settings.panelOperationsOptionTrigger, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          jQuery(this).addClass(objectInstance._settings.panelOperationsOptionSelectorActiveClass);

          objectInstance.panelOperationsOptionSelectorTriggerModal();
        });

    if(this.spectralModeOverlayObject === false
        && isRefresh == false) {
      if(this.visualDeveloperInstance.hasSettingSpectralModeDefaultEnabled)
        this._enableSpectralMode();
      else
        this._cancelSpectralMode();
    }

    this.currentPanelOptionMacroObject
        .unbind(this._settings.panelOperationsOptionTrigger)
        .bind(this._settings.panelOperationsOptionTrigger, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          if(objectInstance.visualDeveloperInstance.MacroInterface.isActive) {
            objectInstance.visualDeveloperInstance.MacroInterface.CloseInterface();
            jQuery(this).removeClass(objectInstance._settings.panelOperationsOptionActiveClass);
          } else {
            objectInstance.visualDeveloperInstance.MacroInterface.DisplayInterface();
            jQuery(this).addClass(objectInstance._settings.panelOperationsOptionActiveClass);
          }
        });

    if(this.visualDeveloperInstance.hasSettingEnableElementPanelFilter == false)
      this.currentPanelOptionFilterObject.val("").hide().trigger("change");
    else
      this.currentPanelOptionFilterObject.show();

    this.visualDeveloperInstance.ElementOperations.AssignElementOperationsInOperationGroups(
        this.elementOptionsObjectList[this.elementPatternMD5],
        this.currentPanelOperationsGroups
    );
  },

  _getPanelOperationsOptionResetContainerModalCallback : function(response) {
    if(response == 'no')
      return;

    this.currentPanelOperationsGroups.find(":input").val("");
    this.currentPanelOperationsGroups.find(
        "." + this.visualDeveloperInstance.ElementOperations._settings.fieldElementContainerClass
    ).removeClass(this.visualDeveloperInstance.ElementOperations._settings.fieldElementActiveStateClass);

    this.elementOptionsObjectList[this.elementPatternMD5].Reset();
  },

  _getPanelOperationsOptionsContainer : function() {
    var operationsHTML = "";

    operationsHTML +=  '<span id="' + this._settings.panelOperationsOptionToggleSpectralModeID + '">';
    operationsHTML +=    this._lang.toggleSpectralMode;
    operationsHTML +=  '</span>';

    operationsHTML +=  '<span id="' + this._settings.panelOperationsOptionResetID + '">';
    operationsHTML +=    this._lang.reset;
    operationsHTML +=  '</span>';

    operationsHTML +=  '<span id="' + this._settings.panelOperationsOptionMacroID + '">';
    operationsHTML +=    this._lang.macro;
    operationsHTML +=  '</span>';

    operationsHTML +=  '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';

    operationsHTML += '<input type="text" ' +
                             'id="' + this._settings.panelOperationsOptionFilterID + '" ' +
                             'placeholder="' + this._lang.filter + '"/>';

    if( this.visualDeveloperInstance.hasSettingEnableElementSelectors )
    operationsHTML +=  '<span id="' + this._settings.panelOperationsOptionSelectorID + '" class="' + this._lang.selectorIcon + '">' +
                          this._lang.selector +
                       '</span>';

    operationsHTML +=  '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';

    return operationsHTML;
  },

  panelOperationsOptionSelectorTriggerModal : function() {
    var objectInstance  = this,
        options         = {},
        activeOption    = false;

    jQuery.each(this.visualDeveloperInstance.SelectorOption, function(selectorIndex, selectorInformation) {
      if(selectorInformation.suffix != ""
          && objectInstance.elementPattern.endsWith(selectorInformation.suffix))
        activeOption = selectorIndex;
    });

    activeOption = activeOption == false ? "default" : activeOption;

    jQuery.each(this.visualDeveloperInstance.SelectorOption, function(selectorIndex, selectorInformation) {
      options[selectorIndex] = {
        name      : selectorInformation.name,
        active    : selectorIndex == activeOption,
        highlight : (typeof objectInstance.elementOptionsObjectList[CryptoJS.MD5(objectInstance.baseElementPattern + selectorInformation.suffix).toString(CryptoJS.enc.Hex)] !== "undefined")
      };
    });

    this.visualDeveloperInstance.Utility.Modal.InitInstance(this._lang.selectorModalTitle, options, this, this._getPanelOperationsOptionSelectorContainerModalCallback);
  },

  _getPanelOperationsOptionSelectorContainerModalCallback : function(response) {
    this.currentPanelOptionSelectorObject.removeClass(this._settings.panelOperationsOptionSelectorActiveClass);

    this.InitPatternCustomization(
        this.baseElementPattern + this.visualDeveloperInstance.SelectorOption[response].suffix
    );
  },

  _getPanelOperationsContainer : function() {
    var objectInstance = this,
        operationsHTML = '',
        groupMap       = this._getPanelOperationsGroupsMap();

    jQuery.each(groupMap, function(groupName, groupOptions){
      operationsHTML += '<div class="' + objectInstance._settings.panelOperationGroupClass + '"' +
                              objectInstance._settings.panelOperationGroupAliasAttribute + '="' + groupName + '"' +
                        '>';
      jQuery.each(groupOptions, function(optionWeight, optionIndex){
        operationsHTML += objectInstance.visualDeveloperInstance.ElementOperations.GetElementOptionSettingsHTML(optionIndex);
      });
      operationsHTML += '</div>';
    });

    operationsHTML += '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';

    return operationsHTML;
  },

  _getPanelOperationsGroupsMap : function() {
    var objectInstance = this,
        groupMap = {};

    jQuery.each(this.visualDeveloperInstance.ElementOption, function(optionIndex, optionInformation) {
      if(jQuery.inArray(optionIndex, objectInstance.visualDeveloperInstance.hiddenElementOptions) == -1) {
        if(typeof groupMap[optionInformation.group] === "undefined")
          groupMap[optionInformation.group] = {};

        var optimalIndex = optionInformation.weight;

        while(typeof groupMap[optionInformation.group][optimalIndex] !== "undefined")
          optimalIndex++;

        groupMap[optionInformation.group][optimalIndex] = optionIndex;
      }
    });

    return groupMap;
  },

  _reset : function() {
    jQuery("body").removeClass(this._settings.elementPositionLeftBodyClass);

    if(this.elementObject !== false) {
      this.elementObject.removeClass(this._settings.elementPanelActivePatternClass);
      this.elementObject = false;
    }

    this.elementPattern = "";
  },

  _filterExportSettingsLayoutInformation : function(currentInformation) {
    currentInformation.layoutInfoJSONPack = [];

    if(typeof this.elementOptionsObjectList !== "undefined") {
      jQuery.each(this.elementOptionsObjectList, function(key, optionsObject){
        currentInformation.layoutInfoJSONPack[currentInformation.layoutInfoJSONPack.length]
            = optionsObject.GetInformationPackJSON();
      });
    }

    return currentInformation;
  },

  _filterExportStylesheet : function(stylesheet) {
    stylesheet = typeof stylesheet == "undefined" ? '' : stylesheet;

    if(typeof this.elementOptionsObjectList !== "undefined") {
      jQuery.each(this.elementOptionsObjectList, function(key, optionsObject){
        stylesheet += optionsObject.GetStylesheetCSSRulesText();
      });
    }

    return stylesheet;
  },

  _enableSpectralMode : function() {
    jQuery("body").addClass(this._settings.spectralModeBodyClass);

    this.currentPanelOptionSpectralModeObject.addClass(this._settings.panelOperationsOptionActiveClass);

    if(this.spectralModeOverlayObject === false) {
      jQuery('body').append(this._getSpectralModeOverlay());
      this.spectralModeOverlayObject = jQuery("#" + this._settings.spectralModeOverlayID);

      this.spectralModeOverlayObject.hide();
      this._arrangeSpectralModeOverlay();
      this.spectralModeOverlayObject.fadeIn("slow");

      var objectInstance = this;

      jQuery(window).bind(this._settings.spectralModeArrangeEvent, function(){
        objectInstance._arrangeSpectralModeOverlay();
      });
    }
  },

  _cancelSpectralMode : function() {
    jQuery("body").removeClass(this._settings.spectralModeBodyClass);

    if(typeof this.currentPanelOptionSpectralModeObject === "object")
      this.currentPanelOptionSpectralModeObject.removeClass(this._settings.panelOperationsOptionActiveClass);

    if(this.spectralModeOverlayObject !== false) {
      jQuery(window).unbind(this._settings.spectralModeArrangeEvent);
      this.spectralModeOverlayObject.fadeOut("slow", function(){
        jQuery(this).remove();
      });
      this.spectralModeOverlayObject = false;
    }
  },

  _getSpectralModeOverlay : function() {
    return '<div id="' + this._settings.spectralModeOverlayID + '"></div>';
  },

  _arrangeSpectralModeOverlay : function() {
    this.spectralModeOverlayObject
        .css("width", jQuery(window).width())
        .css("height", jQuery(window).height());
  },

  /**
   * @return {boolean}
   */
  HasPattern : function(path) {
    return (typeof this.elementOptionsObjectList[CryptoJS.MD5(path).toString(CryptoJS.enc.Hex)] !== "undefined");
  },

  Close : function() {
    this._reset();
    this._cancelSpectralMode();

    jQuery("a").unbind(this._settings.linkDisableEventTrigger);

    if(this.currentPanelObject != false) {
      jQuery(window).unbind(this._settings.arrangeEvents);

      this.currentPanelObject.find("*").unbind(this.visualDeveloperInstance.namespace + '-element-panel');
      this.currentPanelObject.fadeOut("slow", function() {
        jQuery(this).remove();
      });

      this.currentPanelObject = false;
    }

    this.visualDeveloperInstance.EventManager.triggerEvent(this.eventElementPanelClose, {});
    this.visualDeveloperInstance.MacroInterface.CloseInterface();
  }

};