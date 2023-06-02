/*loader*/
document.addEventListener("DOMContentLoaded", function() {
    var loaderOverlay = document.getElementById("loader-overlay");
    var body = document.body;

    // Add "loaded" class to body after a short delay
    setTimeout(function() {
        body.classList.add("loaded");
    }, 1800);
});









document.addEventListener("DOMContentLoaded", function() {
    var items = document.querySelectorAll(".section");
    items.forEach(function(section) {
        item.style.animationDelay = (Math.random() * 2) + "s"; // Random delay for each item
    });
});

var modeToggle = document.getElementById("mode-toggle");
var body = document.body;

// Check if a mode is already stored in local storage
var storedMode = localStorage.getItem("mode");
if (storedMode) {
    // Apply the stored mode to the body
    body.classList.add(storedMode);
}

modeToggle.addEventListener("change", function() {
    if (body.classList.contains("dark-mode")) {
        // Remove the dark mode and store the mode in local storage
        body.classList.remove("dark-mode");
        localStorage.setItem("mode", "");
    } else {
        // Apply the dark mode and store the mode in local storage
        body.classList.add("dark-mode");
        localStorage.setItem("mode", "dark-mode");
    }
});

