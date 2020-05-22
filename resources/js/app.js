const _ = require('lodash');
import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'
import 'alpinejs'

import VueToast from 'vue-toast-notification';
import vClickOutside from 'v-click-outside'
import SubmitButton from './components/_elements/SubmitButton'
import ActionButton from "./components/_elements/ActionButton";
import FormError from "./components/_elements/FormError";
import VueConfirmDialog from "vue-confirm-dialog";
import mixin from "./mixins/mixin";
import VuejsDialog from 'vuejs-dialog';

Vue.use(VueToast, {position: 'top', duration: 4000});
Vue.use(VueConfirmDialog, {auth: false, button: {no: 'No', yes: 'Yes'}});
Vue.use(VuejsDialog, {
    okText: 'Yes',
    cancelText: 'No',
    animation: 'bounce'
});

Vue.directive('click-outside', vClickOutside.directive);
Vue.component('submit-button', SubmitButton);
Vue.component('action-button', ActionButton);
Vue.component('form-error', FormError);

Vue.config.productionTip = false;
Vue.mixin(mixin);

/* eslint-disable no-new */
new Vue({
    i18n,
    store,
    router,
    ...App
});
