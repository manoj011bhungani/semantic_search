# 🧠 Laravel Semantic Search with OpenAI Embeddings

This Laravel web application allows users to perform **semantic searches** using natural language input. It uses the **OpenAI Embedding API** to convert text into vectors and find the most similar category based on vector similarity.

---

## 🚀 Features

- ✅ Import categories from an Excel file
- ✅ Convert each category into a vector using OpenAI
- ✅ Perform semantic search from a plain English query
- ✅ Cosine similarity matching
- ✅ Blade-based search UI with results
- ✅ Clean Laravel structure using Artisan, Migrations, and Controllers

---

## 📂 Project Setup

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/laravel-semantic-search.git


laravel new semantic-search
cd semantic-search
composer require maatwebsite/excel
composer require openai-php/client
cp .env.example .env
php artisan key:generate

```ENV

DB_DATABASE=semantic_search
DB_USERNAME=root
DB_PASSWORD=your_password

OPENAI_API_KEY=your_openai_api_key

php artisan make:model Category -m
php artisan migrate
php artisan make:command ImportCategories

Make sure your file categories.xlsx is placed in storage/app.
php artisan make:controller SearchController

php artisan serve
php artisan import:categories
Visit: http://localhost:8000/search

