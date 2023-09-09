<?php
$values = _CONTEXT("result", "values") ?? [];
$errors = _CONTEXT("result", "errors") ?? [];
$borrowable = json_encode($values["borrowable"] ?? true);
?>

<h1 class="text-5xl font-bold text-center my-20">New Book</h1>

<form action="/admin/book/insert" method="POST">
    <div
        x-data="{ borrowable: <?= $borrowable ?> }"
        class="card bg-neutral card-compact w-full md:w-1/2 bg-base-100 shadow-xl h-min p-8">

        <?= csrf() ?>
        <?= action("admin:insert-book") ?>

        <div>
            <label class="label" for="author">Author</label>
            <?php Component('AuthorSearch') ?>
            <?php Component('FormShared/Error', $errors["author_id"] ?? "") ?>
        </div>

        <div class="mt-4 mb-4">
            <label class="label" for="isbn">ISBN</label>
            <?php Component('IsbnSearch') ?>
            <?php Component('FormShared/Error', $errors["isbn"] ?? "") ?>
        </div>

        <div class="divider"></div>

        <div>
            <label class="label" for="name">Name</label>
            <input class="input w-full" type="text" id="name" autocomplete="off" name="name" placeholder="Name" value="<?= $values["name"] ?? "" ?>">
            <?php Component('FormShared/Error', $errors["name"] ?? "") ?>
        </div>

        <div class="mt-4">
            <label class="label" for="amount">Amount</label>
            <input x-mask="99" class="input w-full" type="text" id="amount" name="amount" placeholder="Amount" value="<?= $values["amount"] ?? "1" ?>">
            <?php Component('FormShared/Error', $errors["amount"] ?? "") ?>
        </div>

        <div class="mt-4">
            <label class="label cursor-pointer" for="borrowable">
                <span class="label-text">Borrowable</span>
                <input
                    x-model="borrowable"
                    type="checkbox" id="borrowable" name="borrowable" class="checkbox" />
            </label>
        </div>

        <div x-show="borrowable">
            <div class="mt-4">
                <label class="label" for="borrow_days">Borrow Days</label>
                <input x-mask="99" class="input w-full" type="text" id="borrow_days" name="borrow_days" placeholder="Borrow Days"
                    value="<?= $values["borrow_days"] ?? "14" ?>">
                <?php Component('FormShared/Error', $errors["borrow_days"] ?? "") ?>
            </div>

            <div class="mt-4">
                <label class="label" for="renewable_times">Renewable Times (for 1 more week)</label>
                <input x-mask="9" class="input w-full" type="text" id="renewable_times" name="renewable_times" placeholder="Renewable Times"
                    value="<?= $values["renewable_times"] ?? "1" ?>">
                <?php Component('FormShared/Error', $errors["renewable_times"] ?? "") ?>
            </div>

            <div class="mt-4">
                <label class="label" for="overdue_rate">Overdue Rate (per day)</label>
                <input x-mask:dynamic="$money($input)" class="input w-full" type="text" id="overdue_rate" name="overdue_rate" placeholder="Overdue Rate"
                    value="<?= $values["overdue_rate"] ?? "0.35" ?>">
                <?php Component('FormShared/Error', $errors["overdue_rate"] ?? "") ?>
            </div>
        </div>
    </div>

    <div class="flex my-6 justify-center">
        <button class="btn btn-secondary w-full md:w-1/3 max-w-none md:max-w-lg btn-active mt-8 btn-md" type="submit">Insert new book</button>
    </div>
</form>