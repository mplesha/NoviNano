VisualDeveloper.ApplicationSynchronize = {

  _lang : {
    loaderText  : "Visual Developer is synchronizing with the application"
  },
  _settings               : {
    ajaxSetLayoutAction       : 'visual_developer_setLayout',
    ajaxGetLayoutAction       : 'visual_developer_getLayout',
    loaderOverlayID           : 'application-synchronize-overlay',
    loaderArrangeEvent        : 'resize'
  },

  visualDeveloperInstance : {},
  loaderObject            : false,

  postID        : false,

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
    this._initPostInformation();

    this.SyncApplicationWithLayout();
  },

  _initDependencies : function() {
    this._prefixCSSSettings();

    this._settings.loaderArrangeEvent  = this._settings.loaderArrangeEvent
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-application-synchronize ') +
        '.' + this.visualDeveloperInstance.namespace + '-application-synchronize ';
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  _initPostInformation : function() {
    if(typeof PluginInfo.post_id !== "undefined")
      this.postID = PluginInfo.post_id;

  },

  SyncApplicationWithLayout : function() {
    var objectInstance = this;

    this.displayLoader();

    jQuery.each(objectInstance.visualDeveloperInstance.ElementPanel.elementOptionsObjectList, function(index, elementOption){
      elementOption.Reset();
    });

    objectInstance
        .visualDeveloperInstance
        .ElementPanel
        .elementOptionsObjectList = {};

    var postedInformation = {
      action : this._settings.ajaxGetLayoutAction
    };

    if(this.postID != false)
      postedInformation.post_id = this.postID;
    else if( typeof PluginInfo != "undefined" && PluginInfo.post_id != 0)
      postedInformation.support_post_id = PluginInfo.post_id;

    if(this.visualDeveloperInstance.PageVersions.versionID != false)
      postedInformation.version_id = this.visualDeveloperInstance.PageVersions.versionID;

    var ajaxRequestObject = jQuery.post(WordpressAjax.target, postedInformation, function(r) {
      var response = (typeof r == "object" ? r : jQuery.parseJSON(r));

      objectInstance.UpdateLayoutInformationFromJSON(response);

      objectInstance.hideLoader();
    });

    return ajaxRequestObject;
  },

  UpdateLayoutInformationFromJSON : function(JSONInformation) {
    this.visualDeveloperInstance.EventManager.triggerEvent(
        this.visualDeveloperInstance.universalEventSettingsUpdate, JSONInformation
    );

  },

  UpdateLayoutInformationFromExportJSON : function(JSONInformation) {
    if(typeof JSONInformation.layoutInfoJSONPack != "undefined")
      JSONInformation.layout_information = JSONInformation.layoutInfoJSONPack;

    this.UpdateLayoutInformationFromJSON(JSONInformation);
  },

  SyncLayoutWithApplication : function() {
    var objectInstance = this;

    this.displayLoader();

    var ajaxRequestObject = jQuery.post(WordpressAjax.target, this.GetLayoutInformationJSON(), function(r) {
      objectInstance.hideLoader();
    });

    return ajaxRequestObject;
  },

  GetLayoutInformationJSON : function() {
    var returnInformation = this.GetGeneralLayoutInformationJSON();

    if(this.postID != false)
      returnInformation.post_id = this.postID;
    else if( typeof PluginInfo != "undefined" && PluginInfo.post_id != 0)
      returnInformation.support_post_id = PluginInfo.post_id;

    if(this.visualDeveloperInstance.PageVersions.versionID != false)
      returnInformation.version_id = this.visualDeveloperInstance.PageVersions.versionID;

    return returnInformation;
  },

  GetLayoutInformationExportJSON : function() {
    return this.GetGeneralLayoutInformationJSON();
  },

  GetGeneralLayoutInformationJSON : function() {
    var layoutInformation = {
      action              : this._settings.ajaxSetLayoutAction
    };

    layoutInformation = this.visualDeveloperInstance.FilterManager.parseFilter(
        this.visualDeveloperInstance.universalFilterSettingsExport, layoutInformation
    );

    return layoutInformation;
  },

  displayLoader : function(message) {
    if(this.loaderObject === false) {
      jQuery('body').append(this._getLoaderOverlay(message));
      this.loaderObject = jQuery("#" + this._settings.loaderOverlayID);

      this.loaderObject.hide();
      this._arrangeLoaderOverlay();
      this.loaderObject.fadeIn("slow");

      var objectInstance = this;

      jQuery(window).bind(this._settings.loaderArrangeEvent, function(){
        objectInstance._arrangeLoaderOverlay();
      });
    }
  },

  hideLoader : function() {
    if(this.spectralModeOverlayObject !== false) {
      jQuery(window).unbind(this._settings.loaderArrangeEvent);

      this.loaderObject.fadeOut("slow", function(){
        jQuery(this).remove();
      });

      this.loaderObject = false;
    }
  },

  _getLoaderOverlay : function(message) {
    return '<div id="' + this._settings.loaderOverlayID + '">' +
              '<ul>' +
                '<li></li>' +
                '<li></li>' +
                '<li></li>' +
                '<li></li>' +
              '</ul>' +
              '<p>' + (typeof message !== "undefined" ? message : this._lang.loaderText) + '</p>' +
           '</div>';
  },

  _arrangeLoaderOverlay : function() {
    this.loaderObject
        .css("width", jQuery(window).width())
        .css("height", jQuery(window).height());
  },

  SetPostSpecific : function(postID) {
    this.postID = postID;

    this.SyncApplicationWithLayout();
  },

  SetNoSpecific : function() {
    this.postID = false;

    this.SyncApplicationWithLayout();
  }

};