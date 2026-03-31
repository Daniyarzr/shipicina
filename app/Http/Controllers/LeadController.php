<?php

namespace App\Http\Controllers;

use App\Mail\LeadSubmittedMail;
use App\Support\LeadRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function __construct(private readonly LeadRepository $leadRepository)
    {
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'situation' => ['nullable', 'string', 'max:2000'],
        ]);

        $record = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'situation' => $validated['situation'] ?? '',
            'created_at' => now()->toDateTimeString(),
            'ip' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 280),
        ];

        $this->leadRepository->add($record);

        $targetEmail = (string) config('site.lead_receiver_email');

        $mailFailed = false;
        $mailErrorMessage = null;

        if ($targetEmail !== '') {
            try {
                Mail::to($targetEmail)->send(new LeadSubmittedMail($record));
            } catch (\Throwable $exception) {
                $mailFailed = true;
                $mailErrorMessage = $exception->getMessage();
                Log::error('Lead email send failed', ['message' => $exception->getMessage()]);
            }
        }

        $response = back()->with('success', 'Спасибо! Заявка отправлена. Я свяжусь с вами в течение 2 часов.');

        if ($mailFailed) {
            $warning = 'Заявка сохранена, но письмо на почту не отправилось. Проверьте SMTP-настройки в .env.';
            if (config('app.debug') && $mailErrorMessage) {
                $warning .= ' Ошибка: ' . $mailErrorMessage;
            }

            return $response->with('mail_warning', $warning);
        }

        return $response;
    }
}
