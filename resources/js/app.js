import Vue from 'vue'
// import store from './store'
import router from './router'
import App from './components/App'

Vue.config.productionTip = true;
new Vue({
    // store,
    router,
    ...App
});
