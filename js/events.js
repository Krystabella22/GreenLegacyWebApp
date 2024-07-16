function toggleDetails(id) {
    var image = document.getElementById('image-' + id);
    if (image.style.display === "none") {
        image.style.display = "block";
    } else {
        image.style.display = "none";
    }
}