// Configure Axios globalement pour les requêtes AJAX
import axios from 'axios';
window.axios = axios;

// En-tête par défaut pour identifier les requêtes AJAX côté serveur
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
