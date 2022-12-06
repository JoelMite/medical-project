<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="form-control-label">Especialidad</label>
                <select v-model="selected_specialty" @change="loadDoctors" class="form-control selectpicker" name="specialty_id" id="specialty" data-style="btn-secondary" required>
                    <option value="">Seleccione una especialidad</option>
                    <option v-for="specialty in specialties" v-bind:value="specialty.id">
                        {{ specialty.name }}
                    </option>
    
                </select>
            </div>
    
            <div class="form-group col-md-4">
                <label class="form-control-label">Médico</label>
                <select v-model="selected_doctor" class="form-control" name="doctor_id" id="doctor" required>
                    <option value="">Seleccione un médico</option>
                    <option v-for="(doctor) in doctors" v-bind:value="doctor.id">
                        {{ doctor.name }}
                    </option>
    
                </select>
            </div>
    
        <div class="form-group col-md-4">
            <label class="form-control-label">Fecha</label>
            
            <div class="input-group">
                    
                    <date-picker input-class ="form-control class-date"  id="schedule_date" name="schedule_date" @change="loadHours" placeholder="Seleccionar fecha" v-model:value="selected_date" value-type="format" format="YYYY-MM-DD"></date-picker>
                
            </div>
            
        </div>
        </div>
    
        <div class="form-group">
            <label class="form-control-label">Hora de Atención</label>
            <div v-if="intervals.length == 0 && boolean == false" class="alert alert-info" role="alert">
                Seleccione un médico y una fecha para ver sus horarios disponibles.
            </div>
            <div v-else-if="boolean == true" class="alert alert-danger" role="alert">
                <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el medico en el dia seleccionado.
            </div>
            <div v-else>
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="form-control-label">Turno-Tarde</label>
                        <div v-for="(item, index) in afternoon" class="custom-control custom-radio mb-3">
                            <input name="schedule_time" v-model="selected_interval" v-bind:value="item.start" class="custom-control-input" v-bind:id="'afternoon'+index" type="radio" required>
                            <label class="custom-control-label" v-bind:for="'afternoon'+index">
                                {{ item.start }} - {{ item.end }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-control-label">Turno-Mañana</label>
                        <div v-for="(item, index) in morning" class="custom-control custom-radio mb-3">
                            <input name="schedule_time" v-model="selected_interval" v-bind:value="item.start" class="custom-control-input" v-bind:id="'morning'+index" type="radio" required>
                            <label class="custom-control-label" v-bind:for="'morning'+index">
                                {{ item.start }} - {{ item.end }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </template>
    
    <script>
    
    import DatePicker from 'vue-datepicker-next';
  import 'vue-datepicker-next/index.css';
    
    export default {
      components: { DatePicker },
        data() {
            return {
                selected_specialty: '',
                selected_doctor: '',
                selected_date: '',
                disableDatePicker: '',
                selected_interval: '',
                boolean: false,
                doctors: [],
                specialties: [],
                intervals: [],
                afternoon: [],
                morning: [],
                options: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                },
            };
        },
    
        mounted() {
            document.getElementById("doctor").disabled = false;
    
         
    
             this.disableDatePicker = true; 
            
            axios.get('get/specialtiesAll')
                .then((response) => {
                    this.specialties = response.data;
                });
    
          
        },
    
        methods: {
            loadDoctors() {
                this.selected_doctor = '';
    
                document.getElementById("doctor").disabled = true;
    
                if (this.selected_specialty != '') {
                    axios.get('get/doctors', {
                            params: {
                                specialty_id: this.selected_specialty
                            }
                        })
                        .then((response) => {
                            this.doctors = response.data;
                            document.getElementById("doctor").disabled = false;
                            this.disableDatePicker = false;
                        });
                }
    
            },
    
            loadHours() {
                this.selected_interval = '';
                this.intervals = [];
                this.afternoon = [];
                this.morning = [];
    
                if (this.selected_date != '') {
                    axios.get('get/hours', {
                            params: {
                                date: this.selected_date,
                                doctor_id: this.selected_doctor
                            }
                        })
                        .then((response) => {
    
                            this.intervals = response.data;
                            if (this.intervals.length == 0) {
                                this.boolean = true;
                            } else {
                                this.boolean = false;
                                this.afternoon = this.intervals.afternoon;
                                this.morning = this.intervals.morning;
                            }
                        });
                }
            }
        }
    }
    </script>

<style>

.class-date {
    padding:10px 15px;height:42px
}

</style>
    