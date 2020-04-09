import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'
import 'alpinejs'

import vClickOutside from 'v-click-outside'
import SubmitButton from './components/_elements/SubmitButton'
import FormError from "./components/_elements/FormError";

Vue.directive('click-outside', vClickOutside);

Vue.component('submit-button', SubmitButton);
Vue.component('form-error', FormError);

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
    i18n,
    store,
    router,
    ...App
});
