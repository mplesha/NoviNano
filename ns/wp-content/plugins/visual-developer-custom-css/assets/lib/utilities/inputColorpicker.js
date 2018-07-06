VisualDeveloper.Utility.InputColorpicker = {

  _settings : {
    triggerEvent : "change"
  },

  visualDeveloperInstance : {},
  instanceList            : [],

  Init : function(visualDeveloperInstance) {
    this.visualDeveloperInstance = visualDeveloperInstance;
    this._initDependencies();
  },

  _initDependencies : function() {
    this._prefixCSSSettings();
  },

  _prefixCSSSettings : function() {
    this._settings = this.visualDeveloperInstance.PrefixNonEventSettings(
        this._settings, this.visualDeveloperInstance.styleNamespace);
  },

  InitInstance : function(inputObject) {
    var objectInstance = this;

    inputObject.each(function(){
      objectInstance.instanceList[objectInstance.instanceList.length] = jQuery.extend(1, {}, objectInstance.InstanceObject);
      objectInstance.instanceList[objectInstance.instanceList.length - 1].Init(objectInstance, jQuery(this));
    });
  },

  InstanceObject : {

    inputObject       : false,
    inputColorPickerInstance : {},

    Init : function(inputColorPickerInstance, inputObject) {
      this.inputColorPickerInstance = inputColorPickerInstance;
      this.inputObject              = inputObject;

      this.setInputBackground();

      var objectInstance = this;

      this.inputObject.bind(this.inputColorPickerInstance._settings.triggerEvent, function(){
        objectInstance.setInputBackground();
      });
    },

    setInputBackground : function() {
      this.inputObject.css("background", this.inputObject.val());
    }

  }

};