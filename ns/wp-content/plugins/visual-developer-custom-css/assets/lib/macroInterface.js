VisualDeveloper.MacroInterface = {

  _lang     : {
    title  : 'Interactive Mode'
  },

  _settings : {
    arrangeEvents : 'resize',
    panelID       : 'macro-interface-panel',
    panelHeaderID : 'macro-interface-panel-header',
    panelContentID: 'macro-interface-panel-content'
  },

  panelObject       : {},
  panelHeaderObject : {},
  panelContentObject: {},

  isActive : false,
  visualDeveloperInstance : {},

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._settings.arrangeEvents  = this._settings.arrangeEvents
        .replace(/ /g, '.' + this.visualDeveloperInstance.namespace + '-macro-interface ') +
        '.' + this.visualDeveloperInstance.namespace + '-macro-interface ';

    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  DisplayInterface : function() {
    if(this.isActive == true)
      return;

    jQuery("body").append(this._getPanelHTML());
    this.panelObject        = jQuery("#" + this._settings.panelID);
    this.panelHeaderObject  = jQuery("#" + this._settings.panelHeaderID);
    this.panelContentObject = jQuery("#" + this._settings.panelContentID);

    this._arrangePanel();

    var objectInstance = this;

    this.panelContentObject.find("> div").each(function(){
      objectInstance.visualDeveloperInstance
                    .MacroInterfaceOperations
                    .AssignMacroOperationsInContainer(
              objectInstance.visualDeveloperInstance.Macro[
                jQuery(this).attr(objectInstance.visualDeveloperInstance.MacroInterfaceOperations._settings.fieldMacroContainerAttribute)
              ],
              jQuery(this)
          );
    });

    this.panelObject.hide().slideDown("slow");

    jQuery(window).unbind(this._settings.arrangeEvents).bind(this._settings.arrangeEvents, function(){
      objectInstance._arrangePanel();
    });

    this.isActive = true;
  },

  _getPanelHTML : function() {
    var panelHTML =  '<div id="' + this._settings.panelID + '">';
        panelHTML +=    '<header id="' + this._settings.panelHeaderID + '">';
        panelHTML +=       this._lang.title;
        panelHTML +=    '</header>';
        panelHTML +=    '<section id="' + this._settings.panelContentID + '">';
        panelHTML +=       this._getPanelContentHTML();
        panelHTML +=    '</section>';
        panelHTML += '</div>';

    return panelHTML;
  },

  _getPanelContentHTML : function() {
    var objectInstance   = this,
        panelContentHTML = '';

    jQuery.each(this.visualDeveloperInstance.Macro, function(macroIndex, macroInformation){
      panelContentHTML += objectInstance.visualDeveloperInstance.MacroInterfaceOperations.GetMacroSettingsHTML(macroIndex);
    });

    return panelContentHTML;
  },

  _arrangePanel : function() {
    var elementPanelObject      = this.visualDeveloperInstance.ElementPanel.currentPanelOperationsObject,
        elementPanelFilterInput = this.visualDeveloperInstance.ElementPanel.currentPanelOptionFilterObject;

    if(elementPanelObject == false
        || !(elementPanelObject.length > 0))
      return;

    var top  = elementPanelObject.offset().top - jQuery(document).scrollTop(),
        left = elementPanelObject.offset().left;

    if(elementPanelFilterInput !== false
        && elementPanelFilterInput.length > 0
        && elementPanelFilterInput.is(":visible"))
      top = elementPanelFilterInput.offset().top - jQuery(document).scrollTop();

    this.panelObject
        .height(jQuery(window).height() - top)
        .css('top', top)
        .css('left', left);

    this.panelContentObject.css("height", this.panelObject.height() - this.panelHeaderObject.height() - 15);
  },

  CloseInterface    : function() {
    if(this.isActive == false)
      return;

    var objectInstance = this;

    this.panelObject.slideUp("slow", function() {
      objectInstance._onInterfaceClose();
    });
  },

  _onInterfaceClose : function() {
    this.panelObject.remove();
    this.isActive = false;

    jQuery(window).unbind(this._settings.arrangeEvents);
  }


};