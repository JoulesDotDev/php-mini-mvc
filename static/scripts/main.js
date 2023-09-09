function init() {
    document.addEventListener("htmx:configRequest", function (event) {
        event.detail.headers["X-HTMX"] = "TRUE";
    });

    htmx.config.globalViewTransitions = true;
}

document.onload = init();