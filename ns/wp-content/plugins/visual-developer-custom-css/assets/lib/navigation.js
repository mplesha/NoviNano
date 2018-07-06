VisualDeveloper.Navigation = {

  visualDeveloperInstance : {},

  _settings : {
    navigationVisualIndicatorClass          : 'navigation-item',
    navigationSelectedIndicatorClass        : 'navigation-item-selected',
    navigationSelectedMirrorIndicatorClass  : 'navigation-item-selected-mirror',
    navigationIndicatorTarget               : '*:not([id^="visual-developer"])',
    navigationIndicatorEvent                : 'mouseenter',
    navigationIndicatorCloseEvent           : 'mouseleave',
    navigationSelectionEvent                : 'click'
  },

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._prefixCSSSettings();
    this._settings.navigationIndicatorEvent         = this._settings.navigationIndicatorEvent + '.' + this.visualDeveloperInstance.namespace + "-navigation";
    this._settings.navigationIndicatorCloseEvent    = this._settings.navigationIndicatorCloseEvent + '.' + this.visualDeveloperInstance.namespace + "-navigation";
    this._settings.navigationSelectionEvent         = this._settings.navigationSelectionEvent + '.' + this.visualDeveloperInstance.namespace + "-navigation";
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  OpenNavigation : function() {
    var objectInstance = this;

    this.CloseNavigation();

    jQuery(this._settings.navigationIndicatorTarget)
        .bind(this._settings.navigationIndicatorEvent, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          objectInstance.visualDeveloperInstance.Panel.SetUserNotification(
              objectInstance.visualDeveloperInstance.GetElementAbsolutePath(jQuery(this))
          );

          jQuery(this).addClass(objectInstance._settings.navigationVisualIndicatorClass);
          jQuery(this).parents().removeClass(objectInstance._settings.navigationVisualIndicatorClass);
        }).bind(this._settings.navigationIndicatorCloseEvent, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          jQuery(this).removeClass(objectInstance._settings.navigationVisualIndicatorClass);
        }).bind(this._settings.navigationSelectionEvent, function(event){
          event.stopImmediatePropagation();
          event.preventDefault();

          jQuery(this).removeClass(objectInstance._settings.navigationVisualIndicatorClass);

          objectInstance.visualDeveloperInstance.Panel.SetUserNotification(
              objectInstance.visualDeveloperInstance.GetElementAbsolutePath(jQuery(this))
          );

          objectInstance.visualDeveloperInstance.NavigationPanel.ActivateNodeInstance(jQuery(this));
          objectInstance._closeNavigationVisualIndicator();
        });
  },

  MarkNavigationVisualSelectedElement : function(jQueryElementObject) {
    jQueryElementObject.addClass(this._settings.navigationSelectedIndicatorClass);
  },

  UnMarkNavigationVisualSelectedElement : function(jQueryElementObject) {
    jQueryElementObject.removeClass(this._settings.navigationSelectedIndicatorClass);
  },

  MarkNavigationVisualSelectedMirrorElement : function(jQueryElementObject) {
    jQueryElementObject.addClass(this._settings.navigationSelectedMirrorIndicatorClass);
  },

  UnMarkNavigationVisualSelectedMirrorElement : function(jQueryElementObject) {
    jQueryElementObject.removeClass(this._settings.navigationSelectedMirrorIndicatorClass);
  },

  _closeNavigationVisualIndicator : function() {
    jQuery(this._settings.navigationIndicatorTarget)
        .trigger(this._settings.navigationIndicatorCloseEvent)
        .unbind(this._settings.navigationIndicatorEvent)
        .unbind(this._settings.navigationIndicatorCloseEvent)
        .unbind(this._settings.navigationSelectionEvent);
  },

  CloseNavigation : function() {
    this._closeNavigationVisualIndicator();
    this.visualDeveloperInstance.NavigationPanel.CloseNavigationPanel();
  }

};