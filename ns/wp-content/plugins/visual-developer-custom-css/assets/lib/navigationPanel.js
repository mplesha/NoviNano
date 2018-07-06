VisualDeveloper.NavigationPanel = {

  visualDeveloperInstance : {},

  _lang : {
    panelOptionGlobal                   : "Select Structure Based Elements",
    panelOptionGlobalClass              : "Select Structure Class Smart Based Elements",
    panelOptionCurrent                  : "Current Element",
    panelOptionParentElement            : "Parent Element",
    panelOptionReset                    : "Reset",
    panelOptionAdvancedCreation         : "Advanced Creation",
    panelOptionGlobalIcon               : "panel-option-structure",
    panelOptionGlobalClassIcon          : "panel-option-structure-class",
    panelOptionCurrentIcon              : "panel-option-current",
    panelOptionParentElementIcon        : "panel-option-parent",
    panelOptionResetIcon                : "panel-option-reset",
    panelOptionActiveIcon               : "panel-option-active",
    panelOptionAdvancedCreationIcon     : "panel-option-advanced-creation",
    userActionNotificationGlobal        : "<strong>Start customizing</strong>, similar elements have been easily matched.",
    userActionNotificationGlobalClass   : "<strong>Start customizing</strong>, similar elements have been smartly matched.",
    userActionNotificationCurrent       : "<strong>Start customizing</strong> your current element",
    userActionNotificationParentElement : false,
    userActionNotificationReset         : "The previous element is no longer selected, please chose a different one."
  },

  _settings : {
    navigationNamespace                   : '-navigation-panel',
    navigationArrangeEvents               : 'scroll resize',
    navigationPanelID                     : 'navigation-panel',
    navigationPanelToolBarClass           : 'navigation-panel-toolbar',
    navigationOptionGlobalID              : 'navigation-panel-option-global',
    navigationOptionGlobalClassID         : 'navigation-panel-option-global-class',
    navigationOptionCurrentID             : 'navigation-panel-option-current',
    navigationOptionParentElementID       : 'navigation-panel-option-parent-element',
    navigationOptionAdvancedCreationID    : 'navigation-panel-option-advanced-creation',
    navigationOptionResetID               : 'navigation-panel-option-reset',
    navigationOptionIndicatorEvent        : 'mouseenter',
    navigationOptionIndicatorCloseEvent   : 'mouseleave',
    navigationOptionSelectEvent           : 'click'
  },

  currentNavigationPanelObject            : false,
  currentNavigationJQueryDOMElement       : false,
  currentNavigationMirrorJQueryDOMElement : false,

  currentNavigationPanelOptionCurrent          : false,
  currentNavigationPanelOptionGlobal           : false,
  currentNavigationPanelOptionParentElement    : false,
  currentNavigationPanelOptionReset            : false,
  currentNavigationPanelOptionAdvancedCreation : false,


  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.navigationNamespace = this.visualDeveloperInstance.namespace + this._settings.navigationNamespace;

    this._settings.navigationArrangeEvents             = this._settings.navigationArrangeEvents
        .replace(/ /g, '.' + this._settings.navigationNamespace + ' ') +
        '.' + this._settings.navigationNamespace + ' ';
    this._settings.navigationOptionIndicatorEvent      = this._settings.navigationOptionIndicatorEvent
        .replace(/ /g, '.' + this._settings.navigationNamespace + ' ') +
        '.' + this._settings.navigationNamespace + ' ';
    this._settings.navigationOptionIndicatorCloseEvent = this._settings.navigationOptionIndicatorCloseEvent
        .replace(/ /g, '.' + this._settings.navigationNamespace + ' ') +
        '.' + this._settings.navigationNamespace + ' ';
    this._settings.navigationOptionSelectEvent = this._settings.navigationOptionSelectEvent
        .replace(/ /g, '.' + this._settings.navigationNamespace + ' ') +
        '.' + this._settings.navigationNamespace + ' ';

    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  ActivateNodeInstance : function(jQueryDOMElement) {
    this._clearCurrentNavigationJQueryDOMElement();

    this.currentNavigationJQueryDOMElement = jQueryDOMElement;
    this.visualDeveloperInstance.Navigation.MarkNavigationVisualSelectedElement(jQueryDOMElement);

    this.triggerNodeInstancePanel();
  },

  triggerNodeInstancePanel : function() {
    var objectInstance = this;

    jQuery('body').append(this._getPanelHTML());

    this.currentNavigationPanelObject                 = jQuery('#' + this._settings.navigationPanelID);
    this.currentNavigationPanelOptionParentElement    = jQuery('#' + this._settings.navigationOptionParentElementID);
    this.currentNavigationPanelOptionCurrent          = jQuery('#' + this._settings.navigationOptionCurrentID);
    this.currentNavigationPanelOptionGlobal           = jQuery('#' + this._settings.navigationOptionGlobalID);
    this.currentNavigationPanelOptionGlobalClass      = jQuery('#' + this._settings.navigationOptionGlobalClassID);
    this.currentNavigationPanelOptionReset            = jQuery('#' + this._settings.navigationOptionResetID);
    this.currentNavigationPanelOptionAdvancedCreation = jQuery('#' + this._settings.navigationOptionAdvancedCreationID);

    this._arrangePanel();
    this._assignPanelAction();

    jQuery(window).bind(this._settings.navigationArrangeEvents, function(){
      objectInstance._arrangePanel();
    });

    if(this.currentNavigationJQueryDOMElement.is("body")) {
      objectInstance._enableElementPanelOnPattern("body");
    }
  },

  _getPanelHTML : function() {
    var panelHTML = '';

    panelHTML += '<div id="' + this._settings.navigationPanelID + '">';
    panelHTML +=  '<div class="' + this._settings.navigationPanelToolBarClass + '">';
    panelHTML +=    '<span id="' + this._settings.navigationOptionResetID + '"' +
                           'class="icon ' + this._lang.panelOptionResetIcon + ' hint--primary hint--top" data-hint="' + this._lang.panelOptionReset + '"' +
                           '>&nbsp;</span>';
    panelHTML +=    '<span id="' + this._settings.navigationOptionParentElementID + '"' +
                           'class="icon ' + this._lang.panelOptionParentElementIcon + ' hint--primary hint--top" data-hint="' + this._lang.panelOptionParentElement + '"' +
                           '>&nbsp;</span>';
    panelHTML +=    '<span id="' + this._settings.navigationOptionCurrentID + '"' +
                          'class="icon ' + this._lang.panelOptionCurrentIcon + ' ' +
                                 (this.visualDeveloperInstance.ElementPanel
                                     .HasPattern(this.visualDeveloperInstance.GetElementAbsolutePath(this.currentNavigationJQueryDOMElement))
                                  ? this._lang.panelOptionActiveIcon + ' ' : ''
                                 ) +
                                 ' hint--primary hint--top" ' +
                          'data-hint="' + this._lang.panelOptionCurrent + '"' +
                          '>&nbsp;</span>';
    panelHTML +=    '<span id="' + this._settings.navigationOptionGlobalID + '"' +
                          'class="icon ' + this._lang.panelOptionGlobalIcon + ' ' +
                                (this.visualDeveloperInstance.ElementPanel
                                    .HasPattern(this.visualDeveloperInstance.GetElementGenericPath(this.currentNavigationJQueryDOMElement))
                                    ? this._lang.panelOptionActiveIcon + ' ' : ''
                                    ) +
                                ' hint--primary hint--top" ' +
                          'data-hint="' + this._lang.panelOptionGlobal + '"' +
                          '>&nbsp;</span>';
    panelHTML +=    '<span id="' + this._settings.navigationOptionGlobalClassID + '"' +
                          'class="icon ' + this._lang.panelOptionGlobalClassIcon + ' ' +
                                (this.visualDeveloperInstance.ElementPanel
                                    .HasPattern(this.visualDeveloperInstance.GetElementGenericPath(this.currentNavigationJQueryDOMElement, false))
                                    ? this._lang.panelOptionActiveIcon + ' ' : ''
                                ) +
                                ' hint--primary hint--top" ' +
                          'data-hint="' + this._lang.panelOptionGlobalClass + '"' +
                          '>&nbsp;</span>';
    panelHTML +=    '<span id="' + this._settings.navigationOptionAdvancedCreationID + '"' +
                          'class="icon ' + this._lang.panelOptionAdvancedCreationIcon + ' hint--primary hint--top" ' +
                          'data-hint="' + this._lang.panelOptionAdvancedCreation + '"' +
                          '>&nbsp;</span>';
    panelHTML +=    '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=  '</div>';
    panelHTML += '</div>';

    return panelHTML;
  },

  _assignPanelAction : function() {

    var objectInstance = this;

    jQuery(this.currentNavigationPanelOptionParentElement).bind(this._settings.navigationOptionSelectEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      if(objectInstance._lang.userActionNotificationParentElement !== false) {
        objectInstance.visualDeveloperInstance.Panel.SetUserNotification(objectInstance._lang.userActionNotificationParentElement);
      } else {
        objectInstance.visualDeveloperInstance.Panel.SetUserNotification(
            objectInstance.visualDeveloperInstance.GetElementAbsolutePath(
                objectInstance.currentNavigationJQueryDOMElement.parent()
            )
        );
      }

      objectInstance.ActivateNodeInstance(objectInstance.currentNavigationJQueryDOMElement.parent());
    });

    jQuery(this.currentNavigationPanelOptionReset).bind(this._settings.navigationOptionSelectEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(objectInstance._lang.userActionNotificationReset);
      objectInstance.visualDeveloperInstance.Navigation.OpenNavigation();
    });

    jQuery(this.currentNavigationPanelOptionCurrent).bind(this._settings.navigationOptionSelectEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(objectInstance._lang.userActionNotificationCurrent);
      objectInstance._enableElementPanelOnPattern(objectInstance.visualDeveloperInstance.GetElementAbsolutePath(objectInstance.currentNavigationJQueryDOMElement));
    });

    jQuery(this.currentNavigationPanelOptionCurrent).bind(this._settings.navigationOptionIndicatorEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      var currentPattern = objectInstance.visualDeveloperInstance.GetElementAbsolutePath(objectInstance.currentNavigationJQueryDOMElement),
          currentObject  = jQuery(currentPattern);
          currentObject.not(objectInstance.currentNavigationJQueryDOMElement);

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(currentPattern);
      objectInstance._highlightNavigationMirrorJQueryDOMElement(currentObject);
    });

    jQuery(this.currentNavigationPanelOptionCurrent).bind(this._settings.navigationOptionIndicatorCloseEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance._clearCurrentNavigationMirrorJQueryDOMElement();
      objectInstance.visualDeveloperInstance.Panel.SetUserNotification("&nbsp;");
    });

    jQuery(this.currentNavigationPanelOptionGlobal).bind(this._settings.navigationOptionSelectEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(objectInstance._lang.userActionNotificationGlobal);
      objectInstance._enableElementPanelOnPattern(objectInstance.visualDeveloperInstance.GetElementGenericPath(objectInstance.currentNavigationJQueryDOMElement));
    });

    jQuery(this.currentNavigationPanelOptionGlobal).bind(this._settings.navigationOptionIndicatorEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      var currentPattern = objectInstance.visualDeveloperInstance.GetElementGenericPath(objectInstance.currentNavigationJQueryDOMElement),
          currentObject  = jQuery(currentPattern);
          currentObject.not(objectInstance.currentNavigationJQueryDOMElement);

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(currentPattern);
      objectInstance._highlightNavigationMirrorJQueryDOMElement(currentObject);
    });

    jQuery(this.currentNavigationPanelOptionGlobal).bind(this._settings.navigationOptionIndicatorCloseEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance._clearCurrentNavigationMirrorJQueryDOMElement();
      objectInstance.visualDeveloperInstance.Panel.SetUserNotification("&nbsp;");
    });

    jQuery(this.currentNavigationPanelOptionGlobalClass).bind(this._settings.navigationOptionSelectEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(objectInstance._lang.userActionNotificationGlobalClass);
      objectInstance._enableElementPanelOnPattern(objectInstance.visualDeveloperInstance.GetElementGenericPath(objectInstance.currentNavigationJQueryDOMElement, false));
    });

    jQuery(this.currentNavigationPanelOptionGlobalClass).bind(this._settings.navigationOptionIndicatorEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      var currentPattern = objectInstance.visualDeveloperInstance.GetElementGenericPath(objectInstance.currentNavigationJQueryDOMElement, false),
          currentObject  = jQuery(currentPattern);
          currentObject.not(objectInstance.currentNavigationJQueryDOMElement);

      objectInstance.visualDeveloperInstance.Panel.SetUserNotification(currentPattern);
      objectInstance._highlightNavigationMirrorJQueryDOMElement(currentObject);
    });

    jQuery(this.currentNavigationPanelOptionGlobalClass).bind(this._settings.navigationOptionIndicatorCloseEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance._clearCurrentNavigationMirrorJQueryDOMElement();
      objectInstance.visualDeveloperInstance.Panel.SetUserNotification("&nbsp;");
    });

    jQuery(this.currentNavigationPanelOptionAdvancedCreation).bind(this._settings.navigationOptionSelectEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      var cssRule = objectInstance.visualDeveloperInstance.GetElementGenericPath(objectInstance.currentNavigationJQueryDOMElement, false);

      objectInstance._clearCurrentNavigationJQueryDOMElement();
      objectInstance
          .visualDeveloperInstance
          .Utility
          .DomRuleBuilder
          .InitInstance(
              cssRule,
              objectInstance,
              objectInstance._enableElementPanelOnPattern
          );
      objectInstance.visualDeveloperInstance.Panel.SetUserNotification("&nbsp;");
    });

  },

  _enableElementPanelOnPattern : function(elementPanelPattern) {
    if(elementPanelPattern == false) {
      this.visualDeveloperInstance.Panel.SetUserNotification(this._lang.userActionNotificationReset);
      this.visualDeveloperInstance.Navigation.OpenNavigation();

      return;
    }

    this._clearCurrentNavigationJQueryDOMElement();
    this.visualDeveloperInstance.Panel.DisableQuickAccessHighlighting();
    this.visualDeveloperInstance.ElementPanel.InitPatternCustomization(elementPanelPattern);
  },

  _arrangePanel : function() {
    this.currentNavigationPanelObject.css("top", this.currentNavigationJQueryDOMElement.offset().top - this.currentNavigationPanelObject.height() - 5);
    this.currentNavigationPanelObject.css("left", this.currentNavigationJQueryDOMElement.offset().left);
  },

  _clearCurrentNavigationJQueryDOMElement : function() {
    jQuery(window).unbind(this._settings.navigationArrangeEvents);

    if(this.currentNavigationJQueryDOMElement !== false) {
      this.visualDeveloperInstance.Navigation.UnMarkNavigationVisualSelectedElement(this.currentNavigationJQueryDOMElement);

      this.currentNavigationJQueryDOMElement = false;
    }

    this._clearCurrentNavigationMirrorJQueryDOMElement();

    if(this.currentNavigationPanelObject !== false) {
      jQuery(this.currentNavigationPanelObject).find('*').unbind(this._settings.navigationNamespace);

      this.currentNavigationPanelObject.remove();

      this.currentNavigationPanelObject = false;
    }

  },

  _highlightNavigationMirrorJQueryDOMElement : function(mirrorJQueryDOMElement) {
    this._clearCurrentNavigationMirrorJQueryDOMElement();

    this.currentNavigationMirrorJQueryDOMElement = mirrorJQueryDOMElement;

    this.visualDeveloperInstance.Navigation.MarkNavigationVisualSelectedMirrorElement(this.currentNavigationMirrorJQueryDOMElement);
  },

  _clearCurrentNavigationMirrorJQueryDOMElement : function() {
    if(this.currentNavigationMirrorJQueryDOMElement !== false) {
      this.visualDeveloperInstance.Navigation.UnMarkNavigationVisualSelectedMirrorElement(this.currentNavigationMirrorJQueryDOMElement);

      this.currentNavigationMirrorJQueryDOMElement = false;
    }
  },

  CloseNavigationPanel : function() {
    this._clearCurrentNavigationJQueryDOMElement();
  }

};