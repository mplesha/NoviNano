VisualDeveloper.Panel = {

  visualDeveloperInstance : {},

  _lang : {
    title                       : "Visual Developer",
    enableButton                : "Enable Selection",
    disableButton               : "Close Selection",
    progressButton              : "Progress",
    pageSpecificButton          : "Page Specific",
    versionsButton              : "Versions",
    settingsButton              : "Preferences",
    saveButton                  : "Save Changes",
    defaultNotification         : "Hello ! Your First Step is pressing the Open button.",
    userActionNotificationClose : "Navigation has been closed.",
    userActionNotificationOpen  : "Click on the element you want to start customizing",
    quickAccessSectionTitle     : "Quick Access"
  },

  _settings : {
    arrangeEvents                          : 'scroll resize',
    actionEvents                           : 'click',
    indicatorEvent                         : 'mouseenter',
    indicatorCloseEvent                    : 'mouseleave',
    panelID                                : 'panel',
    panelContainerID                       : 'panel-container',
    navigationControlsID                   : 'operations-navigation-panel',
    navigationTopControlsID                : 'top-operations-navigation-panel',
    navigationTopSecondaryControlsID       : 'top-operations-secondary-navigation-panel',
    navigationEnableID                     : 'enable-navigation-panel',
    navigationDisableID                    : 'disable-navigation-panel',
    navigationProgressID                   : 'progress-navigation-panel',
    navigationPageSpecificID               : 'page-specific-navigation-panel',
    navigationPageVersionsID               : 'page-versions-navigation-panel',
    navigationPageVersionNameID            : 'page-version-name-navigation-panel',
    navigationPageSpecificBlockedClass     : 'blocked',
    navigationPageSpecificInactiveClass    : 'inactive',
    navigationPageSpecificActiveClass      : 'active',
    navigationPageVersionsBlockedClass     : 'blocked',
    navigationSettingsID                   : 'settings-navigation-panel',
    navigationSaveID                       : 'save-navigation-panel',
    userNotificationID                     : 'user-top-notification',
    quickAccessContainerID                 : 'quick-access-container',
    quickAccessSelectionsContainerID       : 'quick-access-selections-container',
    quickAccessGroupContainerClass         : 'quick-access-group-container',
    quickAccessGroupElementsContainerClass : 'quick-access-group-elements-container',
    quickAccessGroupElementTargetAttr      : 'quick-access-target',
    quickAccessGroupElementClass           : 'quick-access-group-element',
    quickAccessHighlightSelectionClass     : 'quick-access-highlight-selection',
    quickAccessIndicatorElementAttr        : 'quick-access-element',
    quickAccessIndicatorEvent              : 'mouseenter',
    quickAccessIndicatorCloseEvent         : 'mouseleave',
    quickAccessIndicatorSelectionEvent     : 'click'
  },

  _userNotificationLOG      : [],
  _userNotificationHeight   : 22,
  _userNotificationFontSize : 14,

  eventPanelRefresh    : 'panel_refresh',

  currentPanelObject                    : false,
  currentPanelTopOperationsSecondary    : false,
  currentPanelEnableTriggerObject       : false,
  currentPanelDisableTriggerObject      : false,
  currentPanelProgressTriggerObject     : false,
  currentPanelPageSpecificTriggerObject : false,
  currentPanelPageVersionsTriggerObject : false,
  currentPanelPageVersionNameObject     : false,
  currentPanelSettingsTriggerObject     : false,
  currentPanelSaveTriggerObject         : false,
  currentPanelUserNotificationObject    : false,
  currentPanelQuickAccessContainerObject: false,
  currentPanelQuickAccessSelectionsContainerObject : false,

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();

    this._registerFilterAndEvents();

    this.displayPanel();
  },

  _initDependencies : function() {
    this._settings.arrangeEvents = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + ' ') +
        '.' + this.visualDeveloperInstance.namespace + ' ';
    this._settings.actionEvents  = this._settings.actionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + ' ') +
        '.' + this.visualDeveloperInstance.namespace + ' ';

    this._settings.quickAccessIndicatorEvent  = this._settings.quickAccessIndicatorEvent
            .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '_quick_access ') +
            '.' + this.visualDeveloperInstance.namespace + '_quick_access ';
    this._settings.quickAccessIndicatorCloseEvent  = this._settings.quickAccessIndicatorCloseEvent
            .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '_quick_access ') +
            '.' + this.visualDeveloperInstance.namespace + '_quick_access ';
    this._settings.quickAccessIndicatorSelectionEvent  = this._settings.quickAccessIndicatorSelectionEvent
            .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '_quick_access ') +
            '.' + this.visualDeveloperInstance.namespace + '_quick_access ';


    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  _registerFilterAndEvents : function() {
    this.visualDeveloperInstance.EventManager.registerEvent(this.eventPanelRefresh);
    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.universalEventSettingsUpdate,
        this,
        'HandleSettingsOptions'
    );
    this.visualDeveloperInstance.EventManager.listenEvent(
        [
          this.visualDeveloperInstance.ElementPanel.eventElementPanelDisplay,
          this.visualDeveloperInstance.SyntaxSelectionPanel.eventDisplay
        ],
        this,
        'HideQuickAccessPanel'
    );
    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.ElementPanel.eventElementPanelClose,
        this,
        'ShowQuickAccessPanel'
    );
  },

  displayPanel : function() {
    var objectInstance = this;

    jQuery('body').append(this._getPanelHTML());

    this.currentPanelObject                     = jQuery('#' + this._settings.panelID);
    this.currentPanelContainerObject            = jQuery('#' + this._settings.panelContainerID);
    this.currentPanelTopOperationsSecondary     = jQuery('#' + this._settings.navigationTopSecondaryControlsID);
    this.currentPanelEnableTriggerObject        = jQuery('#' + this._settings.navigationEnableID);
    this.currentPanelDisableTriggerObject       = jQuery('#' + this._settings.navigationDisableID);
    this.currentPanelSaveTriggerObject          = jQuery('#' + this._settings.navigationSaveID);
    this.currentPanelProgressTriggerObject      = jQuery('#' + this._settings.navigationProgressID);
    this.currentPanelPageSpecificTriggerObject  = jQuery('#' + this._settings.navigationPageSpecificID);
    this.currentPanelPageVersionsTriggerObject  = jQuery('#' + this._settings.navigationPageVersionsID);
    this.currentPanelPageVersionNameObject      = jQuery('#' + this._settings.navigationPageVersionNameID);
    this.currentPanelSettingsTriggerObject      = jQuery('#' + this._settings.navigationSettingsID);
    this.currentPanelUserNotificationObject     = jQuery('#' + this._settings.userNotificationID);
    this.currentPanelQuickAccessContainerObject = jQuery('#' + this._settings.quickAccessContainerID);
    this.currentPanelQuickAccessSelectionsContainerObject = jQuery('#' + this._settings.quickAccessSelectionsContainerID);

    this._arrangePanel();
    this._assignPanelActions();
    this._setupQuickAccessHighlighting();
    this.EnableQuickAccessHighlighting();

    jQuery(window).bind(this._settings.arrangeEvents, function(){
      objectInstance._arrangePanel();
    });
  },

  _getPanelHTML : function() {
    var panelHTML = '';

    panelHTML += '<p id="' + this._settings.userNotificationID + '">' + this._lang.defaultNotification + '</p>';
    panelHTML += '<div id="' + this._settings.panelID + '">';
    panelHTML +=  '<div id="' + this._settings.panelContainerID + '">';
    panelHTML +=    '<h2>' + this._lang.title + '</h2>';
    panelHTML +=    '<div id="' + this._settings.navigationTopControlsID + '">';
    panelHTML +=      '<span id="' + this._settings.navigationSettingsID + '">' + this._lang.settingsButton + '</span>';
    panelHTML +=      '<span id="' + this._settings.navigationProgressID + '">' + this._lang.progressButton + '</span>';
    panelHTML +=      '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=    '</div>';
    panelHTML +=    '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=    '<div id="' + this._settings.navigationTopSecondaryControlsID + '">';
    panelHTML +=      '<span id="' + this._settings.navigationPageSpecificID + '">' + this._lang.pageSpecificButton + '</span>';
    panelHTML +=      '<span id="' + this._settings.navigationPageVersionNameID + '"></span>';
    panelHTML +=      '<span id="' + this._settings.navigationPageVersionsID + '">' + this._lang.versionsButton + '</span>';
    panelHTML +=      '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=    '</div>';
    panelHTML +=    '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=    '<div id="' + this._settings.navigationControlsID + '">';
    panelHTML +=      '<span id="' + this._settings.navigationEnableID + '">' + this._lang.enableButton + '</span>';
    panelHTML +=      '<span id="' + this._settings.navigationDisableID + '">' + this._lang.disableButton + '</span>';
    panelHTML +=      '<span id="' + this._settings.navigationSaveID + '">' + this._lang.saveButton + '</span>';
    panelHTML +=    '</div>';
    panelHTML +=    '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelHTML +=  '</div>';
    panelHTML +=  '<div id="' + this._settings.quickAccessContainerID + '">';
    panelHTML +=      '<h2>' + this._lang.quickAccessSectionTitle + '</h2>';
    panelHTML +=      '<div id="' + this._settings.quickAccessSelectionsContainerID + '">';
    panelHTML +=        this.GetQuickAccessContentHTML();
    panelHTML +=      '</div>';
    panelHTML +=  '</div>';
    panelHTML += '</div>';

    return panelHTML;
  },

  _arrangePanel : function() {
    this.currentPanelUserNotificationObject.css(
        "top",
        this.visualDeveloperInstance.toolbarObject.length > 0 ?
            this.visualDeveloperInstance.toolbarObject.height() : 0
    );

    var maxIndicator = jQuery(window).height() > jQuery('body').height() ? jQuery(window).height() : jQuery('body').height();

    this.currentPanelObject.css(
        "top",
        this.currentPanelUserNotificationObject.innerHeight() + (
            this.visualDeveloperInstance.toolbarObject.length > 0 ?
                this.visualDeveloperInstance.toolbarObject.height() : 0
        )
    ).css( "height", maxIndicator );

    var topDistance  = this.currentPanelContainerObject.height() +
        this.currentPanelUserNotificationObject.innerHeight() +
        this.currentPanelQuickAccessContainerObject.find("> h2").innerHeight() +
        (this.visualDeveloperInstance.toolbarObject.length > 0 ? this.visualDeveloperInstance.toolbarObject.height() : 0);

    this.currentPanelQuickAccessSelectionsContainerObject.height("auto");

    if(this.currentPanelQuickAccessSelectionsContainerObject.height() > jQuery(window).height() - topDistance)
      this.currentPanelQuickAccessSelectionsContainerObject.css("overflow-y", "scroll");
    else
      this.currentPanelQuickAccessSelectionsContainerObject.css("overflow-y", "hidden");

    this.currentPanelQuickAccessSelectionsContainerObject.height(jQuery(window).height() - topDistance);
  },

  _assignPanelActions : function() {
    var objectInstance = this;

    jQuery(this.currentPanelEnableTriggerObject).bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.currentPanelEnableTriggerObject.fadeOut(1000, function(){
        objectInstance.currentPanelDisableTriggerObject.fadeIn();
      });

      objectInstance.SetUserNotification(objectInstance._lang.userActionNotificationOpen);

      objectInstance.DisableQuickAccessHighlighting();
      objectInstance.visualDeveloperInstance.Navigation.OpenNavigation();
    });

    jQuery(this.currentPanelDisableTriggerObject).bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.currentPanelDisableTriggerObject.fadeOut(1000, function(){
        objectInstance.currentPanelEnableTriggerObject.fadeIn();
      });

      objectInstance.EnableQuickAccessHighlighting();
      objectInstance.visualDeveloperInstance.Navigation.CloseNavigation();
      objectInstance.visualDeveloperInstance.ElementPanel.Close();
      objectInstance.SetUserNotification(objectInstance._lang.userActionNotificationClose);
    });

    jQuery(this.currentPanelProgressTriggerObject).bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.ProgressPanel.DisplayPanel();
    });

    jQuery(this.currentPanelSettingsTriggerObject).bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.SettingsPanel.DisplayPanel();
    });

    jQuery(this.currentPanelPageVersionsTriggerObject).bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.PageVersionsPanel.DisplayPanel();
    });

    jQuery(this.currentPanelSaveTriggerObject).bind(this._settings.actionEvents, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.visualDeveloperInstance.ApplicationSynchronize.SyncLayoutWithApplication();
    });

    jQuery(this.currentPanelQuickAccessContainerObject)
        .find('[' + this._settings.quickAccessGroupElementTargetAttr + ']')
        .bind(this._settings.indicatorEvent, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          jQuery(jQuery(this).attr(objectInstance._settings.quickAccessGroupElementTargetAttr))
              .addClass(objectInstance._settings.quickAccessHighlightSelectionClass);
        }).bind(this._settings.indicatorCloseEvent, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          jQuery(jQuery(this).attr(objectInstance._settings.quickAccessGroupElementTargetAttr))
              .removeClass(objectInstance._settings.quickAccessHighlightSelectionClass);
        }).bind(this._settings.actionEvents, function(event){
          event.preventDefault();
          event.stopImmediatePropagation();

          objectInstance.visualDeveloperInstance.Panel.currentPanelEnableTriggerObject.trigger("click");
          objectInstance.visualDeveloperInstance.Navigation.CloseNavigation();

          objectInstance.visualDeveloperInstance.NavigationPanel._enableElementPanelOnPattern(
              jQuery(this).attr(objectInstance._settings.quickAccessGroupElementTargetAttr)
          );
        });


    var allowPageSpecific = false;

    if(typeof PluginInfo !== "undefined")
      if(PluginInfo.post_id != 0)
        allowPageSpecific = true;

    if (allowPageSpecific) {
      this.currentPanelPageSpecificTriggerObject.addClass(this._settings.navigationPageSpecificInactiveClass);
      jQuery(this.currentPanelPageSpecificTriggerObject).bind(this._settings.actionEvents, function(event){
        event.preventDefault();
        event.stopImmediatePropagation();

        if(jQuery(this).hasClass(objectInstance._settings.navigationPageSpecificInactiveClass)) {
          objectInstance._pageSpecificEventActivate();
        } else {
          objectInstance._pageSpecificEventDeActivate();
        }
      });
    } else {
      this.currentPanelPageSpecificTriggerObject.addClass(this._settings.navigationPageSpecificBlockedClass);
      this.currentPanelPageVersionsTriggerObject.addClass(this._settings.navigationPageVersionsBlockedClass);
    }
  },

  _pageSpecificEventActivate : function() {
    this.currentPanelPageSpecificTriggerObject.removeClass(
      this._settings.navigationPageSpecificInactiveClass
    ).addClass(
      this._settings.navigationPageSpecificActiveClass
    );

    this.visualDeveloperInstance.ApplicationSynchronize.SetPostSpecific(PluginInfo.post_id);
  },

  _pageSpecificEventDeActivate : function() {
    this.currentPanelPageSpecificTriggerObject.removeClass(
      this._settings.navigationPageSpecificActiveClass
    ).addClass(
      this._settings.navigationPageSpecificInactiveClass
    );

    this.visualDeveloperInstance.ApplicationSynchronize.SetNoSpecific();
  },

  SetUserNotification : function(notification) {
    this._userNotificationLOG[this._userNotificationLOG.length - 1] = notification;

    this.currentPanelUserNotificationObject
        .css("font-size", this._userNotificationFontSize + "px")
        .html(notification);

    var fontSize = this._userNotificationFontSize;

    while(parseInt(this.currentPanelUserNotificationObject.height()) > this._userNotificationHeight
            && fontSize > 1) {
      fontSize -= 0.5;

      this.currentPanelUserNotificationObject.css("font-size", fontSize + "px");
    }
  },

  /**
   * @returns {string}
   * @constructor
   */
  GetQuickAccessContentHTML : function() {
    var objectInstance = this,
        groupsMap      = this._getQuickAccessGroupsMap(true),
        content        = '';

    jQuery.each(groupsMap, function(groupName, groupInformation) {
      content += '<div class="' + objectInstance._settings.quickAccessGroupContainerClass + '">';
      content +=    '<h3>' + groupName + '</h3>';
      content +=    '<ul class="' + objectInstance._settings.quickAccessGroupElementsContainerClass + '">';

      jQuery.each(groupInformation, function(elementOrder, elementIndex) {
        var currentOptionInformation = objectInstance.visualDeveloperInstance.QuickAccessOptions[elementIndex];

        content +=  '<li class="' + objectInstance._settings.quickAccessGroupElementClass + '" ';
        content +=    ' ' + objectInstance._settings.quickAccessGroupElementTargetAttr + '="' + currentOptionInformation.target + '">';
        content +=    currentOptionInformation.name;
        content +=  '</li>';
      });

      content +=    '</ul>';
      content += '</div>';
    });

    return content;
  },

  _getQuickAccessGroupsMap : function(presentOnPageOnly) {
    presentOnPageOnly = typeof presentOnPageOnly === "undefined" ? false : presentOnPageOnly;
    var objectInstance = this,
        groupMap       = {};

    jQuery.each(this.visualDeveloperInstance.QuickAccessOptions, function(optionIndex, optionInformation) {
      if(presentOnPageOnly)
        if(jQuery(optionInformation.target).length == 0)
          return 'skip-iteration';

      if(typeof groupMap[optionInformation.group] === "undefined")
        groupMap[optionInformation.group] = {};

      var optimalIndex = optionInformation.weight;

      while(typeof groupMap[optionInformation.group][optimalIndex] !== "undefined")
        optimalIndex++;

      groupMap[optionInformation.group][optimalIndex] = optionIndex;
    });

    return groupMap;
  },

  HandleSettingsOptions : function() {
    if(this.currentPanelTopOperationsSecondary == false)
      return;

    var objectInstance    = this,
        allowPageSpecific = false;

    if(typeof PluginInfo !== "undefined")
      if(PluginInfo.post_id != 0)
        allowPageSpecific = true;

    if(this.visualDeveloperInstance.PageVersions.versionID != 0) {
      this.currentPanelPageSpecificTriggerObject.addClass(this._settings.navigationPageSpecificBlockedClass);
      this.currentPanelPageVersionNameObject
          .html(this.visualDeveloperInstance.PageVersions.entries[this.visualDeveloperInstance.PageVersions.versionID].name)
          .slideDown("slow");
    } else {
      if(allowPageSpecific == true)
        this.currentPanelPageSpecificTriggerObject.removeClass(this._settings.navigationPageSpecificBlockedClass);
      this.currentPanelPageVersionNameObject.hide();
    }

    if(this.visualDeveloperInstance.hasSettingEnableAdvancedFeatures) {
      this.currentPanelTopOperationsSecondary.slideDown(function(){
        objectInstance.visualDeveloperInstance
                      .EventManager
                      .triggerEvent(objectInstance.eventPanelRefresh);
      });
    } else {
      this.currentPanelTopOperationsSecondary.slideUp(function(){
        objectInstance.visualDeveloperInstance
                      .EventManager
                      .triggerEvent(objectInstance.eventPanelRefresh);
      });
    }
  },

  HideQuickAccessPanel : function() {
    this.currentPanelQuickAccessContainerObject.hide("slow");
  },

  ShowQuickAccessPanel : function() {
    this.currentPanelQuickAccessContainerObject.show("slow");
  },

  _setupQuickAccessHighlighting : function() {
    var objectInstance = this;

    jQuery.each(this._getQuickAccessGroupsMap( true ), function(groupIndex, groupElements){
      jQuery.each(groupElements, function(optionIndex, optionKey) {
        objectInstance._getQuickAccessTarget(objectInstance.visualDeveloperInstance.QuickAccessOptions[optionKey].target)
            .attr(objectInstance._settings.quickAccessIndicatorElementAttr, optionKey);
      });
    });
  },

  EnableQuickAccessHighlighting : function() {
    var objectInstance = this,
        targetObject   = jQuery('body > *:not([id^="visual-developer"])');

    targetObject.find('[' + objectInstance._settings.quickAccessIndicatorElementAttr + ']')
        .bind(this._settings.quickAccessIndicatorEvent, function(event){
      event.stopImmediatePropagation();
      event.preventDefault();

      objectInstance._getQuickAccessTarget(objectInstance.visualDeveloperInstance.QuickAccessOptions[jQuery(this).attr(objectInstance._settings.quickAccessIndicatorElementAttr)].target)
                    .addClass(objectInstance._settings.quickAccessHighlightSelectionClass);

    }).bind(this._settings.quickAccessIndicatorCloseEvent, function(event){
      event.stopImmediatePropagation();
      event.preventDefault();

      objectInstance._getQuickAccessTarget(objectInstance.visualDeveloperInstance.QuickAccessOptions[jQuery(this).attr(objectInstance._settings.quickAccessIndicatorElementAttr)].target)
                    .removeClass(objectInstance._settings.quickAccessHighlightSelectionClass);
    }).bind(this._settings.quickAccessIndicatorSelectionEvent, function(event){
      event.preventDefault();
      event.stopImmediatePropagation();

      objectInstance.DisableQuickAccessHighlighting();
      objectInstance.visualDeveloperInstance.Panel.currentPanelEnableTriggerObject.trigger("click");
      objectInstance.visualDeveloperInstance.Navigation.CloseNavigation();

      var selector = objectInstance.visualDeveloperInstance.QuickAccessOptions[jQuery(this).attr(objectInstance._settings.quickAccessIndicatorElementAttr)].target

      objectInstance.visualDeveloperInstance.SyntaxSelectionPanel.Select( selector );
    });
  },

  DisableQuickAccessHighlighting : function() {
    jQuery('body > *:not([id^="visual-developer"])')
        .find('[' + this._settings.quickAccessIndicatorElementAttr + ']')
        .removeClass(this._settings.quickAccessHighlightSelectionClass)
        .unbind(this._settings.quickAccessIndicatorEvent)
        .unbind(this._settings.quickAccessIndicatorCloseEvent)
        .unbind(this._settings.quickAccessIndicatorSelectionEvent);
  },

  _getQuickAccessTarget : function( target ) {
    if( target.indexOf("body") !== 0 )
      return jQuery('body *:not([id^="visual-developer"])').find(target);

    return jQuery(target);
  }

};