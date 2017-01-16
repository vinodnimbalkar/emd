// Copyright 2012 Google Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// you may obtain a copy of the License at
//
//        http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

(function(){
  var bookmarklet = {};
  bookmarklet.loadScript = function(id, src, opt_scriptLoadedCheck, opt_onScriptLoad) {
  if(!document.getElementById(id)) {
    var s = document.createElement("script");
    s.id = id;
    s.type = "text/javascript";
    s.src = src;
    bookmarklet.getHead(document).appendChild(s);
    if(opt_scriptLoadedCheck)bookmarklet.waitForScriptLoad(opt_scriptLoadedCheck, opt_onScriptLoad || bookmarklet.nullFunction);
    return true;
  }return false;
};
bookmarklet.nullFunction = function() {
};
bookmarklet.bind = function(fn, selfObj, var_args) {
  if (!fn) {
    throw new Error();
  }

  if (arguments.length > 2) {
    var boundArgs = Array.prototype.slice.call(arguments, 2);
    return function() {
      // Prepend the bound arguments to the current arguments.
      var newArgs = Array.prototype.slice.call(arguments);
      Array.prototype.unshift.apply(newArgs, boundArgs);
      return fn.apply(selfObj, newArgs);
    };

  } else {
    return function() {
      return fn.apply(selfObj, arguments);
    };
  }
}
bookmarklet.getHead = function(ownerDocument) {
  var head = ownerDocument.getElementsByTagName("head")[0];
  if(!head)head = ownerDocument.appendChild(ownerDocument.createElement("head"));
  return head;
};
bookmarklet.waitForScriptLoad = function(scriptLoadedCheck, onScriptLoad) {
  var setIntervalId = window.setInterval(function() {
    var r = eval(scriptLoadedCheck);
    if(r) {
      window.clearInterval(setIntervalId);
      onScriptLoad();
    }
  }, 50);
};
bookmarklet.loadCSS = function(id, src, ownerDocument) {
  if(!ownerDocument.getElementById(id)) {
    var s = ownerDocument.createElement("link");
    s.id = id;
    s.type = "text/css";
    s.rel = "stylesheet";
    s.href = src;
    bookmarklet.getHead(ownerDocument).appendChild(s);
  }
};
bookmarklet.lastTimeoutId = null;
bookmarklet.showStatus = function(statusId, message, opt_timeToShow) {
  if(!document.body)return false;
  var statusLabel = document.getElementById(statusId);
  if(!statusLabel) {
    statusLabel = document.createElement("span");
    statusLabel.id = statusId;
    document.body.appendChild(statusLabel);
  }var isIE = navigator.userAgent.indexOf("MSIE") != -1;
  var position = isIE ? "absolute" : "fixed";
  statusLabel.style.cssText = "z-index: 99; font-size: 14px; font-weight: bold; " + "padding: 4px 6px 4px 6px; background: #FFF1A8; " + "position: " + position + "; top: 0";
  statusLabel.innerHTML = message;
  var docClientWidth = document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth;
  statusLabel.style.left = (docClientWidth - statusLabel.clientWidth) / 2 + "px";
  if(bookmarklet.lastTimeoutId) {
    window.clearTimeout(bookmarklet.lastTimeoutId);
    bookmarklet.lastTimeoutId = null
  }if(opt_timeToShow)bookmarklet.lastTimeoutId = window.setTimeout(function() {
    bookmarklet.clearStatus(statusId)
  }, opt_timeToShow);
  return true
};
bookmarklet.clearStatus = function(statusId) {
  var statusElement = document.getElementById(statusId);
  if(statusElement) {
    statusElement.parentNode.removeChild(statusElement);
    return true
  }else return false
};
bookmarklet.getProtocol = function() {
  var protocol = window.location.protocol;
  return protocol == "https:" ? "https:" : "http:"
};
bookmarklet.getParameter = function(url, name) {
  if(url) {
    var regex = new RegExp("[?&]" + name + "=([^&#]*)");
    var result = regex.exec(url);
    if(result)return result[1]
  }return null
};
bookmarklet.hasActiveElementSupport = function() {
  return typeof document.activeElement != "undefined"
};
bookmarklet.getInputTool = function(lang) {
  if(!lang) {
    return 'im_t13n_hi';
  } else if(lang=='zh'){
    return 'im_pinyin_zh_hans';
  } else if (lang.indexOf('im_')!=0 && lang.indexOf('vkd_')!=0) {
    return 'im_t13n_' + lang;
  } else {
    return lang;
  }
}
bookmarklet.getActiveField = function(opt_doc) {
  try {
    var doc = opt_doc || window.document;
    var activeElement;
    activeElement = doc.activeElement
    if(!activeElement)return null;
    if(bookmarklet.isEditableElement(activeElement)){
      return activeElement;
    }
    // The activeElement may be iframe element.
    var iframedoc = activeElement.contentDocument ||
    (activeElement.contentWindow && activeElement.contentWindow.document) ||
    activeElement.document;
    // Get the iframe inner active element.
    if (iframedoc && iframedoc.activeElement != activeElement) {
      return bookmarklet.getActiveField(iframedoc);
    }
  }catch(e){}
  return null;
};
bookmarklet.isEditableElement = function(element) {
  var elementName = element.tagName.toUpperCase();
  var iframedoc;
  return elementName == "TEXTAREA" || elementName == "INPUT" && (element.type.toUpperCase() == "TEXT" || element.type.toUpperCase() == "SEARCH")|| elementName == "DIV" && element.contentEditable.toUpperCase() == "TRUE" || elementName == "IFRAME" && (iframedoc = element.contentWindow.document) && (iframedoc.designMode.toUpperCase() == "ON" || iframedoc.body.contentEditable.toUpperCase() == "TRUE");
};
bookmarklet.contains = function(arr, element) {
  for(var i = 0;i < arr.length;i++)if(arr[i] === element)return true;
  return false;
};
bookmarklet.NAME = "t13nb";
bookmarklet.SCRIPT_BASE_URL = "http://t13n.googlecode.com/svn/trunk/blet/";
bookmarklet.CSS_BASE_URL = bookmarklet.SCRIPT_BASE_URL;
bookmarklet.IMAGE_BASE_URL = "http://t13n.googlecode.com/files/";
bookmarklet.SCRIPT_URL = bookmarklet.SCRIPT_BASE_URL + "bm.js";
bookmarklet.SCRIPT_ID = "t13ns";
bookmarklet.STATUS_ID = "t13n";
bookmarklet.MESSAGE_LOADING = "Loading Marathi Input Tools";
bookmarklet.MESSAGE_STILL_LOADING = "Still loading Marathi Input Tools";
bookmarklet.MESSAGE_LOADED = "Marathi Input Tools loaded";
bookmarklet.MESSAGE_ENABLED = "Marathi Input Tools is enabled. " + "To disable, click on the bookmarklet again";
bookmarklet.MESSAGE_DISABLED = "Marathi Input Tools has been disabled. " + "To enable, click on the bookmarklet again";
bookmarklet.MESSAGE_NOT_SUPPORTED = "Your browser is not supported. " + "Supported on Chrome 2+/Safari 4+/IE 6+/FF 3+";
bookmarklet.MESSAGE_USAGE = "Marathi Input Tools is enabled. " + "Click on any input field to start using it";bookmarklet.initialized = false;
bookmarklet.loadURL = null;
bookmarklet.lang = null;
bookmarklet.control = null;
bookmarklet.menu = null;
bookmarklet.backgroundTimerId = null;
bookmarklet.registeredElements = [];
bookmarklet.CSS_ID = "t13nCSS";
bookmarklet.CSS_URL = bookmarklet.CSS_BASE_URL + "bm.css";
bookmarklet.isInputEnabled = false;

bookmarklet.onFocus = function(e) {
  bookmarklet.menu.bindElement(this);
  bookmarklet.menu.reposition(this,
      google.elements.inputtools.PositionType.BOTTOM_RIGHT);
};

bookmarklet.initBookmarklet = function() {
  // Workaround of b/4449128, if activeElement is not supported, use onfocus
  // handler to record the active element. We don't need onblur handler because
  // activeEnabler method can endure wrong/old active element.
  if (typeof document.activeElement == 'undefined' &&
      document.addEventListener) {
    document.activeElement = null;
    document.addEventListener('focus', function(e) {
      if (e && e.target)
        document.activeElement = e.target == document ? null : e.target;
    }, true);
  }
  bookmarklet.showStatus(bookmarklet.STATUS_ID, bookmarklet.MESSAGE_LOADING);
  var t13nScript = document.getElementById(bookmarklet.SCRIPT_ID);
  if(t13nScript) {
    bookmarklet.loadURL = t13nScript.src;
    bookmarklet.lang = bookmarklet.getParameter(bookmarklet.loadURL, "l");
  }window[bookmarklet.NAME] = bookmarklet.toggle;
  if(!bookmarklet.hasActiveElementSupport()) {
    bookmarklet.showStatus(bookmarklet.STATUS_ID, bookmarklet.MESSAGE_NOT_SUPPORTED, 5000);
    return
  }
  bookmarklet.loadScript("t13nJSAPIScript", bookmarklet.getProtocol() +
    "//www.google.com/jsapi",
    "window.google && google.load", function() {
      google.load("elements", "1", {
          packages : "inputtools",
          nocss : false,
          callback : function() {
            bookmarklet.initialized = true;
            bookmarklet.showStatus(bookmarklet.STATUS_ID, bookmarklet.MESSAGE_LOADED, 5000);
            if (bookmarklet.lang)
              bookmarklet.toggle(bookmarklet.lang);
          }});
  });
  bookmarklet.loadCSS(bookmarklet.CSS_ID, bookmarklet.CSS_URL, document);
};
bookmarklet.toggle = function(opt_lang) {
  if(!bookmarklet.hasActiveElementSupport()) {
    bookmarklet.showStatus(bookmarklet.STATUS_ID, bookmarklet.MESSAGE_NOT_SUPPORTED, 5000);
    return
  }if(!bookmarklet.initialized) {
    bookmarklet.showStatus(bookmarklet.STATUS_ID, bookmarklet.MESSAGE_STILL_LOADING);
    return
  }
  if(!bookmarklet.control) {
    bookmarklet.control = new google.elements.inputtools.InputToolsController();
    bookmarklet.control.addInputTools([bookmarklet.getInputTool(opt_lang)]);
    bookmarklet.menu = bookmarklet.control.showControl({'ui': 'kd', 'isFloating':true,
      'showStatusBar': true});
  }
  bookmarklet.control.toggleCurrentInputTool();
  bookmarklet.isInputEnabled = !bookmarklet.isInputEnabled;
  if(bookmarklet.isInputEnabled) {
    // Enable timer;
    bookmarklet.backgroundTimerId = window.setInterval(bookmarklet.activeElementEnabler, 250);
  }else {
    // Disable timer;
    window.clearInterval(bookmarklet.backgroundTimerId);
    bookmarklet.backgroundTimerId = null;
  }
};
bookmarklet.activeElementEnabler = function() {
  if(!bookmarklet.isInputEnabled)return;
  var activeField = bookmarklet.getActiveField();
  if(!activeField)return;
  if(!bookmarklet.contains(bookmarklet.registeredElements, activeField)) {
    activeField.setAttribute('goog_input_bookmarklet', true);
    bookmarklet.control.addPageElements([activeField]);
    bookmarklet.menu.reposition(activeField,
      google.elements.inputtools.PositionType.BOTTOM_RIGHT)
    bookmarklet.registeredElements.push(activeField);
    if (activeField.addEventListener) {
      activeField.addEventListener('focus', bookmarklet.bind(bookmarklet.onFocus, activeField), false);
    } else {
      activeField.attachEvent('onfocus', bookmarklet.bind(bookmarklet.onFocus, activeField), false);
    }
  }
};
bookmarklet.initBookmarklet();})();
