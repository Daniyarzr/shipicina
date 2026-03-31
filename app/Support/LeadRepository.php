<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class LeadRepository
{
    private string $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('app/leads.jsonl');
    }

    public function add(array $lead): void
    {
        File::ensureDirectoryExists(dirname($this->filePath));
        File::append(
            $this->filePath,
            json_encode($lead, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL
        );
    }

    public function all(): array
    {
        if (!File::exists($this->filePath)) {
            return [];
        }

        $rows = [];
        $lines = preg_split('/\r\n|\r|\n/', (string) File::get($this->filePath));
        if (!is_array($lines)) {
            return [];
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            $decoded = json_decode($line, true);
            if (is_array($decoded)) {
                $rows[] = $decoded;
            }
        }

        return array_reverse($rows);
    }
}
