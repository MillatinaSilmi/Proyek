document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-btn');
    const menuBtn = document.getElementById('menu-btn');
    const submenus = document.querySelectorAll('.has-submenu');

    // Buka/Tutup Sidebar
    toggleBtn.addEventListener('click', function () {
        sidebar.classList.add('closed');
    });

    menuBtn.addEventListener('click', function () {
        sidebar.classList.remove('closed');
    });

    // Buka/Tutup Submenu
    submenus.forEach(function (menu) {
        const link = menu.querySelector('.menu-link');
        const submenu = menu.querySelector('.submenu');

        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Tutup semua submenu yang lain
            submenus.forEach(function (item) {
                if (item !== menu) {
                    item.querySelector('.submenu').style.display = 'none';
                }
            });

            // Toggle submenu
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    });
});
