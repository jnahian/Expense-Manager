import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import {AlertError, AlertSuccess, HasError} from 'vform'
import TwCard from './TwCard'
import TwButton from './TwButton'
import TwCheckbox from './TwCheckbox'
import SubmitButton from "./_elements/SubmitButton";
import FormError from "./_elements/FormError";

// Components that are registered globaly.
[
    TwCard,
    TwButton,
    TwCheckbox,
    Card,
    Child,
    Button,
    Checkbox,
    HasError,
    AlertError,
    AlertSuccess,
    SubmitButton,
    FormError
].forEach(Component => {
    Vue.component(Component.name, Component)
});
