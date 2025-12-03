<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function borrow(Request $request, Book $book)
    {
        $user = $request->user();

        $existing = Borrow::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Book already borrowed by this user',
            ], 400);
        }

        $borrow = Borrow::create([
            'user_id'     => $user->id,
            'book_id'     => $book->id,
            'borrowed_at' => now(),
        ]);

        return response()->json($borrow, 201);
    }

    public function return(Request $request, Book $book)
    {
        $user = $request->user();

        $borrow = Borrow::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if (! $borrow) {
            return response()->json([
                'message' => 'No borrow record found for this user/book',
            ], 404);
        }

        $borrow->delete();

        return response()->json(['message' => 'Book returned']);
    }
}

