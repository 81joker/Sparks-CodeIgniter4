
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const wrapper = document.querySelector('.wrapper');
    
    function toggleSidebar() {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('active');
        } else {
            wrapper.classList.toggle('sidebar-collapsed');
        }
    }
    
    // Toggle sidebar on button click
    sidebarToggle.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent event bubbling
        toggleSidebar();
    });
    
    // Close sidebar when clicking outside on mobile
    sidebarOverlay.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('active');
        }
    });
    
    // Close sidebar when clicking on nav items (optional)
    document.querySelectorAll('.sidebar .nav-link').forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('active');
            }
        });
    });
    
    // Auto-close sidebar when resizing to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('active');
            wrapper.classList.remove('sidebar-collapsed');
        }
    });


    setTimeout(function () {
        const flash = document.getElementById('flash-message');
        if (flash) {
            flash.classList.remove('show'); 
            flash.classList.add('fade'); 
            flash.style.opacity = 0;
        }
    }, 3000);

    // Spinner 
    document.getElementById('searchInput').addEventListener('input', function () {
        document.getElementById('loadingSpinner').classList.remove('d-none');
    });
    
    
});

// Hide spinner after 1 second
const minDelay = 1000; 
const startTime = Date.now();

window.addEventListener('load', function() {
  const elapsedTime = Date.now() - startTime;
  const remainingDelay = Math.max(minDelay - elapsedTime, 0);

  setTimeout(() => {
    // Hide all spinners
    [1,2,3,4,5,6,7].forEach(n => {
      const spinner = document.getElementById(`loadingSpinner${n || ''}`);
      if(spinner) spinner.classList.add('d-none');
    });
    
    // Also hide the main spinner (if different from the numbered ones)
    const mainSpinner = document.getElementById('loadingSpinner');
    if(mainSpinner) mainSpinner.classList.add('d-none');
  }, remainingDelay);
});