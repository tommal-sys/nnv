"use strict";

function onWindowLoad() {

    if (typeof onLoadCallback === 'function') {
        try {
            onLoadCallback();
        } catch (error) {
            console.error(error);
        }
    }
}

if (document.readyState == 'complete') {
    onWindowLoad();
} else {
    window.addEventListener('load', onWindowLoad);
}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})