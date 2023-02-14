import './bootstrap';

//import '../sass/app.scss'

//import * as bootstrap from 'bootstrap'

import {createApp} from "vue";
import Welcome from '@/components/Welcome.vue'
import CreateMedicalAppointmentComponent from '@/components/CreateMedicalAppointmentComponent.vue'
import CreateMedicalConsultationComponent from '@/components/CreateMedicalConsultationComponent.vue'
import TableConfirmedAppointmentComponent from '@/components/TableConfirmedAppointmentComponent.vue'
import TableOldAppointmentComponent from '@/components/TableOldAppointmentComponent.vue'
import TablePendingAppointmentComponent from '@/components/TablePendingAppointmentComponent.vue'
import HomeDashboardAdministratorComponent from '@/components/HomeDashboardAdministratorComponent.vue'
import HomeDashboardDoctorComponent from '@/components/HomeDashboardDoctorComponent.vue'
import HomeDashboardPatientComponent from '@/components/HomeDashboardPatientComponent.vue'

import mitt from 'mitt';
const emitter = mitt();

const app = createApp({})
app.config.globalProperties.emitter = emitter;

app.component('welcome', Welcome)
app.component('CreateMedicalAppointmentComponent', CreateMedicalAppointmentComponent)
app.component('CreateMedicalConsultationComponent', CreateMedicalConsultationComponent)
app.component('TableConfirmedAppointmentComponent', TableConfirmedAppointmentComponent)
app.component('TableOldAppointmentComponent', TableOldAppointmentComponent)
app.component('TablePendingAppointmentComponent', TablePendingAppointmentComponent)
app.component('HomeDashboardAdministratorComponent', HomeDashboardAdministratorComponent)
app.component('HomeDashboardDoctorComponent', HomeDashboardDoctorComponent)
app.component('HomeDashboardPatientComponent', HomeDashboardPatientComponent)

app.mount("#app")

