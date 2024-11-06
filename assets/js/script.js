
const confirmationMessage = document.getElementById('confirmationMessage');
        if (confirmationMessage) {
            console.log(confirmationMessage);
            // Set a timeout to hide the message after 5 seconds (5000 milliseconds)
            setTimeout(() => {
                confirmationMessage.style.display = 'none'; // Hide the message
            }, 3000); // Adjust the time as needed
        }