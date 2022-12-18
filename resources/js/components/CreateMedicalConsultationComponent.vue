<template>
    <div>
        <!-- Tercer elemento hijo-->
        <div class="form-group">
            <div class="form-group" id="boton-collapse-3">
                <button class="btn btn-primary btn-lg btn-block text-left collapsed" type="button"
                    data-toggle="collapse" data-target="#contenido-btn-3" aria-expanded="false"
                    aria-controls="contenido-btn-3">Prescripción Médica<i
                        class="ni ni-check-bold text-white"></i></button>
            </div>
            <!-- Contenedor -->
            <div class="collapse" id="contenido-btn-3" aria-labelledby="boton-collapse-3" data-parent="#acordeon-01">
                <div class="card" v-for="(input_pm, index_pm) in inputs_pm">
                    <div class="card-body">
                        <label v-show="index_pm == inputs_pm.length - 1">Añadir Item
                            <button type="button" class="btn btn-secondary" @click="additem_pm()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </label>
                        <h4 class="card-title">Item: {{ index_pm + 1 }}

                            <label v-show="index_pm || (!index_pm && inputs_pm.length > 1)"
                                class="float-right">Eliminar Item
                                <button type="button" class="btn btn-danger" @click="deleteitem_pm(index_pm)">
                                    <i class="fa fa-times"></i>
                                </button>
                            </label>
                        </h4>
                        <hr>

                        <div class="form-group">
                            <div class="form-row">

                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Descripción</label>
                                        <textarea v-model="input_pm.description" name="description[]"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Posología</label>
                                        <textarea v-model="input_pm.posology" name="posology[]" class="form-control"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Observaciones</label>
                                        <textarea v-model="input_pm.observations_pres" name="observations_pres[]"
                                            class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cuarto elemento hijo-->
        <div class="form-group">
            <div class="form-group" id="boton-collapse-4">
                <button class="btn btn-dark btn-lg btn-block text-left collapsed" type="button" data-toggle="collapse"
                    data-target="#contenido-btn-4" aria-expanded="false" aria-controls="contenido-btn-4">Pruebas de
                    Laboratorio<i class="ni ni-check-bold text-white"></i></button>
            </div>
            <!-- Contenedor -->
            <div class="collapse" id="contenido-btn-4" aria-labelledby="boton-collapse-4" data-parent="#acordeon-01">
                <div class="card" v-for="(input_pl, index_pl) in inputs_pl">
                    <div class="card-body">
                        <label v-show="index_pl == inputs_pl.length - 1">Añadir Item
                            <button type="button" class="btn btn-secondary" @click="additem_pl()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </label>
                        <h4 class="card-title">Item: {{ index_pl + 1 }}

                            <label v-show="index_pl || (!index_pl && inputs_pl.length > 1)"
                                class="float-right">Eliminar Item
                                <button type="button" class="btn btn-danger" @click="deleteitem_pl(index_pl)">
                                    <i class="fa fa-times"></i>
                                </button>
                            </label>
                        </h4>
                        <hr>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Tipo de Exámen</label>
                                        <input v-model="input_pl.type_of_exam" type="text" name="type_of_exam[]"
                                            class="form-control" required>

                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Cantidad</label>
                                        <input v-model="input_pl.quantity" type="text" name="quantity[]"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-7 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Valoración</label>
                                        <textarea v-model="input_pl.assessment" name="assessment[]" class="form-control"
                                            rows="4" required></textarea>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-control-label">Observaciones</label>
                                        <textarea v-model="input_pl.observations_pru" name="observations_pru[]"
                                            class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
    
<script>
export default {
    data() {
        return {

            inputs_pl: [{
                type_of_exam: '',
                quantity: '',
                assessment: '',
                observations_pru: ''
            }],

            inputs_pm: [{
                description: '',
                posology: '',
                observations_pres: ''
            }]

        };
    },

    methods: {

        additem_pm() {
            this.inputs_pm.push({
                description: '',
                posology: '',
                observations_pres: ''
            });
        },
        deleteitem_pm(index_pm) {
            this.inputs_pm.splice(index_pm, 1);
        },

        additem_pl() {
            this.inputs_pl.push({
                type_of_exam: '',
                quantity: '',
                assessment: '',
                observations_pru: ''
            });
        },
        deleteitem_pl(index_pl) {
            this.inputs_pl.splice(index_pl, 1);
        }

    }
}
</script>t
    