// ajax on comments search on form select of userSelect and recipeSelect
function searchComments() {
    var userSelect = document.getElementById('userSelect').value;
    var recipeSelect = document.getElementById('recipeSelect').value;
    $.ajax({
        url: 'searchComments',
        type: 'GET',
        data: {userSelect: userSelect, recipeSelect: recipeSelect},
        success: function (html) {
            $('#search-results').html(html);
        }
    });
}

var userSelect = document.getElementById('userSelect');
userSelect.addEventListener('change', function () {
    searchComments();
});

var recipeSelect = document.getElementById('recipeSelect');
recipeSelect.addEventListener('change', function () {

    searchComments();
});

document.getElementById('userSelect').addEventListener('change', function () {
    searchComments();
});
document.getElementById('recipeSelect').addEventListener('change', function () {
    searchComments();
});





