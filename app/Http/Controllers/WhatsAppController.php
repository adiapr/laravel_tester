<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
     protected $wa;

    public function __construct(WhatsAppService $wa)
    {
        $this->wa = $wa;
    }

    /**
     * GET /wa/test?to=628xxx
     * Mengirim template hello_world ke nomor tujuan (test).
     */
    public function testMessage(Request $req)
    {
        $to = $req->query('to');

        if (!$to) {
            return response()->json(['error' => 'Parameter "to" required (E.164 without +, ex: 6281...)'], 422);
        }

        // Pastikan nomor sudah diverifikasi jika masih dalam dev mode
        // Template default: hello_world — biasanya tersedia di sandbox
        $res = $this->wa->sendTemplate($to, 'hello_world', 'en_US');

        return response()->json($res);
    }

    /**
     * POST /wa/send-text
     * Body JSON: { "to": "628xxx", "text": "Halo dari Laravel" }
     */
    public function sendText(Request $req)
    {
        $req->validate([
            'to' => 'required|string',
            'text' => 'required|string'
        ]);

        $res = $this->wa->sendText($req->to, $req->text);

        return response()->json($res);
    }
}
