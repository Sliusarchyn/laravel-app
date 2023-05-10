<?php

declare(strict_types=1);

namespace App\Console\Commands\User;

use App\Contracts\Services\UserService\Dto\CreateData;
use App\Contracts\Services\UserService\UserServiceInterface;
use App\Exceptions\UserAlreadyExistsException;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter user name');
        $email = Email::fromString($this->ask('Enter user email'));
        $phone = Phone::fromString($this->ask('Enter user phone (with +, +380...)'));

        /** @var UserServiceInterface $userService */
        $userService = App::make(UserServiceInterface::class);

        $createData = new CreateData(
            $email,
            $name,
            $phone
        );

        try {
            $userService->create($createData);
            $this->info("User with email:{$email->toString()} successfully created!");
        } catch (UserAlreadyExistsException $e) {
            $this->error($e->getMessage());
        }
    }
}
