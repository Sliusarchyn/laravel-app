<?php

namespace App\Console\Commands\User;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\ValueObjects\Phone;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete {phone : User phone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user by phone';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $phone = Phone::fromString($this->argument('phone'));
        } catch (InvalidArgumentException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        /** @var UserServiceInterface $userService */
        $userService = App::make(UserServiceInterface::class);

        try {
            $userService->deleteByPhone($phone);

            $this->info("User with phone:{$phone->toString()} successfully deleted!");
        } catch (ModelNotFoundException) {
            $this->error('Can\'t find user with this phone number.');

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
