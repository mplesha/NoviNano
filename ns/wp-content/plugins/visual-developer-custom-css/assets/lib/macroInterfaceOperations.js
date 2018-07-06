VisualDeveloper.MacroInterfaceOperations = {

  visualDeveloperInstance : {},

  _lang : {
    placeholderColorPickerInput : "Color Picker",
    placeholderTextInput        : "Value"
  },

  _settings : {
    fieldColorPickerInputClass           : 'color-picker-field',
    fieldColorPickerInputAttribute       : 'is-color-picker-field',
    labelFieldNameClass                  : 'macro-operations-field-label',
    fieldMacroContainerClass             : 'macro-operations-field-container',
    fieldMacroContainerModelPrefixClass  : 'macro-operations-model-',
    fieldMacroContainerAttribute         : 'macro-operations-field-option-name',
    fieldMacroActiveStateClass           : 'macro-operations-active-rule',
    fieldMacroEnableTrigger              : 'click',
    fieldMacroSyncTrigger                : 'keyup change'
  },

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

  /**
   * @param macroIndex
   * @returns {string}
   * @constructor
   */
  GetMacroSettingsHTML : function(macroIndex) {
    var objectInstance = this,
        currentMacro   = this.visualDeveloperInstance.Macro[macroIndex],
        html           = '';


    html += '<div class="' + this._settings.fieldMacroContainerClass + '" ' + this._settings.fieldMacroContainerAttribute + '="' + macroIndex + '">';
    html +=   '<p class="' + this._settings.labelFieldNameClass + '">' + currentMacro.name + '</p>';
    html +=   '<ul class="' + this._settings.fieldMacroContainerModelPrefixClass + (typeof currentMacro.cssModel === "undefined" ? "default" : currentMacro.cssModel) + '" ';
    html +=   '>';

    jQuery.each(currentMacro.getMacroFormat(), function(alias, informationMAP){
      if(informationMAP.fieldType == 'input')
        html += '<li>' + objectInstance._getTextInputMacroHTML(
                    macroIndex + "-" + alias, informationMAP
                ) + '</li>';
      else if(informationMAP.fieldType == 'select')
        html += '<li>' + objectInstance._getSelectInputMacroHTML(
                    macroIndex + "-" + alias, informationMAP
                ) + '</li>';
    });
    html +=   '</ul>';
    html += '</div>';

    return html;
  },

  _getTextInputMacroHTML : function(alias, informationMAP) {
    var inputMacroHTML = '';

    inputMacroHTML += '<input type="text" ';
    inputMacroHTML +=        'name="' + this.visualDeveloperInstance.fieldNamespace + alias + '" ';
    if(typeof informationMAP.placeholder !== "undefined" )
      inputMacroHTML +=        'placeholder="' + informationMAP.placeholder + '" ';
    else
      inputMacroHTML +=        'placeholder="' + this._lang.placeholderTextInput + '" ';

    inputMacroHTML += '/>';

    return inputMacroHTML;
  },

  _getSelectInputMacroHTML : function(alias, informationMAP) {
    var inputMacroHTML = '';

    inputMacroHTML += '<select name="' + this.visualDeveloperInstance.fieldNamespace + alias + '">';

    jQuery.each(informationMAP.fieldOptions, function(key, value){
        inputMacroHTML += '<option value="' + key + '">' + value + '</option>';
    });

    inputMacroHTML += '</select>';

    return inputMacroHTML;
  },

  AssignMacroOperationsInContainer : function(currentMacro, macroContainer) {
    var objectInstance = this;

    macroContainer.find(':input')
        .unbind(this._settings.fieldMacroSyncTrigger)
        .bind(this._settings.fieldMacroSyncTrigger, function(){
          var currentPatternRow = jQuery(this)
                  .parents("." + objectInstance._settings.fieldMacroContainerClass + ':first'),
              currentName = currentPatternRow
                  .attr(objectInstance._settings.fieldMacroContainerAttribute),
              currentFieldInputNamePrefix = objectInstance.visualDeveloperInstance.fieldNamespace + currentName;

          var fieldValues = {};

          jQuery.each(currentPatternRow.find('[name^="' + currentFieldInputNamePrefix + '"]'), function(){
            var inputName = jQuery(this).attr("name").substr(currentFieldInputNamePrefix.length + 1);

            if(inputName.substr(inputName.length - 2) == "[]") {
              inputName = inputName.substr(0, inputName.length - 2);

              if(typeof fieldValues[inputName] === "undefined")
                fieldValues[inputName] = [];

              fieldValues[inputName][fieldValues[inputName].length] = jQuery(this).val();
            } else {
              fieldValues[inputName] = jQuery(this).val();
            }
          });

          var elementPanel = objectInstance.visualDeveloperInstance.ElementPanel;

          elementPanel
              .elementOptionsObjectList[elementPanel.elementPatternMD5]
              .SetOptionValues(
                  currentMacro.targetOption, currentMacro.composeOptionFormat(fieldValues)
              );
          elementPanel
              .elementOptionsObjectList[elementPanel.elementPatternMD5]
              .EnableOption(currentMacro.targetOption);

          if( typeof currentMacro.important !== "undefined" && currentMacro.important == true )
            elementPanel
                .elementOptionsObjectList[elementPanel.elementPatternMD5]
                .EnableOptionImportant(currentMacro.targetOption);

          elementPanel.RefreshPanelOperationsContent();
        });


    this._populateInputsWithCurrentValuesOnLoad(currentMacro, macroContainer);

    var splitSelectObjects = macroContainer.find(
        "." + this._settings.fieldMacroContainerModelPrefixClass + 'single select, ' +
            "." + this._settings.fieldMacroContainerModelPrefixClass + 'border > li:last-child select'
    );

    var splitInlineSelectObjects = macroContainer.find(
        "." + this._settings.fieldMacroContainerModelPrefixClass + 'single-inline select'
    );

    var imageSelectObjects = macroContainer.find(
        "." + this._settings.fieldMacroContainerModelPrefixClass + 'image-select select'
    );

    var colorSelectObjects = macroContainer.find(
        "." + this._settings.fieldMacroContainerModelPrefixClass + 'single-color-select select'
    );

    this.visualDeveloperInstance.Utility.SplitSelect.InitInstance(splitSelectObjects);
    this.visualDeveloperInstance.Utility.ImageSelect.InitInstance(imageSelectObjects, true);
    this.visualDeveloperInstance.Utility.ColorSelect.InitInstance(colorSelectObjects);
    this.visualDeveloperInstance.Utility.SplitInlineSelect.InitInstance(splitInlineSelectObjects);

    this.visualDeveloperInstance.Utility.NiceSelect.InitInstance(
        macroContainer.find("select").not(splitSelectObjects).not(imageSelectObjects).not(colorSelectObjects).not(splitInlineSelectObjects)
    );
  },

  _populateInputsWithCurrentValuesOnLoad : function(macrosObject, macroContainer) {
    var objectInstance = this,
        elementPanel   = this.visualDeveloperInstance.ElementPanel;

    jQuery.each(macrosObject.getMacroFormat(), function(key, format) {
        var macro = macroContainer.find(
              '[name="' + objectInstance.visualDeveloperInstance.fieldNamespace + macrosObject.alias + "-" + key + '"]'
            ),
            currentOptionInformation = elementPanel.elementOptionsObjectList[elementPanel.elementPatternMD5].options[macrosObject.targetOption];

        if(typeof currentOptionInformation !== "undefined") {
          macro.attr("data-clean-value", macrosObject.getMacroValueByOptionFormat(currentOptionInformation));
          macro.val(macro.attr("data-clean-value"));
        }
    });
  }


};