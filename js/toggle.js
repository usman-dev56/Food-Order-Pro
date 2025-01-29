
    // Get elements
    const hamburger = document.getElementById('hamburger');
    const menu = document.getElementById('menu');
    const openIcon = document.getElementById('open-icon');
    const closeIcon = document.getElementById('close-icon');

    // Add click event to hamburger
    hamburger.addEventListener('click', function() {
        // Toggle the 'active' class on the menu
        menu.classList.toggle('active'); 

        // Toggle the display of the open and close icons
        if (menu.classList.contains('active')) {
            openIcon.style.display = 'none'; // Hide the hamburger icon
            closeIcon.style.display = 'block'; // Show the close icon
            document.body.style.overflow = 'hidden'; // Disable page scroll when menu is open
        } else {
            openIcon.style.display = 'block'; // Show the hamburger icon
            closeIcon.style.display = 'none'; // Hide the close icon
            document.body.style.overflow = 'auto'; // Enable page scroll when menu is closed
        }
    });
