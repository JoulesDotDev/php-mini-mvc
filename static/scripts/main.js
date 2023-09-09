function init() {
    document.addEventListener("htmx:configRequest", function (event) {
        event.detail.headers["X-HTMX"] = "TRUE";
        event.detail.headers["X-CSRF-TOKEN"] = document.querySelector("meta[name='csrf_token']").getAttribute("content");
    });

    htmx.config.globalViewTransitions = true;
}

document.onload = init();