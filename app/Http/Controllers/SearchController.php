<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use OpenAI;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if ($query) {
            $client = OpenAI::client(env('OPENAI_API_KEY'));
            $queryEmbedding = $client->embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => $query,
            ])->embeddings[0]->embedding;

            $categories = Category::all();

            $similarities = $categories->map(function ($category) use ($queryEmbedding) {
                $score = $this->cosineSimilarity(
                    $queryEmbedding,
                    json_decode($category->embedding)
                );
                return [
                    'name' => $category->name,
                    'score' => $score,
                ];
            })->sortByDesc('score')->take(5)->values();

            $results = $similarities;
        }

        return view('search', compact('results', 'query'));
    }

    protected function cosineSimilarity($vecA, $vecB)
    {
        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;
        foreach ($vecA as $i => $val) {
            $dot += $val * $vecB[$i];
            $normA += $val ** 2;
            $normB += $vecB[$i] ** 2;
        }

        return $normA && $normB ? $dot / (sqrt($normA) * sqrt($normB)) : 0;
    }
}
