<?php

namespace App\Providers;

use App\Models\Action;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Master;
use App\Models\Profile;
use App\Models\Record;
use App\Models\Salon;
use App\Models\Service;
use App\Models\User;
use App\Policies\ActionPolicy;
use App\Policies\CalendarPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\MasterPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\RecordPolicy;
use App\Policies\SalonPolicy;
use App\Policies\ServicePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Salon::class => SalonPolicy::class,
        Master::class => MasterPolicy::class,
        Service::class => ServicePolicy::class,
        Record::class => RecordPolicy::class,
        Action::class => ActionPolicy::class,
        Calendar::class => CalendarPolicy::class,
        Category::class => CategoryPolicy::class,
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $spaUrl = "http://spa.test?email_verify_url=".$url;

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $spaUrl);
        });
    }
}
