import './bootstrap';
// bootstrap
import '../css/import.bootstrap.css';
import 'bootstrap';

// bootstrap icons
// npm install bootstrap-icons
import 'bootstrap-icons/font/bootstrap-icons.css';

import '../css/style.css';

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
