<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['required', 'string'],
            'author'   => ['required', 'string'],
            'category' => ['required', 'string'],
            'price'    => ['required', 'numeric'],
        ]);

        $book = Book::create($data);

        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $data = $request->validate([
            'title'    => ['sometimes', 'string'],
            'author'   => ['sometimes', 'string'],
            'category' => ['sometimes', 'string'],
            'price'    => ['sometimes', 'numeric'],
        ]);

        $book->fill($data)->save();

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (! $book) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Deleted']);
    }

    public function search(Request $request)
    {
        $title = $request->query('title', '');

        $books = Book::where('title', 'like', "%{$title}%")
            ->orWhere('author', 'like', "%{$title}%")
            ->get();

        return response()->json($books);
    }

    public function borrowed(Request $request)
    {
        $user = $request->user();

        $borrowed = Borrow::with('book')
            ->where('user_id', $user->id)
            ->get()
            ->map(function ($borrow) {
                return [
                    'id'          => $borrow->book->id,
                    'title'       => $borrow->book->title,
                    'author'      => $borrow->book->author,
                    'category'    => $borrow->book->category,
                    'price'       => $borrow->book->price,
                    'borrowed_at' => $borrow->borrowed_at,
                ];
            });

        return response()->json($borrowed);
    }
}

