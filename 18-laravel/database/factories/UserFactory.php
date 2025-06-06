<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;
    protected static int $maleIndex = 1;
    protected static int $femaleIndex = 1;

    public function definition(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);

        $firstName = $gender === 'Male'
            ? fake()->firstNameMale()
            : fake()->firstNameFemale();

        $lastName = fake()->lastName();
        $fullName = "$firstName $lastName";

        $birthdate = fake()->dateTimeBetween('1977-01-01', '2007-12-31')->format('Y-m-d');
        $document = fake()->unique()->numberBetween(75000010, 78000000);

        // Nombre del archivo basado en el documento
        $fileName = $document . '.jpg';
        $filePath = public_path('images/' . $fileName);

        // URL según el género
        $url = $gender === 'Male'
            ? "https://randomuser.me/api/portraits/men/" . rand(1, 99) . ".jpg"
            : "https://randomuser.me/api/portraits/women/" . rand(1, 99) . ".jpg";

        // Descargar la imagen si no existe
        if (!file_exists($filePath)) {
            try {
                $imageData = file_get_contents($url);
                file_put_contents($filePath, $imageData);
            } catch (\Exception $e) {
                // Si hay un error, usa imagen por defecto
                $fileName = 'default.jpg';
            }
        }

        return [
            'document'          => $document,
            'fullname'          => $fullName,
            'gender'            => $gender,
            'birthdate'         => $birthdate,
            'phone'             => fake()->phoneNumber(),
            'email'             => fake()->unique()->safeEmail(),
            'photo'             => 'images/' . $fileName,
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('12345'),
            'remember_token'    => Str::random(10),
        ];
    }


    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
