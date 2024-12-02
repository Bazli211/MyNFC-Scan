<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NFCController extends Controller
{
    public function store(Request $request)
    {
        // Assume we're receiving JSON data with the NFC tag information
        $nfcData = $request->input('nfc_data');

        // Process the NFC data (e.g., save it to the database, log it, etc.)
        // For simplicity, we'll just return the data in the response
        return response()->json([
            'message' => 'NFC data received successfully!',
            'data' => $nfcData
        ]);
    }
}
