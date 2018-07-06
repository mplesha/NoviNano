VisualDeveloper.PageVersions = {

  pageVersionsInformation : {},
  visualDeveloperInstance : {},

  _settings : {
    ajaxGetPageVersionsAction   : 'visual_developer_getPageVersions',
    ajaxAddPageVersionAction    : 'visual_developer_addPageVersion',
    ajaxDeletePageVersionAction : 'visual_developer_deletePageVersion'
  },

  versionID : 0,
  entries   : {},

  pageVersionsEventListUpdate  : 'page_versions_list_update',
  pageVersionsEventAddNew      : 'page_versions_add_new',

  Init : function (visualDeveloperInstance) {
    this.entries                 = {};
    this.visualDeveloperInstance = visualDeveloperInstance;

    this.visualDeveloperInstance.EventManager.registerEvent(this.pageVersionsEventListUpdate);
    this.visualDeveloperInstance.EventManager.registerEvent(this.pageVersionsEventAddNew);

    this._initEventListener();
  },

  _initEventListener : function() {
    this.visualDeveloperInstance.EventManager.listenEvent(
        this.visualDeveloperInstance.universalEventSettingsUpdate,
        this,
        '_eventSettingsUpdate'
    );
  },

  _eventSettingsUpdate : function(JSONInformation) {
    if(typeof JSONInformation['pageVersions'] !== "undefined")
      this.entries = JSONInformation.pageVersions;
    else
      this.entries = {};
  },

  /**
   *
   * @param versionInformation
   * @returns {*}
   * @constructor
   */
  AddNewVersion : function(versionInformation) {
    var objectInstance = this;

    if(this.visualDeveloperInstance.ApplicationSynchronize.postID != false
        && typeof versionInformation.page_id == "undefined")
      versionInformation.page_id = this.visualDeveloperInstance.ApplicationSynchronize.postID;

    var postedInformation = {
      action             : this._settings.ajaxAddPageVersionAction,
      versionInformation : versionInformation
    };

    var ajaxRequestObject = jQuery.post(WordpressAjax.target, postedInformation, function(r) {
      var response = (typeof r == "object" ? r : jQuery.parseJSON(r));

      objectInstance.entries[response.versionInformation.id] = response.versionInformation;

      objectInstance.visualDeveloperInstance
                    .EventManager
                    .triggerEvent(
                        objectInstance.pageVersionsEventListUpdate,
                        objectInstance.entries
                    );

      objectInstance.visualDeveloperInstance
                    .EventManager
                    .triggerEvent(
                        objectInstance.pageVersionsEventAddNew,
                        response.versionInformation
                    );
    });

    return ajaxRequestObject;
  },

  DeleteVersion : function(versionID) {
    var objectInstance = this;

    var postedInformation = {
      action    : this._settings.ajaxDeletePageVersionAction,
      versionID : versionID
    };

    var ajaxRequestObject = jQuery.post(WordpressAjax.target, postedInformation, function(r) {
      var response = (typeof r == "object" ? r : jQuery.parseJSON(r));

      delete objectInstance.entries[response.version_id];

      objectInstance.visualDeveloperInstance
                    .EventManager
                    .triggerEvent(
                        objectInstance.pageVersionsEventListUpdate,
                        objectInstance.entries
                    );
    });

    return ajaxRequestObject;
  },

  SwitchToPageVersion : function(versionID) {
    this.versionID = versionID;

    this.visualDeveloperInstance.PageVersionsPanel.HidePanel();
    this.visualDeveloperInstance.ApplicationSynchronize.SyncApplicationWithLayout();
  }


};