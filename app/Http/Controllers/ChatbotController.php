<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private const SYSTEM_PROMPT = <<<'PROMPT'
Tu es l'assistant de l'application « Avances en Devises PN » de Tunisair.
Tu réponds toujours en français, de façon courte, claire et professionnelle.

Contexte de l'application :
- Gestion mensuelle des avances en devises du personnel navigant (PNT et PNC).
- Données consolidées : DCOA (PNT/PNC), DCSP (déficits de caisse), DGF (taux de change).
- Trois bases : TUN, DJE, MIR.
- L'application génère les fichiers d'avances en TND et le bon de paiement.

Règles de calcul :
- Un déficit de caisse est déduit uniquement s'il est un multiple de 5.
- PNT : avance plafonnée à 250 EUR. PNC : montant complet.
- Les montants sont convertis en TND avec le taux de change saisi par la DGF.

Rôles : DCOA importe ses fichiers, DCSP importe les déficits, DGF saisit les taux, l'administrateur importe, calcule les avances et génère le bon de paiement.

Si une question sort de ce périmètre ou si tu ne connais pas la réponse, dis-le et invite l'utilisateur à contacter l'administrateur. N'invente jamais de chiffres.
PROMPT;

    public function ask(Request $request): JsonResponse
    {
        $data = $request->validate([
            'messages' => ['required', 'array', 'min:1', 'max:20'],
            'messages.*.role' => ['required', 'in:user,assistant'],
            'messages.*.content' => ['required', 'string', 'max:2000'],
        ]);

        $apiKey = config('services.anthropic.key');
        if (! $apiKey) {
            return response()->json(['reply' => "Le chatbot n'est pas configuré."], 500);
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
            ])->timeout(30)->post('https://api.anthropic.com/v1/messages', [
                'model' => config('services.anthropic.model'),
                'max_tokens' => 600,
                'system' => self::SYSTEM_PROMPT,
                'messages' => $data['messages'],
            ]);

            if ($response->failed()) {
                Log::error('Chatbot API error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['reply' => 'Service momentanément indisponible.'], 502);
            }

            $reply = $response->json('content.0.text', 'Aucune réponse.');

            return response()->json(['reply' => $reply]);
        } catch (\Throwable $e) {
            Log::error('Chatbot exception', ['message' => $e->getMessage()]);
            return response()->json(['reply' => 'Une erreur est survenue.'], 500);
        }
    }
}