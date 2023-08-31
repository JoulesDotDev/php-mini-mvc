document.addEventListener('htmx:configRequest', function (event) {
    event.detail.headers['X-HTMX'] = 'TRUE';
});