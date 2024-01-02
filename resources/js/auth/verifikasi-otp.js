// Get all input elements
const inputs = document.querySelectorAll('#otp-container input');

const form = document.querySelector('form');
form.addEventListener('submit', function (e) {
    e.preventDefault();
    let otpValue = '';
    form.querySelectorAll('input[type="text"]').forEach(function (input) {
        otpValue += input.value;
    });

    // Set the combined value to the hidden field
    document.getElementById('otp_combined').value = otpValue;
    form.submit();
});

// Add event listener to each input
inputs.forEach((input, index) => {
    input.addEventListener('keyup', (e) => {
        // Check if the input is not empty and there is a next input
        if (input.value && index < inputs.length - 1) {
            // Move focus to the next input
            inputs[index + 1].focus();
        }
        // If backspace is pressed and input is empty, move to previous input
        if (e.key === "Backspace" && index > 0 && input.value === '') {
            inputs[index - 1].focus();
        }
    });
});
