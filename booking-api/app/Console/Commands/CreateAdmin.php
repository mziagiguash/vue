<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание администратора приложения';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Введите ваше имя');
        if (empty($name)) {
            $this->error('Введите ваше имя');
            exit();
        };

        $email = $this->ask('Введите ваш email');
        if (empty($email)) {
            $this->error('Введите ваш email');
            exit();
        };

        $admin = new User;
        $admin->name = $name;

        if (!User::exists()) {
            $admin->email = $email;
        } else {
            foreach (User::all() as $user) {
                if ($email === $user->email) {
                    $this->error('Пользователь с таким email уже существует');
                    exit();
                } else {
                    $admin->email = $email;
                }
            }
        }

        $password = $this->secret('Введите пароль');
        if (empty($password) || strlen($password) < 8) {
            $this->error('Пароль должен состоять из 8 и более символов');
            exit();
        };

        $currentPassword = $this->secret('Введите пароль повторно');

        if ($password === $currentPassword) {
            $admin->password = $password;
        } else {
            $this->error('Пароли не совпадают');
            exit();
        }

        $admin->role_id = 1;
        $admin->save();

        $this->info('Администратор зарегистрирован');
    }
}
