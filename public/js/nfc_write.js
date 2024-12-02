document.addEventListener('DOMContentLoaded', () => {
    const writeNFCButton = document.getElementById('writeNFC');
    const statusDiv = document.getElementById('status');

    writeNFCButton.addEventListener('click', async () => {
        const studentMatricNum = document.getElementById('student_matricNum').value.trim();
        const stickerDate = document.getElementById('sticker_date').value.trim();
        const roadTaxDate = document.getElementById('roadtax_date').value.trim();

        // Validate input fields
        if (!studentMatricNum || !stickerDate || !roadTaxDate) {
            alert('Please fill in all fields.');
            return;
        }

        if (!('ndef' in navigator)) {
            alert('Web NFC is not supported on this device or browser.');
            return;
        }

        try {
            // Start the writing process
            const writer = await navigator.ndef.write();
            await writer.write([
                {
                    type: 'text/plain',
                    data: `StudentMatricNum: ${studentMatricNum}`
                },
                {
                    type: 'text/plain',
                    data: `StickerDate: ${stickerDate}`
                },
                {
                    type: 'text/plain',
                    data: `RoadTaxDate: ${roadTaxDate}`
                }
            ]);

            statusDiv.style.display = 'block';
            statusDiv.textContent = 'NFC tag written successfully!';
            statusDiv.classList.remove('alert-danger');
            statusDiv.classList.add('alert-success');
        } catch (error) {
            console.error('Error writing to NFC tag:', error);

            statusDiv.style.display = 'block';
            statusDiv.textContent = 'Failed to write to the NFC tag. Ensure the tag is near your device and writable.';
            statusDiv.classList.remove('alert-success');
            statusDiv.classList.add('alert-danger');
        }
    });
});
