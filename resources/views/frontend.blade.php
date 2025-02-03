<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NFC Scanner</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6dd5ed, #2193b0); /* Gradient background */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #ffffff;
            text-align: center;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        #scan-button {
            padding: 12px 24px;
            font-size: 1.2rem;
            background-color: #ff7f50;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #scan-button:hover {
            background-color: #e56744;
            transform: scale(1.05);
        }

        #result {
            margin-top: 20px;
            font-size: 1.1rem;
            color: #f8f9fa;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .button-group {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .action-button {
            padding: 12px 24px;
            font-size: 1.1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            color: #ffffff;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .action-button.fine {
            background-color: #28a745;
            box-shadow: 0 4px 10px rgba(0, 128, 0, 0.4);
        }

        .action-button.fine:hover {
            background-color: #218838;
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 128, 0, 0.5);
        }

        .action-button.cancel {
            background-color: #dc3545;
            box-shadow: 0 4px 10px rgba(128, 0, 0, 0.4);
        }

        .action-button.cancel:hover {
            background-color: #c82333;
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(128, 0, 0, 0.5);
        }

        /* Media Query for Mobile */
        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
            }

            #scan-button, .action-button {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <h1>Scan NFC Tag</h1>
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

        scanButton.addEventListener('click', async () => {
            try {
                const ndef = new NDEFReader();
                await ndef.scan();

                ndef.onreading = async (event) => {
                    const decoder = new TextDecoder();
                    let nfcData = decoder.decode(event.message.records[0].data);

                    const [studentMatricNum, stickerId] = nfcData.split(',');
                    const cleanMatricNum = studentMatricNum.trim();
                    const cleanStickerId = stickerId.trim();

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const response = await fetch('/scan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            student_matricNum: cleanMatricNum,
                            sticker_id: cleanStickerId,
                        }),
                    });

                    const data = await response.json();

                    if (response.ok) {
                        resultDiv.textContent = data.message || 'NFC data scanned successfully!';

                        if (data.fine_required) {
                            fineButton.disabled = false;
                            fineButton.dataset.url = `/fines/create?student_matricNum=${encodeURIComponent(data.data.student_matricNum)}&sticker_id=${encodeURIComponent(data.data.sticker_id)}`;
                        } else {
                            fineButton.disabled = true;
                        }
                    } else {
                        resultDiv.textContent = data.message || 'An error occurred during scanning.';
                    }
                };
            } catch (error) {
                resultDiv.textContent = 'Error during NFC scan.';
                console.error('Error during NFC scan:', error);
            }
        });

        fineButton.addEventListener('click', () => {
            if (fineButton.dataset.url) {
                window.location.href = fineButton.dataset.url;
            }
        });

        cancelButton.addEventListener('click', () => {
            window.location.href = '/police/dashboard'; // Replace with the desired cancel redirection URL
        });
    </script>
</body>
</html>


