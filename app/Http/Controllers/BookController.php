<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-books')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get("status");
        $keyword = $request->get("keyword") ? $request->get("keyword") : '';
        if ($status) {
            $books = \App\Book::with('categories')->where('title', 'LIKE', "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $books = \App\Book::with('categories')->where('title', 'LIKE', "%%$keyword")->paginate(10);
        }
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("books.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newBook = new \App\Book;
        $newBook->title = $request->get("title");
        $cover = $request->file("cover");
        if ($cover) {
            $coverPath = $cover->store("book_covers", "public");
            $newBook->cover = $coverPath;
        }
        $newBook->description = $request->get("description");
        $newBook->stock = $request->get("stock");
        $newBook->author = $request->get("author");
        $newBook->publisher = $request->get("publisher");
        $newBook->price = $request->get("price");
        $newBook->status = $request->get("save_action");
        $newBook->slug = \Str::slug($request->get("title"));
        $newBook->created_by = \Auth::user()->id;
        $newBook->save();
        $newBook->categories()->attach($request->get('categories'));
        if ($request->get("save_action") == "PUBLISH") {
            return redirect()->route("books.create")->with("status", "Book Succesfully saved and publsihed");
        } else {
            return redirect()->route("books.create")->with("status", "Book saved as Draft");
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = \App\Book::findOrFail($id);

        return view("books.edit", compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = \App\Book::findOrFail($id);
        $book->title = $request->get("title");
        $book->slug = $request->get("slug");
        $book->description = $request->get("description");
        $book->author = $request->get("author");
        $book->publisher = $request->get("publisher");
        $book->stock = $request->get("stock");
        $book->price = $request->get("price");
        $newCover = $request->file("cover");
        if ($newCover) {
            if ($book->cover && file(storage_path("app/public/" . $book->cover))) {
                \Storage::delete("public/" . $book->cover);
            }
            $newCoverPath = $newCover->store("book_covers", "public");
            $book->cover = $newCoverPath;
        }
        $book->updated_by = \Auth::user()->id;
        $book->status = $request->get("status");
        $book->save();
        $book->categories()->sync($request->get('categories'));
        return redirect()->route("books.index")->with("status", "Book succesfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = \App\Book::findOrFail($id);
        $book->delete();
        return redirect()->route("books.index")->with("status", "Book Moved to trash");
    }

    // trash
    public function trash()
    {
        $books = \App\Book::onlyTrashed()->paginate(10);
        return view("books.trash", compact("books"));
    }

    // restore method | created by Muhammad Kuswari
    public function restore($id)
    {
        $book = \App\Book::withTrashed()->findOrFail($id);
        if ($book->trashed()) {
            $book->restore();
            return redirect()->route("books.index")->with("status", "Book succesfully restored");
        } else {
            return redirect()->route("books.index")->with("status", "Book is not in trash");
        }
    }

    // delete permanent method | created by Muhammad Kuswari
    public function deletePermanent($id)
    {
        $book = \App\Book::withTrashed()->findOrFail($id);
        if (!$book->trashed()) {
            return redirect()->route("books.trash")->with("status", "Book is not on trash")->with('status_type', 'alert');
        } else {
            $book->categories()->detach();
            $book->forceDelete();
            return redirect()->route("books.trash")->with("status", "Book Permanenlty deleted");
        }
    }
}
