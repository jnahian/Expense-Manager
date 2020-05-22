import Vue from 'vue'
import {library} from '@fortawesome/fontawesome-svg-core'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faCalendarAlt, faCog, faList, faLock, faPencilAlt, faPlus, faPowerOff, faSave, faSignOutAlt, faTrash, faUser} from '@fortawesome/free-solid-svg-icons'

import {faGithub} from '@fortawesome/free-brands-svg-icons'

// import { faCalendarAlt } from '@fortawesome/free-regular-svg-icons'

library.add(
    faUser, faLock, faSignOutAlt, faCog, faGithub, faPowerOff, faCalendarAlt, faPencilAlt, faTrash, faSave, faList, faPlus
)

Vue.component('fa', FontAwesomeIcon)
