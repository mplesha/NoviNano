VisualDeveloper.ProgressPanel = {

  visualDeveloperInstance : {},

  _lang : {
    title                             : "Visual Developer <span>Progress Tracker</span>",
    close                             : "Close",
    containerOverlayText              : "Start Customizing",
    containerOverlayElementNotPresent : "This element is not present on this page"
  },

  _settings : {
    bodyClass                  : 'progress-panel-active',
    arrangeEvents              : 'resize',
    actionEvents               : 'click',
    progressActionEvents       : 'click change',
    fileActionEvents           : 'change',
    panelID                    : 'progress-panel',
    panelTopSectionID          : 'progress-panel-top-section',
    panelTopCloseID            : 'progress-panel-top-close',
    panelContainerSectionID    : 'progress-panel-container',
    panelContainerPatternRowClass             : 'progress-panel-pattern-row',
    panelContainerPatternRowRuleAttr          : 'progress-panel-pattern-row-rule',
    panelContainerPatternContainerClass       : 'progress-panel-pattern-container',
    panelContainerPatternContainerRuleClass        : 'progress-panel-pattern-container-rule',
    panelContainerPatternContainerCodeClass        : 'progress-panel-pattern-container-code',
    panelContainerPatternRowOverlayClass           : 'progress-panel-pattern-row-overlay',
    panelContainerPatternRowOverlayPersistentClass : 'progress-panel-pattern-row-overlay-persistent'
  },

  currentPanelObject                           : false,
  currentPanelTopSectionObject                 : false,
  currentPanelCloseTriggerObject               : false,
  currentPanelContainerObject                  : false,
  currentPanelContainerPatternRowObject        : false,
  currentPanelContainerLineListObject          : false,

  panelContainerRuleListFontSize : 14,
  panelContainerRuleListHeight   : 22,

  Init : function (visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.arrangeEvents = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-progress-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-progress-panel ';
    this._settings.progressActionEvents  = this._settings.progressActionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-progress-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-progress-panel ';
    this._settings.actionEvents  = this._settings.actionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-progress-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-progress-panel ';
    this._settings.fileActionEvents  = this._settings.fileActionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-progress-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-progress-panel ';

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

    this.currentPanelObject                           = jQuery('#' + this._settings.panelID);
    this.currentPanelTopSectionObject                 = jQuery('#' + this._settings.panelTopSectionID);
    this.currentPanelCloseTriggerObject               = jQuery('#' + this._settings.panelTopCloseID);
    this.currentPanelContainerObject                  = jQuery('#' + this._settings.panelContainerSectionID);
    this.currentPanelContainerPatternRowObject        = this.currentPanelContainerObject
                                                            .find("." + this._settings.panelContainerPatternRowClass);
    this.currentPanelContainerLineListObject          = this.currentPanelContainerPatternRowObject
                                                            .find("p");

    this._arrangePanel();
    this._assignPanelActions();

    this.currentPanelObject.hide().fadeIn("slow");

    jQuery(window).bind(this._settings.arrangeEvents, function(){
      objectInstance._arrangePanel();
    });
  },

  HidePanel : function() {
    jQuery('body').removeClass(this._settings.bodyClass);

    jQuery(window).unbind(this._settings.arrangeEvents);
    this.currentPanelObject.find("*").unbind(this.visualDeveloperInstance.namespace + '-progress-panel');

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
    panelHTML +=     this._getPanelPatternsHTML();
    panelHTML +=  '</div>';
    panelHTML += '</div>';

    return panelHTML;
  },

  _getPanelPatternsHTML : function() {
    var objectInstance    = this,
        panelPatternsHTML = '';

    jQuery.each(this.visualDeveloperInstance.ElementPanel.elementOptionsObjectList, function(elementOptionsObjectIndex, elementOptionsObject) {
      var elementPatternCode   = '',
          elementPresentOnPage = jQuery(elementOptionsObject._elementPattern).length > 0;

      jQuery.each(elementOptionsObject.GetCurrentActiveOptionsMap(), function(optionIndex, cssValue) {
        elementPatternCode += "<p>&nbsp;&nbsp;&nbsp;&nbsp;" +
            elementOptionsObject._getStylesheetCSSRuleByOptionIndexAndCSSValue(
            optionIndex, cssValue
        ) + "</p>";
      });

      panelPatternsHTML += '<div ' +
                                 objectInstance._settings.panelContainerPatternRowRuleAttr + '="' + elementOptionsObject._elementPattern + '" ' +
                                 'class="' + objectInstance._settings.panelContainerPatternRowClass + '">' +
                             '<div class="' + objectInstance._settings.panelContainerPatternContainerClass + '">' +
                                '<p class="' + objectInstance._settings.panelContainerPatternContainerRuleClass + '">' +
                                  elementOptionsObject._elementPattern +
                                '</p>' +
                                '<div class="' + objectInstance._settings.panelContainerPatternContainerCodeClass + '">' +
                                  "<p>{</p>" +
                                  elementPatternCode +
                                  "<p>}</p>" +
                                '</div>' +
                             '</div>' +
                             '<div class="' + objectInstance._settings.panelContainerPatternRowOverlayClass + ' ' +
                                              (elementPresentOnPage == 0 ?
                                                  objectInstance._settings.panelContainerPatternRowOverlayPersistentClass :
                                                  ''
                                              ) +
                              '">' +
                                '<p>' +
                                  (elementPresentOnPage == 0 ?
                                      objectInstance._lang.containerOverlayElementNotPresent :
                                      objectInstance._lang.containerOverlayText
                                  ) +
                                '</p>' +
                             '</div>' +
                           '</div>';
    });

    return panelPatternsHTML;
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

    this._arrangePanelRowText();
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

    this.currentPanelContainerPatternRowObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event) {
          event.preventDefault();
          event.stopImmediatePropagation();

          if(jQuery(jQuery(this).attr(objectInstance._settings.panelContainerPatternRowRuleAttr)).length == 0)
            return;

          objectInstance.visualDeveloperInstance.Panel.currentPanelEnableTriggerObject.trigger("click");
          objectInstance.visualDeveloperInstance.Navigation.CloseNavigation();
          
          objectInstance.visualDeveloperInstance.NavigationPanel._enableElementPanelOnPattern(
              jQuery(this).attr(objectInstance._settings.panelContainerPatternRowRuleAttr)
          );

          objectInstance.HidePanel();
        });
  },

  _arrangePanelRowText : function() {
    var objectInstance = this;

    this.currentPanelContainerLineListObject.each(function(){
      jQuery(this).css("font-size", objectInstance.panelContainerRuleListFontSize + "px");

      var fontSize = objectInstance.panelContainerRuleListFontSize;

      while(parseInt(jQuery(this).height()) > objectInstance.panelContainerRuleListHeight
          && fontSize > 1) {
        fontSize--;

        jQuery(this).css("font-size", fontSize + "px");
      }
    });


  }

};