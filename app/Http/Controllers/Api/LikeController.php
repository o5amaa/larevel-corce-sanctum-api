<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Book;
use App\Models\Like;

class LikeController extends Controller
{
    public function like($bookId)
    {
        $book = Book::findOrFail($bookId);

        $data =
            [
                'book_id' => $book->id,
                'user_id' => auth()->id(),
            ];

        Like::firstOrCreate($data, $data);

        return $this->jsonResponse('Book Like');
        // return response()->json(['message' => ''], 200);

        // dd('ooooooooooooooooooooooo');
    }


    public function dislike($bookId)
    {

        // $like = Like::where('book_id', $bookId)->where('user_id', auth()->id())->firstOrFail();
        // // dd($like);
        // $like->delete();

        Like::query()
            ->whereBookId($bookId)
            ->whereUserId(auth()->id())
            ->firstOrFail()
            ->delete();

        // return response()->json(['message' => ''], 200);
        return $this->jsonResponse('Book DisLike');

    }
}
