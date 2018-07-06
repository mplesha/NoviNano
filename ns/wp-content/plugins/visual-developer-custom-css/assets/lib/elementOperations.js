VisualDeveloper.ElementOperations = {

  visualDeveloperInstance : {},

  _lang : {
    placeholderColorPickerInput : "Color Picker",
    placeholderTextInput        : "Value",
    operationSetImportant       : '!important'
  },

  _settings : {
    fieldAllow4InputAttribute              : 'allow-four-input-map',
    fieldNumericInputAttribute             : 'is-numeric-field',
    fieldColorPickerInputClass             : 'color-picker-field',
    fieldColorPickerInputAttribute         : 'is-color-picker-field',
    labelFieldNameClass                    : 'element-operations-field-label',
    fieldElementContainerClass             : 'element-operations-field-container',
    fieldElementContainerModelPrefixClass  : 'element-operations-model-',
    fieldElementContainerOptionAttribute   : 'element-operations-field-option-name',
    fieldElementActiveStateClass           : 'element-operations-active-rule',
    fieldElementEnableTrigger              : 'click',
    fieldElementSyncTrigger                : 'keyup change',
    fieldElementImportantToggleTrigger     : 'click',
    fieldElementImportantToggleClass       : 'element-operations-field-important-toggle',
    fieldElementImportantActiveClass       : 'element-operations-field-important-active'
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
   * @param elementOptionIndex
   * @returns {string}
   * @constructor
   */
  GetElementOptionSettingsHTML : function(elementOptionIndex) {
    var objectInstance = this,
        currentOption  = this.visualDeveloperInstance.ElementOption[elementOptionIndex],
        html           = '';

    html += '<div class="' + this._settings.fieldElementContainerClass + '" ' + this._settings.fieldElementContainerOptionAttribute + '="' + elementOptionIndex + '">';
    html +=   '<p class="' + this._settings.labelFieldNameClass + '">';

    if(this.visualDeveloperInstance.hasSettingEnableImportantElement) {
      html +=    '<span class="' + this._settings.fieldElementImportantToggleClass + '">';
      html +=      this._lang.operationSetImportant;
      html +=    '</span>';
    }

    html +=       currentOption.name;
    html +=   '</p>';
    html +=   '<ul class="' + this._settings.fieldElementContainerModelPrefixClass + (typeof currentOption.cssModel === "undefined" ? "default" : currentOption.cssModel) + '" ';
    html +=     this._settings.fieldAllow4InputAttribute + '="' + (typeof currentOption.allow4InputMap === "undefined" ? 0 : currentOption.allow4InputMap | 0) + '"';
    html +=   '>';
    jQuery.each(currentOption.format, function(alias, informationMAP){
      if(informationMAP.fieldType == 'input')
        html += '<li>' + objectInstance._getTextInputElementOptionHTML(
                  elementOptionIndex + "-" + alias, informationMAP
                 ) + '</li>';
      else if(informationMAP.fieldType == 'url')
        html += '<li>' + objectInstance._getURLInputElementOptionHTML(
            elementOptionIndex + "-" + alias, informationMAP
                ) + '</li>';
      else if(informationMAP.fieldType == 'select')
        html += '<li>' + objectInstance._getSelectInputElementOptionHTML(
                  elementOptionIndex + "-" + alias, informationMAP
                ) + '</li>';
      else if(informationMAP.fieldType == 'color-picker')
        html += '<li>' + objectInstance._getColorPickerInputElementOptionHTML(
                  elementOptionIndex + "-" + alias, informationMAP
                ) + '</li>';
    });
    html +=   '</ul>';
    html += '</div>';

    return html;
  },

  _getTextInputElementOptionHTML : function(alias, informationMAP) {
    var inputElementOptionHTML = '';

    inputElementOptionHTML += '<input type="text" ';
    inputElementOptionHTML +=        'name="' + this.visualDeveloperInstance.fieldNamespace + alias + '" ';
    if(typeof informationMAP.placeholder !== "undefined" )
      inputElementOptionHTML +=        'placeholder="' + informationMAP.placeholder + '" ';
    else
      inputElementOptionHTML +=        'placeholder="' + this._lang.placeholderTextInput + '" ';

    if(typeof informationMAP.fieldValidation !== "undefined" )
      if(informationMAP.fieldValidation === "numeric" )
        inputElementOptionHTML +=        this._settings.fieldNumericInputAttribute + '="1" ';

    inputElementOptionHTML += '/>';

    return inputElementOptionHTML;
  },

  _getURLInputElementOptionHTML : function(alias, informationMAP) {
    var inputElementOptionHTML = '';

    inputElementOptionHTML += '<input type="text" ';
    inputElementOptionHTML +=        'name="' + this.visualDeveloperInstance.fieldNamespace + alias + '" ';
    if(typeof informationMAP.placeholder !== "undefined" )
      inputElementOptionHTML +=        'placeholder="' + informationMAP.placeholder + '" ';


    inputElementOptionHTML += '/>';

    return inputElementOptionHTML;
  },

  _getSelectInputElementOptionHTML : function(alias, informationMAP) {
    var inputElementOptionHTML = '',
        optionsWithIndicators = !(informationMAP.fieldOptions instanceof Array);

    inputElementOptionHTML += '<select name="' + this.visualDeveloperInstance.fieldNamespace + alias + '">';

    jQuery.each(informationMAP.fieldOptions, function(key, value){
      if(optionsWithIndicators) {
        inputElementOptionHTML += '<option data-tooltip="' + value + '" value="' + key + '" ' +
                                  '>' + key  + '</option>';
      } else {
        inputElementOptionHTML += '<option value="' + value + '">' + value + '</option>';
      }
    });

    inputElementOptionHTML += '</select>';

    return inputElementOptionHTML;
  },

  _getColorPickerInputElementOptionHTML : function(alias, informationMAP) {
    var inputElementOptionHTML = '';

    inputElementOptionHTML += '<input type="text" ';
    inputElementOptionHTML +=        'class="' + this._settings.fieldColorPickerInputClass + '" ';
    inputElementOptionHTML +=        'name="' + this.visualDeveloperInstance.fieldNamespace + alias + '" ';
    inputElementOptionHTML +=        'placeholder="' + (typeof informationMAP.placeholder !== "undefined" ? informationMAP.placeholder : this._lang.placeholderColorPickerInput) + '" ';
    inputElementOptionHTML +=        this._settings.fieldColorPickerInputAttribute + '="1" ';
    inputElementOptionHTML += '/>';


    return inputElementOptionHTML;
  },

  AssignElementOperationsInOperationGroups : function(elementOptionsObject, operationGroups) {
    var objectInstance = this;

    operationGroups.find('.' + this._settings.labelFieldNameClass)
        .unbind(this._settings.fieldElementEnableTrigger)
        .bind(this._settings.fieldElementEnableTrigger, function(){
      jQuery(this).parent().toggleClass(objectInstance._settings.fieldElementActiveStateClass);

      var currentOptionName = jQuery(this)
          .parents("." + objectInstance._settings.fieldElementContainerClass + ':first')
          .attr(objectInstance._settings.fieldElementContainerOptionAttribute);

      if(jQuery(this).parent().hasClass(objectInstance._settings.fieldElementActiveStateClass)) {
        elementOptionsObject.EnableOption(currentOptionName);
      } else {
        elementOptionsObject.DisableOption(currentOptionName);
      }
    });

    operationGroups.find(':input')
        .unbind(this._settings.fieldElementSyncTrigger)
        .bind(this._settings.fieldElementSyncTrigger, function(){
      var currentPatternRow = jQuery(this)
              .parents("." + objectInstance._settings.fieldElementContainerClass + ':first'),
          currentOptionName = currentPatternRow
              .attr(objectInstance._settings.fieldElementContainerOptionAttribute),
          currentFieldInputNamePrefix = objectInstance.visualDeveloperInstance.fieldNamespace + currentOptionName;

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

      if(!currentPatternRow.hasClass(objectInstance._settings.fieldElementActiveStateClass))
        currentPatternRow.find('.' + objectInstance._settings.labelFieldNameClass).trigger(
            objectInstance._settings.fieldElementEnableTrigger
        );

      elementOptionsObject.SetOptionValues(currentOptionName, fieldValues);
    });


    this._handleUserOptions(elementOptionsObject, operationGroups);
    this._populateInputsWithCurrentValuesOnLoad(elementOptionsObject, operationGroups);

    var splitSelectObjects = operationGroups.find(
        "." + this._settings.fieldElementContainerModelPrefixClass + 'single select, ' +
            "." + this._settings.fieldElementContainerModelPrefixClass + 'border > li:last-child select'
    );

    this.visualDeveloperInstance.Utility.SplitSelect.InitInstance(splitSelectObjects);

    this.visualDeveloperInstance.Utility.NiceSelect.InitInstance(
        operationGroups.find("select").not(splitSelectObjects)
    );

    this.visualDeveloperInstance.Utility.InputMAP.InitInstance(
        operationGroups.find('[' + this._settings.fieldAllow4InputAttribute + '="1"]')
    );

    this.visualDeveloperInstance.Utility.InputColorpicker.InitInstance(
        operationGroups.find('.' + this._settings.fieldColorPickerInputClass)
    );

    if(typeof operationGroups.on !== "undefined"
        && this.visualDeveloperInstance.hasSettingEnableColorPicker) {
      operationGroups.find('[' + this._settings.fieldColorPickerInputAttribute + '="1"]').each(function(){
        jQuery(this).colpick({
          layout      : 'rgbhex',
          submit      : 0,
          colorScheme : 'dark',
          onChange:function(hsb,hex,rgb,el,bySetColor) {
            if(!bySetColor) jQuery(el).val('#' + hex).trigger("change");
          }
        }).keyup(function(){
          jQuery(this).colpickSetColor(this.value);
        });
      });
    }

    if(this.visualDeveloperInstance.hasSettingEnableKeyboardArrowSupport) {
      operationGroups.find('[' + this._settings.fieldNumericInputAttribute + '="1"]').keyup(function(event){
        if(!(event.which == 40 || event.which == 38))
          return;

        var value = jQuery(this).val();

        if(value == "")
          value = 0;

        if(objectInstance.visualDeveloperInstance.Utility.isNumber(value)) {
          value = parseFloat(value);
          if(event.which == 40)
            value--;
          else
            value++;
        }

        jQuery(this).val(value);
      });
    }

    if(this.visualDeveloperInstance.hasSettingEnableImportantElement) {
      operationGroups.find('.' + this._settings.fieldElementImportantToggleClass)
          .unbind(this._settings.fieldElementImportantToggleTrigger)
          .bind(this._settings.fieldElementImportantToggleTrigger, function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        jQuery(this).toggleClass(objectInstance._settings.fieldElementImportantActiveClass);

        var currentOptionName = jQuery(this)
            .parents("." + objectInstance._settings.fieldElementContainerClass + ':first')
            .attr(objectInstance._settings.fieldElementContainerOptionAttribute);

        if(jQuery(this).hasClass(objectInstance._settings.fieldElementImportantActiveClass)) {
          elementOptionsObject.EnableOptionImportant(currentOptionName);
        } else {
          elementOptionsObject.DisableOptionImportant(currentOptionName);
        }
      });
    }
  },

  _handleUserOptions : function(elementOptionsObject, operationGroups) {
    var objectInstance = this;

    if(this.visualDeveloperInstance.hasSettingEMOptionDefaultSelected) {
      operationGroups.find('select').each(function(){
        if(jQuery(this).find('> option[val="em"]'))
          jQuery(this).val("em");
      });
    }

    if(this.visualDeveloperInstance.hasSettingFieldDefaultValue) {
      var currentElement = objectInstance.visualDeveloperInstance.ElementPanel.elementObject;
          currentElement = currentElement.length > 1 ? currentElement.eq(0) : currentElement;

      operationGroups.find('[' + this._settings.fieldElementContainerOptionAttribute + ']').each(function(){
        var optionAlias = jQuery(this).attr(objectInstance._settings.fieldElementContainerOptionAttribute);

        if(typeof objectInstance.visualDeveloperInstance.ElementOption[optionAlias].generateFormatByRule !== "undefined") {
          var ruleInformation = objectInstance.visualDeveloperInstance.ElementOption[optionAlias].generateFormatByRule(
                  currentElement.css(objectInstance.visualDeveloperInstance.ElementOption[optionAlias].cssRule)
              ),
              elementOption   = jQuery(this);

          jQuery.each(ruleInformation, function(key, value) {
            elementOption.find('input[name="visual_developer_' + optionAlias + '-' + key + '"]')
                         .attr("data-clean-value", value)
                         .val(value);
          });
        }
      });
    }
  },

  _populateInputsWithCurrentValuesOnLoad : function(elementOptionsObject, operationGroups) {
    var objectInstance = this;

    jQuery.each(elementOptionsObject.options, function(key, format) {
      if(typeof format === "object") {
        jQuery.each(format, function(formatKey, formatValue){
          var element = operationGroups.find(
                  '[name="' + objectInstance.visualDeveloperInstance.fieldNamespace + key + "-" + formatKey + '"]'
              );

          element.val(formatValue);
          element.attr("data-clean-value", formatValue);
        });
      }
    });

    jQuery.each(elementOptionsObject.activeOptions, function(elementOptionIndex, status) {
      if(status) {
        operationGroups
            .find(
                "." + objectInstance._settings.fieldElementContainerClass +
                    '[' + objectInstance._settings.fieldElementContainerOptionAttribute +
                    '="' + elementOptionIndex + '"]'
            ).addClass(objectInstance._settings.fieldElementActiveStateClass);
      }
    });

    jQuery.each(elementOptionsObject.importantOptions, function(elementOptionIndex, status) {
      if(status) {
        operationGroups
            .find(
                "." + objectInstance._settings.fieldElementContainerClass +
                    '[' + objectInstance._settings.fieldElementContainerOptionAttribute +
                    '="' + elementOptionIndex + '"]' +
                ' .' + objectInstance._settings.fieldElementImportantToggleClass
            ).addClass(objectInstance._settings.fieldElementImportantActiveClass);
      }
    });
  }
};