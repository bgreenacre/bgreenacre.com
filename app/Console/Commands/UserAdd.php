<?php

namespace Bgreenacre\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Hashing\Hasher;
use Bgreenacre\Users\UserModel;
use Bgreenacre\Roles\RoleModel;

class UserAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add
        {--u|username=}
        {--e|email=}
        {--r|roles=*}
        {--p|password=}
        {--first_name=}
        {--last_name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds user to system.';

    protected $user;
    protected $roles;
    protected $hasher;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserModel $user, RoleModel $roles, Hasher $hasher)
    {
        parent::__construct();

        $this->user = $user;
        $this->roles = $roles;
        $this->hasher = $hasher;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username  = $this->option('username');
        $email     = $this->option('email');
        $roles     = $this->option('roles');
        $password  = $this->option('password');
        $firstName = $this->option('first_name');
        $lastName  = $this->option('last_name');

        if (is_null($password))
        {
            $password = $this->secret('What is the password?');
        }

        $userCount = (bool) $this->user
            ->where('email', $email)
            ->take(1)
            ->get()
            ->count();

        if ($userCount !== false)
        {
            $this->error(
                sprintf(
                    'User with the email %s currently exists.',
                    $email
                )
            );

            exit(1);
        }

        $userObj = clone $this->user;

        $userObj->username   = $username;
        $userObj->email      = $email;
        $userObj->password   = $this->hasher->make($password);
        $userObj->first_name = $firstName;
        $userObj->last_name  = $lastName;

        if ($userObj->save())
        {
            foreach ($roles as $role)
            {
                $roleObj = $this->roles->where('slug', $role)->take(1)->get();

                if ( ! is_null($roleObj))
                {
                    $userObj->roles()->attach($roleObj);
                }
            }
        }
        else
        {
            $errors = '';

            foreach ($userObj->getErrors()->all(":message\n") as $msg)
            {
                $errors .= $msg;
            }

            $this->error($errors);
        }
    }
}
