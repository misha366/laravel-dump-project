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
