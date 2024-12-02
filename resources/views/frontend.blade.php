<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFC Scanner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #343a40;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        #scan-button {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #scan-button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 15px;
            font-size: 1rem;
            color: #212529;
            text-align: center;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .action-button {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-button.fine {
            background-color: #28a745;
            color: white;
        }

        .action-button.fine:hover {
            background-color: #218838;
        }

        .action-button.cancel {
            background-color: #dc3545;
            color: white;
        }

        .action-button.cancel:hover {
            background-color: #c82333;
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }

            #scan-button, .action-button {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <h1>NFC Scanner</h1>
    <button id="scan-button">Scan NFC Tag</button>
    <div id="result"></div>
    
    <div class="button-group">
        <button id="fine-button" class="action-button fine" disabled>Fine</button>
        <button id="cancel-button" class="action-button cancel">Cancel</button>
    </div>

    <script>
        const scanButton = document.getElementById('scan-button');
        const fineButton = document.getElementById('fine-button');
        const cancelButton = document.getElementById('cancel-button');
        const resultDiv = document.getElementById('result');

        let nfcData = null;

        scanButton.addEventListener('click', async () => {
            try {
                const ndef = new NDEFReader();
                await ndef.scan();

                ndef.onreading = async event => {
                    const message = event.message;
                    nfcData = '';

                    for (const record of message.records) {
                        nfcData += record.data;
                    }

                    // Send the NFC data to the backend
                    const response = await fetch('/scan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ nfc_data: nfcData })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        // Enable the Fine button and attach the fine URL
                        fineButton.disabled = false;
                        fineButton.dataset.url = `/fines/create?student_matricNum=${encodeURIComponent(data.data.student_matricNum)}&sticker_id=${encodeURIComponent(data.data.sticker_id)}`;
                        resultDiv.textContent = 'NFC data scanned successfully!';
                    } else {
                        resultDiv.textContent = data.message;
                    }
                };
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        });

        fineButton.addEventListener('click', () => {
            if (fineButton.dataset.url) {
                window.location.href = fineButton.dataset.url;
            }
        });

        cancelButton.addEventListener('click', () => {
            window.location.href = '/dashboard'; // Replace with the desired cancel redirection URL
        });
    </script>
</body>
</html>

