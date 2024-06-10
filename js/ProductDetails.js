document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.thumbnail').forEach(item => {
        item.addEventListener('click', event => {
            document.getElementById('main-image').src = event.target.src;
        });
    });
});