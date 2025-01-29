 // JavaScript to switch between two background images every 10 seconds

// Function to toggle the background image
function toggleBackground2() {
    var header = document.querySelector('.header');
    
    // Toggle the 'background-changed' class every 10 seconds
    if (header.classList.contains('background-changed2')) {
        header.classList.remove('background-changed2'); // Switch to the initial image
    } else {
        header.classList.add('background-changed2'); // Switch to the new image
    }
}

// Switch background every 10 seconds
setInterval(toggleBackground2, 10000); // 10000 milliseconds = 10 seconds