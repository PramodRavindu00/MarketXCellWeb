
document.addEventListener('DOMContentLoaded', function() {
    var deleteLinks = document.querySelectorAll('.updateLink');

    deleteLinks.forEach(function(deleteLink) {
        deleteLink.addEventListener('click', function(event) {
            event.preventDefault();

            var href = this.getAttribute('href');

            swal({
                title: "Are you sure you want to update order status?",
                text: "You are going to update the order status",
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