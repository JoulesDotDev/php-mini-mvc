<?php
$values = _CONTEXT("result", "values") ?? [];
$isbn_error = _CONTEXT("isbn_error") ?? null;
?>

<input
    hx-post="/admin/book/insert"
    hx-vars="{ action: 'search:isbn' }"
    hx-trigger="input changed delay:200ms, search"
    hx-target="#isbn-search-results"
    class="input w-full"
    type="text" id="isbn"
    name="isbn" placeholder="ISBN"
    value="<?= $values["isbn"] ?? "" ?>">

<div id="isbn-search-results">

</div>