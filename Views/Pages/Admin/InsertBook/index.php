<?php
$values = _CONTEXT("result", "values") ?? [];
$errors = _CONTEXT("result", "errors") ?? [];
$borrowable = json_encode($values["borrowable"] ?? true);
?>

<h1 class="text-5xl font-bold text-center my-10 md:my-20">New Book</h1>

<form action="/admin/book/insert" method="POST" enctype="multipart/form-data">
    <?= csrf() ?>
    <?= action("admin:insert-book") ?>

    <div
        x-data="{ borrowable: <?= $borrowable ?> }"
        class="card bg-neutral card-compact w-full bg-base-100 shadow-xl h-min p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label" for="author">Author</label>
                <?php Component('AuthorSearch') ?>
                <?php Component('FormShared/Error', $errors["author_id"] ?? "") ?>
            </div>

            <div class=" mb-4">
                <label class="label" for="isbn">ISBN</label>
                <?php Component('IsbnSearch') ?>
                <?php Component('FormShared/Error', $errors["isbn"] ?? "") ?>
            </div>
        </div>
        <div class="divider"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="label" for="name">Name</label>
                <input class="input w-full" type="text" id="name" autocomplete="off" name="name" placeholder="Name" value="<?= $values["name"] ?? "" ?>">
                <?php Component('FormShared/Error', $errors["name"] ?? "") ?>
            </div>

            <div class="">
                <label class="label" for="amount">Amount</label>
                <input x-mask="99" class="input w-full" type="text" id="amount" name="amount" placeholder="Amount" value="<?= $values["amount"] ?? "1" ?>">
                <?php Component('FormShared/Error', $errors["amount"] ?? "") ?>
            </div>
        </div>
        <div class="divider"></div>
        <div class="w-40">
            <label class="label cursor-pointer" for="borrowable">
                <input
                    x-model="borrowable"
                    type="checkbox" id="borrowable" name="borrowable" class="checkbox" />
                <span class="label-text text-lg">Borrowable</span>
            </label>
        </div>

        <div class="divider" x-show="borrowable"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="" x-show="borrowable">
                <label class="label" for="borrow_days">Borrow Days</label>
                <input x-mask="99" class="input w-full" type="text" id="borrow_days" name="borrow_days" placeholder="Borrow Days"
                    value="<?= $values["borrow_days"] ?? "14" ?>">
                <?php Component('FormShared/Error', $errors["borrow_days"] ?? "") ?>
            </div>

            <div class="" x-show="borrowable">
                <label class="label" for="renewable_times">Renewable Times (for 1 more week)</label>
                <input x-mask="9" class="input w-full" type="text" id="renewable_times" name="renewable_times" placeholder="Renewable Times"
                    value="<?= $values["renewable_times"] ?? "1" ?>">
                <?php Component('FormShared/Error', $errors["renewable_times"] ?? "") ?>
            </div>

            <div class="" x-show="borrowable">
                <label class="label" for="overdue_rate">Overdue Rate (per day)</label>
                <input x-mask:dynamic="$money($input)" class="input w-full" type="text" id="overdue_rate" name="overdue_rate" placeholder="Overdue Rate"
                    value="<?= $values["overdue_rate"] ?? "0.35" ?>">
                <?php Component('FormShared/Error', $errors["overdue_rate"] ?? "") ?>
            </div>
        </div>

        <div class="divider mb-1"></div>
        <label class="label mb-1" for="cover">Cover</label>
        <div x-data="imagePreview()" x-init="setImage" class="block md:flex items-start">
            <div class="w-full md:w-1/2">
                <input
                    hx-preserve="true"
                    x-ref="input" @change="fileChosen"
                    name="cover" id="cover"
                    type="file"
                    class="file-input file-input-secondary border-0 focus:outline-0"
                    accept="image/jpeg, image/png" />
                <?php Component('FormShared/Error', $errors["cover"] ?? "") ?>
            </div>
            <template x-if="imageUrl">
                <div x-show="imageUrl" class="flex w-full mt-8 md:mt-0 md:w-1/2 justify-center relative">
                    <button @click="clearImage" type="button" class="btn btn-error btn-active h-10 w-12 absolute top-0 left-0 md:left-6">
                        <i class="bi bi-x-lg text-white font-bold text-xl"></i>
                    </button>
                    <img :src="imageUrl" class="w-full md:w-1/2 h-auto md:ml-20" />
                </div>
            </template>
        </div>
    </div>

    <div class="flex mt-6 justify-center">
        <button class="btn btn-secondary w-2/3 md:w-1/3 max-w-none md:max-w-lg btn-active mt-8 btn-md" type="submit">Insert new book</button>
    </div>
</form>