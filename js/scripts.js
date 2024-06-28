$(document).ready(function() {
    $('#customer-form').on('submit', function(event) {
        var email = $('#email').val();
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        
        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
        }
    });
});
