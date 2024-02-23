document.getElementById('searchBtn').addEventListener('click', function() {
    var searchInput = document.getElementById('searchInput');
    searchInput.style.width = '500px';
    searchInput.style.opacity = '1';
    searchInput.style.visibility = 'visible';
    searchInput.focus();
});

document.getElementById('searchInput').addEventListener('blur', function(event) {
    var searchInput = event.target;
    if (!searchInput.value) {
        searchInput.style.width = '0';
        searchInput.style.opacity = '0';
        searchInput.style.visibility = 'hidden';
    }
});
