<!DOCTYPE html>
<html>
<head>
    <title>Speech to Text</title>
</head>
<body>
    <form id="speechForm">
        <input type="text" id="textInput" name="text" placeholder="Speak here...">
        <button type="button" id="startButton">Start Speech</button>
    </form>

    <script>
        const startButton = document.getElementById('startButton');
        const textInput = document.getElementById('textInput');

        startButton.addEventListener('click', () => {
            const recognition = new webkitSpeechRecognition(); // Create a speech recognition object
            recognition.lang = 'en-US'; // Set the language for recognition
            recognition.start(); // Start speech recognition

            recognition.onresult = (event) => {
                const result = event.results[0][0].transcript;
                textInput.value = result; // Populate the text input with the recognized speech
            };

            recognition.onend = () => {
                recognition.stop(); // Stop recognition after speech ends
            };
        });
    </script>
</body>
</html>
