<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        OAuth Clients
                    </span>
                    <a class="action-link" tabindex="-1" @click="showCreateClientForm">
                        Create New Client
                    </a>
                </div>
            </div>
            <div class="card-content">
                <!-- Current Clients -->
                <p class="mb-0" v-if="clients.length === 0">
                    You have not created any OAuth clients.
                </p>
                <table class="table" v-if="clients.length > 0">
                    <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Secret</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="client in clients">
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                            {{ client.id }}
                        </td>

                        <!-- Name -->
                        <td style="vertical-align: middle;">
                            {{ client.name }}
                        </td>

                        <!-- Secret -->
                        <td style="vertical-align: middle;">
                            <code>{{ client.secret }}</code>
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link" tabindex="-1" @click="edit(client)">
                                Edit
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link has-text-danger" @click="destroy(client)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Client Modal -->
        <b-modal :active.sync="openModal" class="modal fade" id="modal-create-client" tabindex="-1" role="dialog">

            <div class="modal-card">
                <header class="modal-card-head">
                    <h4 class="modal-card-title">
                        Create Client
                    </h4>
                </header>

                <div class="modal-card-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Create Client Form -->
                    <form role="form">
                        <!-- Name -->
                        <div class="field">

                            <label class="label">Name</label>

                            <div class="control">
                                <input id="create-client-name" type="text" class="input"
                                       @keyup.enter="store" v-model="createForm.name">

                                <span class="help">
                                        Something your users will recognize and trust.
                                    </span>
                            </div>
                        </div>

                        <!-- Redirect URL -->
                        <div class="field">
                            <label class="label">Redirect URL</label>

                            <div class="control">
                                <input type="text" class="input" name="redirect"
                                       @keyup.enter="store" v-model="createForm.redirect">

                                <span class="help">
                                        Your application's authorization callback URL.
                                    </span>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-card-foot">
                    <button type="button" class="button is-danger" data-dismiss="modal">Close</button>

                    <button type="button" class="button is-info" @click="store">
                        Create
                    </button>
                </div>

            </div>
        </b-modal>

        <!-- Edit Client Modal -->
        <b-modal :active.sync="openModal2" class="modal fade" id="modal-edit-client" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Client
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                            <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Client Form -->
                        <form role="form">
                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Name</label>

                                <div class="col-md-9">
                                    <input id="edit-client-name" type="text" class="form-control"
                                           @keyup.enter="update" v-model="editForm.name">

                                    <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Redirect URL</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="redirect"
                                           @keyup.enter="update" v-model="editForm.redirect">

                                    <span class="form-text text-muted">
                                        Your application's authorization callback URL.
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import BModal from "buefy/src/components/modal/Modal";

    export default {
        components: {BModal},
        data() {
            return {
                openModal: false,
                openModal2: false,
                clients: [],
                createForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                },
                editForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                }
            };
        },
        mounted() {
            this.prepareComponent();
        },
        methods: {

            prepareComponent() {
                this.getClients();

            },
            getClients() {

                axios.get('/oauth/clients')
                    .then(response => {
                        this.clients = response.data;
                    });

                console.log("getClients")
            },
            showCreateClientForm() {
                this.openModal = true;
            },
            store() {
                // this.persistClient(
                //     'post', '/oauth/clients',
                //     this.createForm, '#modal-create-client'
                // );

                console.log("store triggered")
            },
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.name = client.name;
                this.editForm.redirect = client.redirect;

                this.openModal2 = true;
            },
            update() {
                // this.persistClient(
                //     'put', '/oauth/clients/' + this.editForm.id,
                //     this.editForm, '#modal-edit-client'
                // );
                console.log("update triggered")
            },

            persistClient(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                        this.getClients();

                        form.name = '';
                        form.redirect = '';
                        form.errors = [];

                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            destroy(client) {
                axios.delete('/oauth/clients/' + client.id)
                    .then(response => {
                        this.getClients();
                    });
            }
        }
    }
</script>
