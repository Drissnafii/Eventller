document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("loginForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        const formData = new FormData();
        formData.append("email", email);
        formData.append("password", password);

        try {
            let response = await fetch("/login", {
                method: "POST",
                body: formData
            });
        
            let data = await response.json();
            console.log("Response:", data);
        
            if (data.success) {
                alert("Login successful!");
                window.location.href = "/dashboard";
            } else {
                alert("Error: " + data.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Something went wrong! : " + error);
        }
        
    });
});
