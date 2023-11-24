

function searchProducts() {
    var query = document.getElementById('search').value;
    console.log(query);

    $.ajax({
        url: 'search',
        type: 'GET',
        data: { query: query },
        success: function(html) {
            $('#search-results').html(html);
        }
    });
}

var myTextBox = document.getElementById('search');
myTextBox.addEventListener('input', function(){
    searchProducts();
});