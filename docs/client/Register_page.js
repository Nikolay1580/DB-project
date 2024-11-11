document.getElementById("registerForm").addEventListener("submit", async function (event) {
    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Validate that username and password do not exceed 25 characters
    if (username.length > 25 || password.length > 25) {
        alert("Username and password must be 25 characters or fewer.");
        return;
    }

    // Create a JSON object for registration data
    const registerData = {
        type: "register",
        username: username,
        password: password
    };

    try {
        const response = await fetch("http://5.75.182.107/~tlachezarov/docs/server/auth.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(registerData),
        });
        const result = await response.json();

        if (result.status === "success") {
            window.alert("Register Successful");
        } else {
            window.alert("Login Failled");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred while processing your registration request.");
    }
});