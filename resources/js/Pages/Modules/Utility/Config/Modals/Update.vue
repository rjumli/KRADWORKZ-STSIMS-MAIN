<template>
    <b-modal v-model="showModal" title="Update .Env" header-class="p-3 bg-light" style="--vz-modal-width: 580px;" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>    
        <div class="mb-n3">
            <div class="alert alert-danger" role="alert">
                <strong>Important:</strong> Modifying the .env file will affect system configuration.
            </div>
           <p class="alert alert-warning fs-12 text-muted" role="alert">
                Please be aware that the .env file contains crucial settings for your application, including database credentials, API keys, and other sensitive information. Making incorrect changes to this file can result in system malfunction or security vulnerabilities.
                <br> <br>
                Before proceeding, ensure you understand the implications of the changes you are making and double-check all information provided.
            </p>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block><i class="ri-save-3-line align-bottom me-1"></i> Save</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            showModal: false,
            form: {},
            variables: ''
        }
    },
    methods : {
        show(data) {
            this.variables = data;
            this.showModal = true;
        },
        create(){
            this.form = this.$inertia.form({
                app_name: this.variables[0].value,
                app_url: this.variables[1].value,
                db_database: this.variables[2].value,
                db_username: this.variables[3].value,
                db_password: this.variables[4].value,
                mail_mailer: this.variables[5].value,
                mail_host: this.variables[6].value,
                mail_port: this.variables[7].value,
                mail_username: this.variables[8].value,
                mail_password: this.variables[9].value,
                mail_encryption: this.variables[10].value,
                type: 'env'
            });

            this.form.post('/utility/config',{
                preserveScroll: true,
                onSuccess: (response) => {
                    this.hide();
                },
            });
        },
        hide(){
            this.showModal = false;
        },
    }
}
</script>
