document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("signupForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const role = document.getElementById("role").value;

        const formData = new FormData();
        formData.append("name", name);
        formData.append("email", email);
        formData.append("password", password);
        formData.append("role", role);

        try {
            let response = await fetch("/register", {
                method: "POST",
                body: formData
            });

            let data = await response.json();

            if (data.success) {
                alert("Signup successful!");
                window.location.href = "/signin";
            } else {
                alert("Error: " + data.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong!");
        }
    });
});
