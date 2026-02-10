<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $phoneNumberId;
    protected $version;
    protected $baseUrl;

    public function __construct()
    {
        $this->token = config('services.whatsapp.token', env('WHATSAPP_TOKEN'));
        $this->phoneNumberId = config('services.whatsapp.phone_number_id', env('WHATSAPP_PHONE_NUMBER_ID'));
        $this->version = env('WHATSAPP_API_VERSION', 'v22.0');
        $this->baseUrl = "https://graph.facebook.com/{$this->version}/{$this->phoneNumberId}/messages";
    }

    /**
     * Send template message (recommended for broadcast/testing in dev mode)
     *
     * @param string $to E.164 without plus (eg: 6281234567890)
     * @param string $templateName template name approved in WhatsApp Manager
     * @param string $language e.g. en_US or id_ID
     * @param array $components optional template components (header/body/...)
     * @return array
     */
    public function sendTemplate(string $to, string $templateName = 'hello_world', string $language = 'en_US', array $components = [])
    {
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => $templateName,
                'language' => ['code' => $language],
            ],
        ];

        if (!empty($components)) {
            $payload['template']['components'] = $components;
        }

        return $this->post($payload);
    }

    /**
     * Send a simple text message (works if allowed by API state - safer to use templates)
     */
    public function sendText(string $to, string $text)
    {
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'text',
            'text' => [
                'body' => $text
            ]
        ];

        return $this->post($payload);
    }

    protected function post(array $payload)
    {
        if (empty($this->token) || empty($this->phoneNumberId)) {
            Log::error('WhatsAppService: missing token or phone number id');
            return [
                'success' => false,
                'message' => 'Missing configuration (WHATSAPP_TOKEN or WHATSAPP_PHONE_NUMBER_ID).'
            ];
        }

        $response = Http::withToken($this->token)
                        ->acceptJson()
                        ->post($this->baseUrl, $payload);

        if ($response->successful()) {
            return [
                'success' => true,
                'status' => $response->status(),
                'body' => $response->json()
            ];
        }

        Log::error('WhatsApp API error', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        return [
            'success' => false,
            'status' => $response->status(),
            'body' => $response->json() ?? $response->body()
        ];
    }
}
