<?php

namespace App\Http\Controllers;

use App\Support\LeadRepository;
use App\Support\SiteContentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct(
        private readonly SiteContentRepository $contentRepository,
        private readonly LeadRepository $leadRepository
    ) {
    }

    public function index(): View
    {
        return view('admin.dashboard', [
            'content' => $this->contentRepository->get(),
            'leads' => $this->leadRepository->all(),
        ]);
    }

    public function updateContent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_title' => ['required', 'string', 'max:220'],
            'hero_subtitle' => ['required', 'string', 'max:260'],
            'about_title' => ['required', 'string', 'max:220'],
            'about_paragraphs' => ['nullable', 'string', 'max:2400'],
            'stats' => ['required', 'array', 'size:3'],
            'stats.*.value' => ['required', 'string', 'max:60'],
            'stats.*.label' => ['required', 'string', 'max:120'],
            'results' => ['required', 'array', 'min:1'],
            'results.*.name' => ['required', 'string', 'max:180'],
            'results.*.result' => ['required', 'string', 'max:300'],
            'results.*.logo' => ['required', 'string', 'max:180'],
        ]);

        $content = $this->contentRepository->get();

        $paragraphs = array_values(array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n/', (string) $validated['about_paragraphs']) ?: []),
            static fn (string $line): bool => $line !== ''
        ));

        $results = [];
        foreach ($validated['results'] as $row) {
            $results[] = [
                'name' => trim((string) Arr::get($row, 'name', '')),
                'result' => trim((string) Arr::get($row, 'result', '')),
                'logo' => $this->normalizeLogoPath((string) Arr::get($row, 'logo', '')),
            ];
        }

        $content['hero'] = [
            'title' => trim($validated['hero_title']),
            'subtitle' => trim($validated['hero_subtitle']),
        ];
        $content['about'] = [
            'title' => trim($validated['about_title']),
            'paragraphs' => $paragraphs,
        ];
        $content['stats'] = $validated['stats'];
        $content['results'] = $results;

        $this->contentRepository->save($content);

        return back()->with('admin_success', 'Контент обновлен.');
    }

    public function updateMedia(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'banner_image' => ['nullable', 'image', 'max:5120'],
            'about_image' => ['nullable', 'image', 'max:5120'],
            'favicon_file' => ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,webp,svg', 'max:2048'],
        ]);

        $content = $this->contentRepository->get();

        if ($validated['banner_image'] ?? false) {
            $content['media']['banner'] = $this->storeImage($validated['banner_image'], 'images', 'tatyana-banner');
        }

        if ($validated['about_image'] ?? false) {
            $content['media']['about'] = $this->storeImage($validated['about_image'], 'images', 'about-tatyana');
        }

        if ($validated['favicon_file'] ?? false) {
            $content['media']['favicon'] = $this->storeImage($validated['favicon_file'], '', 'favicon');
        }

        $this->contentRepository->save($content);

        return back()->with('admin_success', 'Изображения обновлены.');
    }

    private function storeImage(UploadedFile $file, string $folder, string $baseName): string
    {
        $extension = strtolower((string) $file->getClientOriginalExtension());
        if ($extension === '') {
            $extension = 'jpg';
        }

        $targetName = $baseName . '.' . $extension;
        $targetDirectory = $folder === '' ? public_path() : public_path($folder);

        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $file->move($targetDirectory, $targetName);

        return ltrim(($folder !== '' ? $folder . '/' : '') . $targetName, '/');
    }

    private function normalizeLogoPath(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return 'images/favorit.webp';
        }

        if (str_starts_with($value, 'images/') || str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return 'images/' . ltrim($value, '/');
    }
}
