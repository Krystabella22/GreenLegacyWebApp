document.getElementById('menu-btn').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    var mainContent = document.querySelector('.main-content');
    sidebar.classList.toggle('hidden');
    mainContent.classList.toggle('expanded');
});
