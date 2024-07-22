<<<<<<< HEAD
function toggleDetails(id) {
    var image = document.getElementById('image-' + id);
    if (image.style.display === "none") {
        image.style.display = "block";
    } else {
        image.style.display = "none";
    }
}
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
        main.style.marginLeft = '0';
    } else {
        sidebar.style.width = '250px';
        main.style.marginLeft = '250px';
    }
}
=======
function toggleDetails(id) {
    var image = document.getElementById('image-' + id);
    if (image.style.display === "none") {
        image.style.display = "block";
    } else {
        image.style.display = "none";
    }
}
>>>>>>> 039097d0beb5d307abd0b8c3780644f93e7e2927
