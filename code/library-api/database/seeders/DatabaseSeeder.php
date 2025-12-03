<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo user
        $user = User::firstOrCreate(
            ['email' => 'phama2@mymail.nku.edu'],
            [
                'name'     => 'Demo User',
                'password' => Hash::make('Library123!'),
            ]
        );

        // Demo books
        $books = [
            [
                'title'    => "Harry Potter and the Sorcerer's Stone",
                'author'   => 'J.K. Rowling',
                'category' => 'Fantasy',
                'price'    => 9.99,
            ],
            [
                'title'    => 'To Kill a Mockingbird',
                'author'   => 'Harper Lee',
                'category' => 'Fiction',
                'price'    => 7.50,
            ],
            [
                'title'    => 'The Great Gatsby',
                'author'   => 'F. Scott Fitzgerald',
                'category' => 'Classic',
                'price'    => 10.00,
            ],
        ];

        foreach ($books as $data) {
            Book::firstOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
