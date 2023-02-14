<template>
    <div>
        <div class="row">
            
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-cyan">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-white">Usuarios</h4>
                                <span
                                    class="h2 font-weight-bold mb-0"
                                    v-bind:value="count_users"
                                >
                                    {{ count_users }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div class="card-circle ">
                                    <i class="fas fa-user"></i>
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
                                <h4 class="text-white">Activos</h4>
                                <span
                                    class="h2 font-weight-bold mb-0"
                                    v-bind:value="activeUsers"
                                >
                                    {{ activeUsers }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div class="card-circle ">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-orange">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-white">Baneados</h4>
                                <span
                                    class="h2 font-weight-bold mb-0"
                                    v-bind:value="bannedUsers"
                                >
                                    {{ bannedUsers }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div class="card-circle ">
                                    <i class="fas fa-user-alt-slash"></i>
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
            count_users: "",
            bannedUsers: "",
            activeUsers: "",
        };
    },
    mounted() {
        axios.get("count_users").then((response) => {
            this.count_users = response.data;
        });
        axios.get("bannedUsers").then((response) => {
            this.bannedUsers = response.data;
        });
        axios.get("activeUsers").then((response) => {
            this.activeUsers = response.data;
        });
    },
};
</script>
