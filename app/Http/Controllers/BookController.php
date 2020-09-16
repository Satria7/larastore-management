<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = \App\Book::with('categories')->paginate(10);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
