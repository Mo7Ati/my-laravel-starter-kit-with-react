<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Enums\PanelsEnum;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (isAdminPanel()) {
            config([
                'fortify.guard' => 'admin',
                'fortify.home' => 'admin',
                'fortify.passwords' => 'admins',
                'fortify.prefix' => 'admin',
            ]);
        } elseif (isStorePanel()) {
            config([
                'fortify.guard' => 'store',
                'fortify.home' => 'store',
                'fortify.passwords' => 'stores',
                'fortify.prefix' => 'store',
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(function (Request $request) {
            return Inertia::render($this->view('login'), [
                'canResetPassword' => Features::enabled(Features::resetPasswords()),
                'canRegister' => Features::enabled(Features::registration()),
                'status' => $request->session()->get('status'),
            ]);
        });

        Fortify::resetPasswordView(
            fn(Request $request) =>
            Inertia::render($this->view('reset-password'), [
                'email' => $request->email,
                'token' => $request->route('token'),
            ])
        );

        Fortify::requestPasswordResetLinkView(
            fn(Request $request) =>
            Inertia::render($this->view('forgot-password'), [
                'status' => $request->session()->get('status'),
            ])
        );

        Fortify::verifyEmailView(
            fn(Request $request) =>
            Inertia::render($this->view('verify-email'), [
                'status' => $request->session()->get('status'),
            ])
        );

        Fortify::registerView(fn() => Inertia::render($this->view('register')));

        Fortify::twoFactorChallengeView(
            fn() =>
            Inertia::render($this->view('two-factor-challenge'))
        );

        Fortify::confirmPasswordView(
            fn() =>
            Inertia::render($this->view('confirm-password'))
        );
    }


    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }

    private function view(string $page): string
    {
        if (getPanel() === null) {
            abort(404);
        }
        return getPanel() . "/auth/{$page}";
    }
}
