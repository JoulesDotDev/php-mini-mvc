<?php

_CONTEXT_SET("_head", ["title" => "Save Book"]);

if (GET) show();
if (POST) actions();

function show()
{
    View();
}

function actions()
{
    if (ACTION === "admin:insert-book") insertBook();
    else if (ACTION === "search:author") searchAuthor();
    else if (ACTION === "search:isbn") searchIsbn();
    else JSON(404, 404);
}

function insertBook()
{
    require_once "Request.php";
    require_once ROOT_DIR . "/Models/Author/Author.php";
    require_once ROOT_DIR . "/Models/Book/Book.php";

    try {
        $result = validate();
        _CONTEXT_SET("result", $result);

        $search = _POST("search") ?? "";
        _CONTEXT_SET("search_term", $search);

        $author = null;
        if ($result["values"]["author_id"] ?? null && $result["errors"]["author_id"] === null) {
            $author = Author::_getById($result["values"]["author_id"]);
            _CONTEXT_SET("selected_author", _POST("author_id") ?? null);
        }
        _CONTEXT_SET("authors", $author ? [$author] : []);

        if (count($result["errors"]) > 0) {
            return View();
        }

        $book = new Book();
        $book->fill($result["values"]);
        $book->save();

        return View();
    } catch (DBException $e) {
        Log::Error($e);
        //redirect("/500");
    }
}

function searchAuthor()
{
    require_once ROOT_DIR . "/Models/Author/Author.php";

    try {
        $search = _POST("search") ?? null;
        $authors = Author::search($search);
        _CONTEXT_SET("authors", $authors);
        _CONTEXT_SET("search_term", $search);
        return Component("AuthorSearchResults");
    } catch (DBException $e) {
        Log::Error($e);
        hxRedirect("/500");
    }
}

function searchIsbn()
{
    require_once ROOT_DIR . "/Models/Book/Book.php";

    try {
        $isbn = _POST("isbn") ?? null;
        $book = Book::getByIsbn($isbn);
        if ($book) {
            _CONTEXT_SET("id", $book["id"]);
            return Component("IsbnSearchResult");
        }
    } catch (DBException $e) {
        Log::Error($e);
        hxRedirect("/500");
    }
}
