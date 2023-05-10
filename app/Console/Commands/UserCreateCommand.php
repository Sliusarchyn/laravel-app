<?php

namespace App\Console\Commands;

use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Console\Command;
use InvalidArgumentException;

class UserCreateCommand extends Command
{
    protected $signature = 'users:create {name : User name} {phone : User phone}';

    protected $description = 'Create user with name and phone';

    public function handle(): int
    {
        $name = $this->argument('name');

        try {
            $phone = Phone::fromString($this->argument('phone'));
        } catch (InvalidArgumentException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $user = new User();

        $user->name = $name;
        $user->email = 'alex4@gmail.com';
        $user->phone = $phone;

        $user->save();

        $this->info('User successfully created!');

        return self::SUCCESS;
    }
}
