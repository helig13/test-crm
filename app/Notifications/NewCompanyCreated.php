<?php

namespace App\Notifications;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCompanyCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('A new company has been created: ' . $this->company->name)
            ->action('View Company', url('/companies/' . $this->company->id))
            ->line('Thank you for using our application!');
    }

}
