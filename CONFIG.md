# Projekt klubu strzeleckiego w Laravelu

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Description

## This is a Laravel project that includes a code example for creating a migration using the `php artisan` command.

## TODO LIST

- [x] popraw nazwy baz
- [x] dodaj liczenie ceny = cena toru \* czas
- [ ] rejestracja z remember me + email_verified_at
- [ ] czynny tor / remont wyłączenie toru
- [ ] rezerwacje toru admin potwierdz
- [ ]
- [ ]
- [ ]

---

## do zrobienia

```
w tabeli track price_per_hour czyli cena toru za godzinę
w tabeli reservations będzie price, czyli cena toru x czas trwania
pilnowanie żeby na zajęty tor ktoś inny nie mógł złożyć rezerwacji
godziny otwartcia i zamknięcia danego toru, i wyłączenia czasowe torów
nazwa obrazka będzie dla torów, administrator będzie operował obrazki
```

```
https://github.com/spatie/laravel-query-builder
```

## dodano app/Http/middleware/AdminMiddleware.php

```
php artisan make:middleware AdminMiddleware

```

### z kodem

```php
<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}

```

## do pliku _app/Http/Kernel.php_

```php
protected $routeMiddleware = [
    // Other middleware entries...

    'admin' => \App\Http\Middleware\AdminMiddleware::class,
];

```

### potem zabezpieczenia do route

```php
Route::middleware('admin')->group(function () {
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});

```

## to samo dla UserMiddleware

```php
<?php

namespace App\Http\Middleware;

use Closure;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return $next($request);
        }

        abort(401, 'Unauthorized');
    }
}

```

```
php artisan make:controller CrudController --resource

```

---

## BUG: google autofill zmienia color inputu na białym kiedy klikniemy na sugestie

---

## Zainstalować pakiet z gotowymi tłumaczeniami: laravel-lang.

Zmienić locale w pliku config/app.php.
https://laravel-lang.com/

```shell
composer require laravel-lang/common --dev

php artisan lang:add pl

php artisan lang:update
```

---

## dodano Factory

```shell
php artisan make:factory ReservationFactory
```

### Kod użyty do stworzenia bazy danych

# tworzenie bazy danych

```cmd
mysql -uroot -e "CREATE DATABASE IF NOT EXISTS ShootingClub;"
```

# instalowanie Composer

```php
composer create-project laravel/laravel ShootingClub
```

### cd ShootingClub

### Instalowanie plików

```php
composer require barryvdh/laravel-debugbar --dev
```

```php
composer require --dev barryvdh/laravel-ide-helper
```

### generowanie pliku \_ide_helper.php

```php
php artisan ide-helper:generate
```

### przechodzimy do pliku composer.json

### i w sekcji "post-update-cmd" dodajemy:

```json
"@php artisan ide-helper:generate",
"@php artisan ide-helper:meta"
```

### instalowanie Tailwind

```shell
npm install -D tailwindcss postcss autoprefixer
```

```shell
npx tailwindcss init -p
```

```shell
npm install -D @tailwindcss/forms
```

### tailwind.config

---

```json
/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [".storage/framework/views/*.php", "./resources/**/*.blade.php", "./resources/js/**/*.vue", "./resources/**/*.js"],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms"), require("tailwindcss")],
};
```

---

### axios

```shell
npm axios
```

### instalowanie FullCalendar

```shell
npm install @fullcalendar/core @fullcalendar/daygrid @fullcalendar/timegrid @fullcalendar/list @fullcalendar/interaction
```

### konfiguracja plików

.env

```js
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shootingclub
DB_USERNAME=root
DB_PASSWORD=
GOOGLE_MAPS_API_KEY=<API KEY>
```

---

```shell
php artisan make:controller Api/ReservationController --api
```

```shell
php artisan make:controller UserController -m
```

```shell
php artisan make:controller AuthController -m
```

```shell
php artisan make:model Reservation -msc
```

```shell
php artisan make:model Track -msc
```

## moze dodac do reservations ?

## uzytkownik edytuje swoja rezerwacje?

```shell
php artisan make:policy ReservationPolicy --model=Reservation
```

```shell
php artisan make:seeder RoleSeeder
```

```shell
php artisan make:migration create_roles_table --create=roles
```

# Kod użyty do stworzenia migracji

## role admin i klubowicz

<details>

<summary>Role</summary>

```php
php artisan make:migration create_roles_table --create=roles
```

```php
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('name', 50);
        });
    }
```

</details>

### klubowicze

<details>
<summary>Klubowicze </summary>

```php
php artisan make:migration create_users_table --create=users
```

```php
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('residential_address');
            $table->string('pesel')->unique();
            $table->date('admission_date');
            $table->string('password');
            $table->unsignedBigInteger('role_id'); // Foreign key column

            $table->foreign('role_id')
                ->references('role_id')
                ->on('roles');
                // ->onDelete('cascade');
        });
    }
```

</details>

# Osie strzeleckie

<details><summary open>

## Osie

</summary>

```php
php artisan make:migration create_tracks_table --create=tracks
```

```php
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('track_name', 50);
            $table->text('description');
        });
    }
```

</details>

<details><summary open>

## rezerwacje

</summary>

```php
php artisan make:migration create_bookings_table --create=booking
```

```php
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tracks_id')->nullable();
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tracks_id')->references('id')->on('tracks')->onDelete('set null');
        });
    }
```

</details>

# seedery

## role

```php
php artisan make:seeder TrackSeeder
```

```php
public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            DB::table('roles')->truncate();
        });

        DB::table('roles')->insert(
            [
                ['name' => 'admin'],
                ['name' => 'user'],
                ['name' => 'honorowy']
            ]
        );
    }
```

## Klubowicze

```php
php artisan make:seeder UserSeeder
```

```php
    public function run(): void
    {
        User::insert(
            [
                [
                    'name' => 'Adam',
                    'last_name' => 'Nowak',
                    'gender' => 'M',
                    'birth_date' => '1990-01-01',
                    'birth_place' => 'Warszawa',
                    'email' => 'adam@email.com',
                    'phone' => '123456789',
                    'residential_address' => 'ul. Kolorowa 1, 00-000 Warszawa',
                    'pesel' => '90010100000',
                    'admission_date' => '1990-01-01',
                    'password' => Hash::make('1234'), // bcrypt()
                    'role_id' => 1,
                ]
            ]
        );
    }

```

## Osie strzeleckie

```php
php artisan make:seeder TrackSeeder
```

```php
    public function run(): void
    {
        DB::table('tracks')->insert([
            ['id' => 1, 'track_name' => 'Oś 25m', 'description' => 'Strzelnica wewnętrzna wielotorowa.'],
            ['id' => 2, 'track_name' => 'Oś 100m', 'description' => 'Oś zewnętrzna 1 stanowisko'],
            ['id' => 3, 'track_name' => 'Oś 300m', 'description' => 'Tor zewnętrzny 3 stanowiska.'],
        ]);
    }

```

## DatabaseSeeder

```php
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TrackSeeder::class,
            BookingSeeder::class
        ]);
```

# po stworzeniu seederów i migracji

```php
php artisan db:seed --class=DatabaseSeeder
```

```php
php artisan migrate
```

# Controllery

```shell
php artisan make:controller UserController -m
```

```php
    public function showUserProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user', compact('user'));
        } else {
            // Użytkownik nie jest zalogowany, obsłuż ten przypadek
        }
    }
```

# AuthController

```shell
php artisan make:controller AuthController -m
```

```php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Send login form
    public function create()
    {
        // If authenticated, redirect to /user
        if (auth()->check()) {
            return redirect('/user');
        }

        return view('login');
    }

    // $request->has('remember') zamiast true

    // Authenticate the session
    public function store(Request $request)
    {
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]),true)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/user');
    }

    // Destroy session (logout)
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // sprawia ze token nie jest valid

        $request->session()->regenerateToken(); //ustawia nowy CSRF token

        return redirect('/');
    }
}

```

## poprawić model Booking

```php
php artisan make:model Booking -m
```

-m (doda od razu migrację)

w pliku booking

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'track_id',
        'booking_date',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
```

## dodać ReservationController

```php
php artisan make:controller ReservationController --api
```

```php
<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();

        return response()->json($bookings);
    }

    public function show($id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            return response()->json($booking);
        } else {
            return response()->json(['error' => 'Rezerwacja nie została znaleziona.'], 404);
        }
    }
}
```

### dodać route

```php
Route::get('/reservations', [ReservationController::class, 'index']);

Route::get('/reservations/{id}', [ReservationController::class, 'show']);
```

```php
php artisan make:model Track -m
```

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'track_name',
        'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

```
