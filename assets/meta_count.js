(function (win, doc) {
  
  eugene = win.eugene || {}
  eugene.seo = {
    charCountHandler: function(target) {
      let isTwig = false;
      $target = $(target);
      let $helpBlock = $target.next('.help-block');
      if(/\{%.*\%}/.test($target.val()) || /\{{.*\}}/.test($target.val())) {
        isTwig = true;
      }
      let count = isTwig ? 'unrechable' : $target.val().length;
      
      let min = $target.data('min');
      let max = $target.data('max');
      
      if(isTwig) {
          $helpBlock.html(`<b>${count}</b>`);
      } else {
          $helpBlock.html(`Количество символов: <b>${count}</b> | рекомендуется: ${min} - ${max}`);
      }
      
      let $number = $helpBlock.find('b');

      if (count < max && count > min) {
        $number.css({color:'green'})
      } else if (isTwig) {
        $number.css({color: 'orange'})
      } else {
        $number.css({color: 'red'})
      }
    }
  } 
    
    
  var listeners = [], 
    doc = win.document, 
    MutationObserver = win.MutationObserver || win.WebKitMutationObserver,
    observer;
  
  function ready(selector, fn) {
    // Store the selector and callback to be monitored
    listeners.push({
          selector: selector,
          fn: fn
      });
      if (!observer) {
          // Watch for changes in the document
          observer = new MutationObserver(check);
          observer.observe(doc.documentElement, {
              childList: true,
              subtree: true
          });
        }
      // Check if the element is currently in the DOM
      check();
  }
  
  function check() {
    // Check the DOM for elements matching a stored selector
    for (var i = 0, len = listeners.length, listener, elements; i < len; i++) {
      listener = listeners[i];
        // Query for elements matching the specified selector
        elements = doc.querySelectorAll(listener.selector);
        for (var j = 0, jLen = elements.length, element; j < jLen; j++) {
            element = elements[j];
            // Make sure the callback isn't invoked with the 
            // same element more than once
            if (!element.ready) {
                element.ready = true;
                // Invoke the callback with the element
                listener.fn.call(element, element);
            }
        }
    }
  }

  // Expose stuff
  win.ready = ready;
  win.eugene = eugene;
      
  // execute listeners
  win.ready('[data-counter]', (el) => {
    eugene.seo.charCountHandler(el);
    el.oninput = event => eugene.seo.charCountHandler(el);
  });

})(window, document);
    