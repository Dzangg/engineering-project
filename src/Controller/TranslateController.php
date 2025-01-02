<?php

namespace App\Controller;

use OpenAI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TranslateController extends AbstractController
{
    #[Route('/api/translate', name: 'app_translate')]
    public function index(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $language = $requestData['language'];
        $gestures = $requestData['gestures'];
        $gesturesString = implode(', ', $gestures);

        $yourApiKey = $_ENV['OPENAI_API_KEY'];
        $client = OpenAI::client($yourApiKey);
        $prompt = "Create a logical sentence in the $language language using only the following gestures: $gesturesString. 
        Add additional words only if necessary to make the sentence logical and grammatically correct.";

        $result = $client->chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant specialized in generating sentences from gesture labels.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $translatedText = $result['choices'][0]['message']['content'];

        return new JsonResponse([
            'translatedText' => $translatedText,
            'status' => Response::HTTP_OK,
        ]);
    }
}
