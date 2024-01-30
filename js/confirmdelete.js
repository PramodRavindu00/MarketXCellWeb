
document.addEventListener('DOMContentLoaded', function() {
    var deleteLinks = document.querySelectorAll('.deleteLink');

    deleteLinks.forEach(function(deleteLink) {
        deleteLink.addEventListener('click', function(event) {
            event.preventDefault();

            var href = this.getAttribute('href');

            swal({
                title: "Are you sure you want to delete?",
                text: "Deleted data can never be recovered",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(function(isOkay) {
                if (isOkay) {
                    window.location.href = href;
                } else {
                    
                }
            });
        });
    });
});