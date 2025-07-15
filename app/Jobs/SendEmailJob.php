<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailLog;
use App\Mail\CustomEmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailLog;
    public $timeout = 60; // 60 detik timeout

    /**
     * Create a new job instance.
     */
    public function __construct(EmailLog $emailLog)
    {
        $this->emailLog = $emailLog;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Update status menjadi processing
            $this->emailLog->update(['status' => 'processing']);

            // Kirim email
            Mail::to($this->emailLog->to)->send(new CustomEmail(
                $this->emailLog->subject,
                $this->emailLog->message,
                $this->emailLog->template_id
            ));

            // Update status menjadi sent
            $this->emailLog->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);

        } catch (\Exception $e) {
            // Update status menjadi failed
            $this->emailLog->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            // Re-throw exception untuk retry
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        // Update status menjadi failed jika job gagal
        $this->emailLog->update([
            'status' => 'failed',
            'error_message' => $exception->getMessage(),
        ]);
    }

    /**
     * Determine the time at which the job should timeout.
     */
    public function retryUntil()
    {
        return now()->addMinutes(5);
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     */
    public function backoff()
    {
        return [30, 60, 120]; // Retry setelah 30s, 60s, 120s
    }
}
