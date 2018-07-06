VisualDeveloper.PageVersionsPanel = {

  visualDeveloperInstance : {},

  _lang : {
    title                   : "Visual Developer <span>Page Versions</span>",
    addNew                  : 'Save Information',
    addNewVersionName       : 'Page Version Name : ',
    addNewToggleActive      : 'Cancel',
    addNewToggleInactive    : 'Add New Version',
    addNewProcessingText    : 'Please wait...',
    close                   : "Close",
    tableID                 : 'Unique Identifier',
    tableName               : 'Version Name',
    tableVersionLink        : 'Version Link',
    optionCustomizeVersion  : 'Start',
    optionDeleteVersion     : 'Delete'
  },

  _settings : {
    bodyClass                             : 'page-versions-panel-active',
    arrangeEvents                         : 'resize',
    actionEvents                          : 'click',
    settingsActionEvents                  : 'click change',
    formSubmitEvent                       : 'submit',
    panelID                               : 'page-versions-panel',
    panelTopSectionID                     : 'page-versions-panel-top-section',
    panelTopCloseID                       : 'page-versions-panel-top-close',
    panelContainerSectionID               : 'page-versions-panel-container',
    panelContainerAddNewToggleFormID      : 'page-versions-panel-add-new-toggle-form',
    panelContainerAddNewToggleActiveClass : 'page-versions-panel-add-new-toggle-active',
    panelContainerAddNewFormID            : 'page-versions-panel-add-new-form',
    panelContainerProcessingEventClass    : 'page-versions-panel-processing-event',
    panelContainerListSectionID           : 'page-versions-panel-container-list',
    panelContainerListRowVersionIDAttr    : 'page-version-id',
    panelContainerListOptionCustomizeClass: 'page-version-customize',
    panelContainerListOptionDeleteClass   : 'page-version-delete',
    formFieldClass                        : 'page-versions-panel-form-field',
    inputErrorClass                       : 'error'
  },

  currentPanelObject                           : false,
  currentPanelTopSectionObject                 : false,
  currentPanelCloseTriggerObject               : false,
  currentPanelContainerObject                  : false,
  currentPanelContainerAddNewTriggerObject     : false,
  currentPanelContainerAddNewFormObject        : false,
  currentPanelContainerListSectionObject       : false,

  Init : function (visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
    this._initEventListeners();
  },

  _initDependencies : function() {
    this._settings.arrangeEvents = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ';
    this._settings.settingsActionEvents  = this._settings.settingsActionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ';
    this._settings.actionEvents  = this._settings.actionEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ';
    this._settings.formSubmitEvent  = this._settings.formSubmitEvent
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ') +
        '.' + this.visualDeveloperInstance.namespace + '-page-versions-panel ';


    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  _initEventListeners : function() {
    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.PageVersions.pageVersionsEventListUpdate,
        this,
        '_eventPageVersionsUpdateList'
    );
    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.PageVersions.pageVersionsEventAddNew,
        this,
        '_newPageVersionAdded'
    );
  },

  DisplayPanel : function() {
    var objectInstance = this;

    jQuery('body')
        .addClass(this._settings.bodyClass)
        .append(this._getPanelHTML());

    this.currentPanelObject                       = jQuery('#' + this._settings.panelID);
    this.currentPanelTopSectionObject             = jQuery('#' + this._settings.panelTopSectionID);
    this.currentPanelCloseTriggerObject           = jQuery('#' + this._settings.panelTopCloseID);
    this.currentPanelContainerObject              = jQuery('#' + this._settings.panelContainerSectionID);
    this.currentPanelContainerAddNewTriggerObject = jQuery('#' + this._settings.panelContainerAddNewToggleFormID);
    this.currentPanelContainerAddNewFormObject    = jQuery('#' + this._settings.panelContainerAddNewFormID);
    this.currentPanelContainerListSectionObject   = jQuery('#' + this._settings.panelContainerListSectionID);

    this._arrangePanel();
    this._assignPanelActions();
    this._assignPanelListActions();

    this.currentPanelObject.hide().fadeIn("slow");

    jQuery(window).bind(this._settings.arrangeEvents, function(){
      objectInstance._arrangePanel();
    });
  },

  HidePanel : function() {
    if(this.currentPanelObject == false)
      return;

    jQuery('body').removeClass(this._settings.bodyClass);

    jQuery(window).unbind(this._settings.arrangeEvents);
    this.currentPanelObject.find("*").unbind(this.visualDeveloperInstance.namespace + '-page-versions-panel');

    this.currentPanelObject.fadeOut("slow", function(){
      jQuery(this).remove();
    });

    this.currentPanelObject = false;
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
    panelHTML +=    this._getPanelAddNewFormHTML();
    panelHTML +=    '<table id="' + this._settings.panelContainerListSectionID + '">';
    panelHTML +=      '<thead>';
    panelHTML +=        '<tr>';
    panelHTML +=          '<th>' + this._lang.tableName + '</th>';
    panelHTML +=          '<th>' + this._lang.tableVersionLink + '</th>';
    panelHTML +=          '<th></th>';
    panelHTML +=        '</tr>';
    panelHTML +=      '</thead>';
    panelHTML +=      '<tbody>';
    panelHTML +=        this._getPanelListEntriesHTML();
    panelHTML +=      '</tbody>';
    panelHTML +=    '</table>';
    panelHTML +=  '</div>';
    panelHTML += '</div>';

    return panelHTML;
  },

  _getPanelAddNewFormHTML : function() {
    var panelFormHTML = '';

    panelFormHTML += '<span id="' + this._settings.panelContainerAddNewToggleFormID+ '" ';
    panelFormHTML += '>' + this._lang.addNewToggleInactive + '</span>';
    panelFormHTML += '<form id="' + this._settings.panelContainerAddNewFormID + '">';
    panelFormHTML +=    '<label>' + this._lang.addNewVersionName + '</label>';
    panelFormHTML +=    '<input type="text"   name="name"   value="" class="' + this._settings.formFieldClass + '"/>';
    panelFormHTML +=    '<input type="submit" name="submit" value="' + this._lang.addNew + '"/>';
    panelFormHTML +=    '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';
    panelFormHTML += '</form>';
    panelFormHTML += '<span class="' + this.visualDeveloperInstance._settings.clearClass + '"></span>';

    return panelFormHTML;
  },

  _getPanelListEntriesHTML : function() {
    var objectInstance  = this,
        listEntriesHTML = '';

    jQuery.each(this.visualDeveloperInstance.PageVersions.entries, function(key, information) {
      if(typeof information != "undefined") {
        var versionLink = (typeof PluginInfo.current_page_url != "undefined" ?
                            (
                              PluginInfo.current_page_url + (PluginInfo.current_page_url.indexOf('?') === -1 ? '?' : '&')
                                + 'vdv=' + information.id
                            ) : 'Could not determine'
                          );

        listEntriesHTML += '<tr ' + objectInstance._settings.panelContainerListRowVersionIDAttr + '="' + information.id + '">';
        listEntriesHTML +=    '<td>' + information.name + '</td>';
        listEntriesHTML +=    '<td>' + versionLink + '</td>';
        listEntriesHTML +=    '<td>';
        listEntriesHTML +=      '<span class="' + objectInstance._settings.panelContainerListOptionCustomizeClass + '">';
        listEntriesHTML +=        objectInstance._lang.optionCustomizeVersion;
        listEntriesHTML +=      '</span>';
        listEntriesHTML +=      '<span class="' + objectInstance._settings.panelContainerListOptionDeleteClass + '">';
        listEntriesHTML +=        objectInstance._lang.optionDeleteVersion;
        listEntriesHTML +=      '</span>';
        listEntriesHTML +=    '</td>';
        listEntriesHTML += '</tr>';
      }
    });

    return listEntriesHTML;
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

    this.currentPanelContainerAddNewTriggerObject
        .unbind(this._settings.actionEvents)
        .bind(this._settings.actionEvents, function(event){
          event.preventDefault();
          event.stopImmediatePropagation();

          objectInstance._toggleAddNewFormHandler();
        });

    this.currentPanelContainerAddNewFormObject
        .unbind(this._settings.formSubmitEvent)
        .bind(this._settings.formSubmitEvent, function(event){
          event.preventDefault();
          event.stopImmediatePropagation();

          jQuery(this).find('.' + objectInstance._settings.formFieldClass).each(function(){
            if(jQuery.trim(jQuery(this).val()) == '')
              jQuery(this).addClass(objectInstance._settings.inputErrorClass);
            else
              jQuery(this).removeClass(objectInstance._settings.inputErrorClass);
          });

          if(jQuery(this).find('.' + objectInstance._settings.formFieldClass + '.' + objectInstance._settings.inputErrorClass).length > 0)
            return;

          jQuery(this).find('.' + objectInstance._settings.formFieldClass)
                      .removeClass(objectInstance._settings.inputErrorClass);

          if(jQuery(this).hasClass(objectInstance._settings.panelContainerProcessingEventClass))
            return false;

          jQuery(this).addClass(objectInstance._settings.panelContainerProcessingEventClass);
          jQuery(this).find('input').attr("disabled", "disabled");
          jQuery(this).find('input[type="submit"]').val(objectInstance._lang.addNewProcessingText);

          var versionInformation = {};

          jQuery(this).find('.' + objectInstance._settings.formFieldClass).each(function(){
            versionInformation[jQuery(this).attr("name")] = jQuery(this).val();
          });

          objectInstance.visualDeveloperInstance.PageVersions.AddNewVersion(versionInformation);
        });
  },

  _assignPanelListActions : function() {
    if(this.currentPanelContainerListSectionObject.find("> tbody > tr").length > 0) {
      var objectInstance = this;

      this.currentPanelContainerListSectionObject.fadeIn("slow");

      this.currentPanelContainerListSectionObject
          .find('.' + this._settings.panelContainerListOptionCustomizeClass)
          .unbind(this._settings.actionEvents)
          .bind(this._settings.actionEvents, function(event){
            event.preventDefault();
            event.stopImmediatePropagation();

            var versionID = jQuery(this).parents('tr:first').attr(objectInstance._settings.panelContainerListRowVersionIDAttr);

            objectInstance.visualDeveloperInstance.PageVersions.SwitchToPageVersion(parseInt(versionID));
          });

      this.currentPanelContainerListSectionObject
          .find('.' + this._settings.panelContainerListOptionDeleteClass)
          .unbind(this._settings.actionEvents)
          .bind(this._settings.actionEvents, function(event){
            event.preventDefault();
            event.stopImmediatePropagation();

            var versionID = jQuery(this).parents('tr:first').attr(objectInstance._settings.panelContainerListRowVersionIDAttr);

            objectInstance.visualDeveloperInstance.PageVersions.DeleteVersion(parseInt(versionID));
          });
    } else {
      this.currentPanelContainerListSectionObject.fadeOut("slow");
    }
  },

  _refreshPanelList : function() {
    this.currentPanelContainerListSectionObject.find("> tbody").html(this._getPanelListEntriesHTML());
    this._assignPanelListActions();
  },

  _toggleAddNewFormHandler : function() {
    var toggleFormButton = this.currentPanelContainerAddNewTriggerObject;

    toggleFormButton.toggleClass(this._settings.panelContainerAddNewToggleActiveClass);

    if(toggleFormButton.hasClass(this._settings.panelContainerAddNewToggleActiveClass)) {
      this.currentPanelContainerAddNewFormObject.fadeIn("slow");
      toggleFormButton.html(this._lang.addNewToggleActive);
    } else {
      this.currentPanelContainerAddNewFormObject.fadeOut("slow");
      toggleFormButton.html(this._lang.addNewToggleInactive);
    }

    if(this.currentPanelContainerAddNewFormObject.hasClass(this._settings.panelContainerProcessingEventClass)) {
      this.currentPanelContainerAddNewFormObject
          .removeClass(this._settings.panelContainerProcessingEventClass);
      this.currentPanelContainerAddNewFormObject
          .find('input')
          .removeAttr("disabled");
      this.currentPanelContainerAddNewFormObject
          .find("." + this._settings.formFieldClass)
          .val("");
      this.currentPanelContainerAddNewFormObject
          .find('input[type="submit"]')
          .val(this._lang.addNew);
    }
  },

  _eventPageVersionsUpdateList : function() {
    this._refreshPanelList();
  },

  _newPageVersionAdded : function() {
    if(this.currentPanelObject == false)
      return;

    if(this.currentPanelContainerAddNewFormObject.is(":visible"))
      this._toggleAddNewFormHandler();
  }

};