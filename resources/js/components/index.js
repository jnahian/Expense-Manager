import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import { HasError, AlertError, AlertSuccess } from 'vform'
import TwCard from './TwCard'
import TwButton from './TwButton'
import TwCheckbox from './TwCheckbox'

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
  AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
})
