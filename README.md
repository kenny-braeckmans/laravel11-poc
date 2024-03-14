# Laravel 11 development environment

## Requirements

- WSL2
- Docker
- VSCode with [Remote Development - Visual Studio Marketplace](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.vscode-remote-extensionpack)

## Installation

- [Installation - Laravel 11.x - The PHP Framework For Web Artisans](https://laravel.com/docs/11.x/installation)
- [Laravel Sail - Laravel 11.x - The PHP Framework For Web Artisans](https://laravel.com/docs/11.x/sail)

```bash
curl -s https://laravel.build/laravel11-poc?with=mysql,mailpit | bash
```

> [!WARNING]
> Adding "&devcontainer" doesn't work any more since Laravel v11, bug?

```bash
cd laravel11-poc
docker-compose up
```

Open a shell in the running docker container:

```bash
docker exec -it $(docker ps -qf "ancestor=sail-8.3/app") bash
```

Install missing components (if any), and add devcontainer support for VSCode:

```bash
php artisan sail:install --devcontainer
```

Shutdown docker containers, open Laravel project in VSCode and run "Dev Containers: Open folder in container"

## Development

### Check .ENV file for database details

### Create models and migrations

```bash
php artisan make:model Administrator -m
php artisan make:model Project -m
php artisan make:model Beneficiary -m
php artisan make:model Pillar -m
php artisan make:model Registration -m
php artisan make:model Week -m
```

### Define relationships

*See `app/Models` directory.*

### Create controllers

```bash
php artisan make:controller AdministratorController --api
php artisan make:controller ProjectController --api
php artisan make:controller BeneficiaryController --api
php artisan make:controller PillarController --api
php artisan make:controller RegistrationController --api
php artisan make:controller WeekController --api
```

> Needs to be tested again, forgot "--api" and added routing w/ Sanctum

### Configure routing

[Routing - Laravel 11.x - The PHP Framework For Web Artisans](https://laravel.com/docs/11.x/routing)

```bash
php artisan install:api
```

> I answered NO when asked to run the database migrations.
> Sanctum was installed as well... need to check this, later...

### Factories and seeders

[Database: Seeding - Laravel 11.x - The PHP Framework For Web Artisans](https://laravel.com/docs/11.x/seeding)

```bash
php artisan make:factory AdministratorFactory --model=Administrator
php artisan make:factory ProjectFactory --model=Project
php artisan make:factory BeneficiaryFactory --model=Beneficiary
php artisan make:factory PillarFactory --model=Pillar
php artisan make:factory RegistrationFactory --model=Registration
php artisan make:factory WeekFactory --model=Week
```

Define factories, *see `database/factories` directory.*

```bash
php artisan make:seeder AdministratorsSeeder
php artisan make:seeder ProjectsSeeder
php artisan make:seeder BeneficiariesSeeder
php artisan make:seeder PillarsSeeder
php artisan make:seeder RegistrationsSeeder
php artisan make:seeder WeeksSeeder
```

> FIX ME: beneficiaries migration needs to run before projects

```
php artisan migrate:fresh --seed
```

### Configure authentication