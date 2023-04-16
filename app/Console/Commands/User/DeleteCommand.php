<?php

namespace App\Console\Commands\User;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\ValueObjects\Email;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user by email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = Email::fromString($this->ask('Enter user email'));

        /** @var UserServiceInterface $userService */
        $userService = App::make(UserServiceInterface::class);

        try {
            $userService->deleteByEmail($email);

            $this->info("User with email:{$email->toString()} successfully deleted!");
        } catch (ModelNotFoundException) {
            $this->error('Can\'t find user with this email.');
        }
    }
}
