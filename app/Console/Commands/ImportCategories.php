<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use OpenAI;

class ImportCategories extends Command
{
    protected $signature = 'import:categories';
    protected $description = 'Import categories from Excel and store embeddings';

    public function handle()
    {
        $path = storage_path('app/categories.xlsx');
        $data = Excel::toCollection(null, $path)->first();

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        foreach ($data as $row) {
            $name = $row['category'] ?? null;
            if (!$name) continue;

            $embedding = $client->embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => $name,
            ])->embeddings[0]->embedding;

            Category::create([
                'name' => $name,
                'embedding' => json_encode($embedding),
            ]);

            $this->info("Imported: {$name}");
        }
    }
}
