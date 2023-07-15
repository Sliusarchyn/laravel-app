<?php

namespace App\Console\Commands;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\ValueObjects\Phone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use InvalidArgumentException;
use LogicException;

class UserCreateCommand extends Command
{
    protected $signature = 'users:create {name : User name} {phone : User phone}';

    protected $description = 'Create user with name, email and phone';

    public function handle(): int
    {
        $name = $this->argument('name');

        try {
            $phone = Phone::fromString($this->argument('phone'));
        } catch (InvalidArgumentException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        /** @var UserServiceInterface $userService */
        $userService = App::make(UserServiceInterface::class);

        try {
            $userService->create($name, $phone);
        } catch (LogicException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info('User successfully created!');

        return self::SUCCESS;
    }
}
