// Toggle chatbot visibility
function toggleChatbot() {
    const chatbot = document.getElementById("chatbot");
    chatbot.style.display = chatbot.style.display === "none" ? "block" : "none";
}

// Send message on pressing enter or clicking send
function sendMessage(event) {
    if (event.key === "Enter") {
        submitMessage();
    }
}

function submitMessage() {
    const userMessage = document.getElementById("userMessage").value;
    if (userMessage.trim() === "") return;

    // Display user message
    displayMessage(userMessage, "user");

    // Send the message to the server
    fetch("chatbot.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "message=" + encodeURIComponent(userMessage)
    })
    .then(response => response.text())
    .then(data => displayMessage(data, "bot"))
    .catch(error => displayMessage("Error: " + error, "bot"));

    // Clear input field
    document.getElementById("userMessage").value = "";
}

function displayMessage(message, sender) {
    const messagesContainer = document.getElementById("chatbot-messages");
    const messageElement = document.createElement("div");
    messageElement.className = sender === "user" ? "user-message" : "bot-message";
    messageElement.textContent = message;
    messagesContainer.appendChild(messageElement);
    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Auto-scroll to bottom
}
