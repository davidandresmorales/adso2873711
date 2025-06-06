<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $pets = [
            "Lola", "Bear", "Sadie", "Duke", "Maggie", "Toby", "Sophie", "Oliver", "Chloe", "Jack",
            "Stella", "Riley", "Zoe", "Winston", "Coco", "Zeus", "Ruby", "Bentley", "Penny", "Jax",
            "Lily", "Louie", "Mia", "Murphy", "Ellie", "Gus", "Roxy", "Ollie", "Gracie", "Finn",
            "Maddie", "Henry", "Piper", "Leo", "Layla", "Oscar", "Abby", "Milo", "Pepper", "Teddy",
            "Nala", "Tucker", "Rosie", "Jake", "Emma", "Wrigley", "Harley", "Beau", "Lulu", "Dexter",
            "Kona", "Bailey", "Izzy", "Sam", "Annie", "Apollo", "Ginger", "Koda", "Willow", "Bandit",
            "Lexi", "Marley", "Hazel", "Ace", "Scout", "Gunner", "Sasha", "Shadow", "Lucky", "Buster",
            "Millie", "Thor", "Roxie", "Diesel", "Ella", "Tank", "Olive", "Bruno", "Mocha", "Ranger",
            "Callie", "Prince", "Minnie", "Simba", "Sugar", "Romeo", "Dixie", "Bruce", "Josie", "Cash",
            "Cleo", "Rusty", "Phoebe", "Bo", "Xena", "Odin", "Maya", "Sammy", "Holly", "Rocco",
            "Leia", "Benny", "Lilly", "King", "Athena", "Chewy", "Nova", "Hank", "Paisley", "Vader",
            "Pearl", "Jackson", "Cookie", "Merlin", "Fiona", "Yoda", "Winnie", "Apollo", "Dolly", "Gizmo",
            "Sandy", "Rudy", "Bonnie", "Axel", "Cali", "Mojo", "Jasmine", "Rufus", "Diva", "Spike",
            "Angel", "Peanut", "Trixie", "Frankie", "Mimi", "Goose", "Pumpkin", "Chester", "Star", "Boomer",
            "Dottie", "Hugo", "Sassy", "Maverick", "Tessa", "Porter", "Missy", "Rebel", "Pebbles", "Blaze",
            "Taz", "Midnight", "Sox", "Comet", "Panda", "Domino", "Smokey", "Oreo", "Patches", "Whiskers",
            "Felix", "Garfield", "Tom", "Jerry", "Sylvester", "Tweety", "Nibbles", "Puss", "Boots", "Mittens",
            "Fluffy", "Snowball", "Casper", "Salem", "Binx", "Simba", "Nala", "Mufasa", "Scar", "Kiara",
            "Pumbaa", "Timon", "Rafiki", "Zazu", "Ed", "Meeko", "Percy", "Tigger", "Eeyore", "Kanga",
            "Max", "Bella", "Luna", "Charlie", "Lucy", "Cooper", "Daisy", "Buddy", "Molly", "Rocky"
        ];
        return [
            //
            'name'          => $pets[array_rand($pets)] . fake()->numerify('#'),
            'Kind'          => fake()->randomElement(['Dog', 'cat', 'Dog', 'Bird', 'Mouse', 'Dog', 'Cat']),
            'weight'        => fake()->numberBetween(1, 80),
            'age'           => fake()->randomNumber(2, true), 
            'breed'         => fake()->colorName(),
            'location'      => fake()->city(),
            'description'   => fake()->sentence(10),
        ];
    }
}
