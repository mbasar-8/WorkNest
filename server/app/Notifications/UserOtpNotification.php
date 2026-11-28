<?php

namespace App\Notifications;

use App\Enums\OtpType;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserOtpNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected string $otp,
        protected OtpType $type,
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject())
            ->greeting("Hello {$notifiable->name},")
            ->line($this->message())
            ->line("OTP: {$this->otp}")
            ->line('This OTP is valid for '.config('otp.expiry_minutes').' minutes.')
            ->line('If you did not make this request, you can safely ignore this email.')
            ->salutation("Regards,\nWorkNest Team");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }

    /**
     * Get the email subject.
     */
    private function subject(): string
    {
        return match ($this->type) {
            OtpType::EMAIL_VERIFICATION => 'Verify Your WorkNest Email',
            OtpType::PASSWORD_RESET => 'Reset Your WorkNest Password',
        };
    }

    /**
     * Get the email message.
     */
    private function message(): string
    {
        return match ($this->type) {
            OtpType::EMAIL_VERIFICATION =>
                'Thank you for joining WorkNest. Use the OTP below to verify your email address.',

            OtpType::PASSWORD_RESET =>
                'We received a request to reset your WorkNest password. Use the OTP below to continue.',
        };
    }
}
