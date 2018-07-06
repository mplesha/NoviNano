VisualDeveloper.FilterManager = {

  filterList : {},

  Init : function() {

  },

  registerFilter : function(eventIdentifier) {
    if(typeof this.filterList[eventIdentifier] == "undefined")
      this.filterList[eventIdentifier] = [];
  },

  unRegisterFilter : function(eventIdentifier) {
    if(typeof this.filterList[eventIdentifier] != "undefined")
      delete this.filterList[eventIdentifier];
  },

  parseFilter  : function(eventIdentifier, data) {
    if(typeof this.filterList[eventIdentifier] != "undefined") {
      var currentEventInformation = this.filterList[eventIdentifier];

      for(var currentListenerIndex in currentEventInformation) {
        var currentListener       = currentEventInformation[currentListenerIndex],
            currentListenerMethod = currentListener['method'];

        data = currentListener.object[currentListenerMethod]
                              .call(currentListener.object, data);
      }
    }

    return data;
  },

  listenFilter : function(eventIdentifier, object, method) {
    if(typeof this.filterList[eventIdentifier] == "undefined")
      this.registerFilter(eventIdentifier);

    this.filterList[eventIdentifier][this.filterList[eventIdentifier].length] = {
      'object' : object,
      'method' : method
    };
  }
};