VisualDeveloper.EventManager = {

  eventList : {},

  Init : function() {

  },

  registerEvent : function(eventIdentifier) {
    if(typeof this.eventList[eventIdentifier] == "undefined")
      this.eventList[eventIdentifier] = [];
  },

  unRegisterEvent : function(eventIdentifier) {
    if(typeof this.eventList[eventIdentifier] != "undefined")
      delete this.eventList[eventIdentifier];
  },

  triggerEvent  : function(eventIdentifier, data) {
    data = typeof data != "undefined" ? data : {};

    if(typeof this.eventList[eventIdentifier] != "undefined") {
      var currentEventInformation = this.eventList[eventIdentifier];

      for(var currentListenerIndex in currentEventInformation) {
        var currentListener       = currentEventInformation[currentListenerIndex],
            currentListenerMethod = currentListener['method'];

        currentListener.object[currentListenerMethod].call(currentListener.object, data);
      }
    }
  },

  listenEvent : function(eventIdentifier, object, method) {
    if( eventIdentifier instanceof Array ) {
      var objectInstance = this;

      jQuery.each(eventIdentifier, function( index, currentEventIdentifier ) {
        objectInstance.listenEvent( currentEventIdentifier, object, method );
      });

      return true;
    }

    if(typeof this.eventList[eventIdentifier] == "undefined")
      this.registerEvent(eventIdentifier);

    this.eventList[eventIdentifier][this.eventList[eventIdentifier].length] = {
      'object' : object,
      'method' : method
    };

    return true;
  }
};