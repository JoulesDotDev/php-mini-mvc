<?php
$search = _CONTEXT("search_term") ?? "";
?>

<input
    hx-post="/admin/book/insert"
    hx-vars="{ action: 'search:author' }"
    hx-trigger="keyup changed delay:200ms, search"
    hx-target="#search-results"
    type="text"
    name="search"
    autocomplete="off"
    placeholder="Search for author"
    value="<?= $search ?>"
    class="input w-full">

<div id="search-results">
    <?php Component("AuthorSearchResults") ?>
</div>