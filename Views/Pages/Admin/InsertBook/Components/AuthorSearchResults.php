<?php
$authors = _CONTEXT("authors") ?? [];
$selected = _CONTEXT("selected_author") ?? null;
$search = _CONTEXT("search_term");
?>

<?php if (count($authors) > 0) : ?>
    <select class="select w-full mt-3" id="author" name="author_id">
        <?php foreach ($authors as $author) : ?>
            <option
                <?= $selected === $author["id"] ? 'selected="true"' : "" ?>
                value="<?= $author["id"] ?>">
                <?= $author["name"] ?>
            </option>
        <?php endforeach; ?>
    </select>
<?php elseif ($search) : ?>
    <div class="text-center mt-3 text-info">
        No authors found. <a href="/admin/author/insert" class="link link-warning link-hover">
            Add a new one here.
        </a></div>
<?php endif; ?>