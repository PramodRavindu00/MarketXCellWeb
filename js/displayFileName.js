function displayFileName() {
    const fileInput = document.getElementById('file');
    const fileNameDisplay = document.getElementById('fileNameDisplay');

    if (fileInput.files.length > 0) {
        // Display the selected file name
        fileNameDisplay.textContent = fileInput.files[0].name;
    } else {
        // No file selected
        fileNameDisplay.textContent = 'Upload File';
    }
}