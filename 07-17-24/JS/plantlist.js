document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('successModal'); // Define modal here
    var span = document.getElementsByClassName('close')[0];

    // Display the modal function
    function showModal(message) {
        document.getElementById('modal-message').textContent = message;
        modal.style.display = "block";
    }

    // Close the modal when the user clicks on <span> (x)
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Handle form submissions with AJAX
    function handleFormSubmission(form, messageType) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showModal(`${messageType} ${data.message}`);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    var planningForms = document.querySelectorAll('.planning-form');
    var growingForms = document.querySelectorAll('.growing-form');

    planningForms.forEach(function (form) {
        handleFormSubmission(form, 'Added to Planning!');
    });

    growingForms.forEach(function (form) {
        handleFormSubmission(form, 'Added to Growing!');
    });
});
