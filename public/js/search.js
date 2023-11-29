function searchProducts() {
    var query = document.getElementById('search').value;
    var sortby = document.getElementById('sortby').value;
    var category = document.getElementById('categoryFilter').value;

    if(document.location.href.split('/').pop() !== 'recipes') {
        document.cookie = "search =" + query;
        window.location.href = 'recipes';
    }else {
        document.cookie = "search=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
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
myTextBox.addEventListener('input', function(){
    searchProducts();
});

document.getElementById('sortby').addEventListener('change', function () {
    searchProducts();
});
