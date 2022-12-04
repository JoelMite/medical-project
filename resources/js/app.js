import './bootstrap';

//import '../sass/app.scss'

//import * as bootstrap from 'bootstrap'

import {createApp} from "vue";
import Welcome from '@/components/Welcome.vue'
import CreateMedicalAppointmentComponent from '@/components/CreateMedicalAppointmentComponent.vue'

const app = createApp({})

app.component('welcome', Welcome)
app.component('CreateMedicalAppointmentComponent', CreateMedicalAppointmentComponent)

app.mount("#app")

