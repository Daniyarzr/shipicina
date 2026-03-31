<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class SiteContentRepository
{
    private string $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('app/site-content.json');
    }

    public function get(): array
    {
        $defaults = config('site.defaults', []);
        $stored = $this->readStoredContent();

        return array_replace_recursive($defaults, $stored);
    }

    public function save(array $content): void
    {
        File::ensureDirectoryExists(dirname($this->filePath));
        File::put(
            $this->filePath,
            json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }

    private function readStoredContent(): array
    {
        if (!File::exists($this->filePath)) {
            return [];
        }

        $decoded = json_decode((string) File::get($this->filePath), true);

        return is_array($decoded) ? $decoded : [];
    }
}
