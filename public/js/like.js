function like(id, session) {
    if (!session) {
        redirect = document.location.href.split('/').pop()
        document.cookie = "redirect=" + redirect;
        window.location.href = "login";
    }
    executelike(id)

    event.preventDefault();
    id ='likeButton_' + id;
    document.getElementById(id).classList.toggle('liked');
}

function executelike(id) {

    $.ajax({
        url: 'saveRecipe',
        type: 'GET',
        data: { query: id },
        success: function(data) {
            console.log(data)
            console.log('gelukt!!')
        }
    });
}