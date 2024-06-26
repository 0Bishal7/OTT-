async function uploadFile() {
    const form = document.getElementById('uploadForm');
    const directory = document.getElementById('directory').value;
    const fileInput = document.getElementById('filename');
    const file = fileInput.files[0];

    if (!file) {
        alert('Please select a file to upload.');
        return;
    }

    const formData = new FormData();
    formData.append('directory', directory);
    formData.append('filename', file);

    try {
        const response = await fetch('https://nodejsapi.architecture.care/uploadfiles/upload', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            const result = await response.json();
            console.log('File uploaded successfully:', result);
            alert('File uploaded successfully!');
        } else {
            console.error('Error uploading file:', response.statusText);
            alert('Error uploading file.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while uploading the file.');
    }
}
