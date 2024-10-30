// This is so that the user can chose to begin the form and is not overwhelmed by questions
// once the user agrees to start the form, the form is shown and the intro text hidden
function showForm() {
    const nextButton = document.getElementById("next-button");
    const beforeForm = document.getElementById("before-form");
    const beforeFormText = document.getElementById("before-form-text");
    const inputForm = document.getElementById('input-form');

    if (nextButton) nextButton.style.display = 'none';
    if (beforeForm) beforeForm.style.display = 'none';
    if (beforeFormText) beforeFormText.style.display = 'none';
    if (inputForm) inputForm.style.display = 'block';
}

// This is an event listent that gets the id of the form and all of the sliders
// in it and then accordingly changes their color based on how left-right they are
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('input-form');

    const rangeInputs = form.querySelectorAll('input[type="range"]');
    rangeInputs.forEach(slider => {
        slider.addEventListener('input', () => {
            const value = (slider.value - slider.min) / (slider.max - slider.min);
            const red = 247;  // Red component of 0xf7bf01
            const green = Math.floor(191 * value);  // Green component of 0xf7bf01 scaled by value
            const blue = 1;  // Blue component of 0xf7bf01

            // Update the slider thumb color
            slider.style.setProperty('--thumb-color', `rgb(${red}, ${green}, ${blue})`);
        });
    });
});

// We see if the amount of unmodofoed sliders is equal to the total amount of sliders
// then we return an error message, otherwise we convert the data to a JSON object and
// send it to the server. And we allert if its a success or fail in the future it will return]
// the best block and its qualities but for now this will do
function submitForm() {
    let input_data = {};
    let total = 0;
    let unmodifiedSliders = 0;
    const form = document.getElementById('input-form');
    const inputs = form.querySelectorAll('input[type="range"]');

    inputs.forEach(input => {
        const value = parseInt(input.value);

        if (value === parseInt(input.defaultValue)) {
            unmodifiedSliders++;
        }

        input_data[input.name] = value;
        total++;
    });

    if (total === unmodifiedSliders) {
        window.alert("if you have no preference, why are you here?");
        return;
    }

    // To show that the data corresponds to user input (for gradings)
    console.log(input_data);

    getDataFromBackend(input_data);
    const data = [
        { college: 'College A', block: 'A' },
        { college: 'College B', block: 'B' },
        { college: 'College C', block: 'C' }
    ];
}

/**
 * @param {Object} input_data - JSON object containing the user's input data
 * connetcs to the server via http, send the json as a string
 * the server than decodes it and for now just sends a success or fail JSON 
 * object back. This is done asynchronously. Then the user get notified if the
 * data was sent and recieved successfully. In the futture the server will
 * send an HTML page back with the best block http://localhost:3000/docs/back_end.php
 */
async function getDataFromBackend(input_data) {
    try {
        const response = await fetch('http://localhost:3000/docs/back_end.php/api/data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(input_data),
        });

        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            if (data.status === 'success') {
                window.alert("Submission successful: " + data.message);

                localStorage.setItem('result_data', JSON.stringify(data));
                window.location.href = "./output.html";
            } else {
                window.alert("Submission failed: " + data.message);
            }
        } else {
            throw new Error('Response was not JSON');
        }
    } catch (error) {
        console.error('Error:', error);
        window.alert("An error occurred while sending data to the server");
    }
}