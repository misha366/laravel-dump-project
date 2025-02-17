import './bootstrap';
// bootstrap
import '../css/import.bootstrap.css';
import 'bootstrap';

import '../css/style.css';

// preloader
window.addEventListener('load', function () {
    document.getElementById('preloader').remove(); 
    document.querySelector('.page').style.display = 'block';
});

// Remove empty parameters from url
function removeEmptyGetParams() {
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);

    const keysToRemove = [];
    for (const [key, value] of params.entries()) {
        if (value === "") {
            keysToRemove.push(key);
        }
    }

    keysToRemove.forEach(key => params.delete(key));

    const newUrl = url.pathname + (params.toString() ? `?${params}` : "");
    window.history.replaceState(null, "", newUrl);
}

removeEmptyGetParams();