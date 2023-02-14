<template>
    <div>
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-orange">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-white">Citas Reservadas</h4>
                                <span
                                    class="h2 font-weight-bold mb-0"
                                    v-bind:value="pendingAppointments"
                                >
                                    {{ pendingAppointments }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div class="card-circle ">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-green">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-white">Citas Confirmadas</h4>
                                <span
                                    class="h2 font-weight-bold mb-0"
                                    v-bind:value="confirmedAppointments"
                                >
                                    {{ confirmedAppointments }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div class="card-circle ">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-purple">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-white">Citas Atendidas</h4>
                                <span
                                    class="h2 font-weight-bold mb-0"
                                    v-bind:value="attendedAppointments"
                                >
                                    {{ attendedAppointments }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div class="card-circle ">
                                    <i class="fas fa-notes-medical"></i>
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
            pendingAppointments: "",
            confirmedAppointments: "",
            attendedAppointments: "",
        };
    },
    mounted() {
        axios
            .get("pendingAppointments", {
                params: {
                    role: "patient",
                },
            })
            .then((response) => {
                this.pendingAppointments = response.data;
            });
        axios
            .get("confirmedAppointments", {
                params: {
                    role: "patient",
                },
            })
            .then((response) => {
                this.confirmedAppointments = response.data;
            });
        axios
            .get("attendedAppointments", {
                params: {
                    role: "patient",
                },
            })
            .then((response) => {
                this.attendedAppointments = response.data;
            });
    },
};
</script>
