function searchProducts() {
    var query = document.getElementById('search').value;
    var url = document.location.href.split('/').pop().split('?')[0];
    if (url !== 'recipes') {
        document.cookie = "search=" + query + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        window.location.href = 'recipes';
    }else {
        var sortby = document.getElementById('sortby').value;
        var category = document.getElementById('categoryFilter').value;
        $.ajax({
            url: 'search',
            type: 'GET',
            data: {query: query, sortby, category},
            success: function (html) {
                $('#search-results').html(html);
            }
        });
    }
}

var myTextBox = document.getElementById('search');
myTextBox.addEventListener('keyup', function (e) {
    if (e.keyCode === 13) {
        searchProducts();
    }
});

document.getElementById('sortby').addEventListener('change', function () {
    searchProducts();
});

document.getElementById('categoryFilter').addEventListener('change', function () {
    searchProducts();
});