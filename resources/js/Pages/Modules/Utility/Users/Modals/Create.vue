<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" title="Test" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                 
                  <div class="text-center mb-4 pt-2">
                    <div class="position-relative d-inline-block">
                      <div class="position-absolute bottom-0 end-0">
                        <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right"
                          title="Select Member Image">
                          <div class="avatar-xs">
                            <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                              <i class="ri-image-fill"></i>
                            </div>
                          </div>
                        </label>
                        <input class="form-control d-none" value="" id="member-image-input" type="file"
                          accept="image/png, image/gif, image/jpeg">
                      </div>
                      <div class="avatar-lg">
                        <div class="avatar-title bg-light rounded-circle">
                          <img src="@assets/images/users/user-dummy-img.jpg" id="member-img"
                            class="avatar-md rounded-circle h-auto" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-floating mb-n1">
                            <input type="text" class="form-control" id="designation" placeholder="Please enter firstname" required>
                            <label for="designation" class="form-label">Firstname</label>
                            <div class="invalid-feedback">Please enter firstname</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-n1">
                            <input type="text" class="form-control" id="designation" placeholder="Please enter firstname" required>
                            <label for="designation" class="form-label">Lastname</label>
                            <div class="invalid-feedback">Please enter firstname</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="designation" placeholder="Please enter firstname" required>
                            <label for="designation" class="form-label">Email</label>
                            <div class="invalid-feedback">Please enter firstname</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="designation" placeholder="Please enter firstname" required>
                            <label for="designation" class="form-label">Mobile</label>
                            <div class="invalid-feedback">Please enter firstname</div>
                        </div>
                    </div>
                    
                  </div>
                </BCol>
              </BRow>
        </form>
        <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>{{type}}</b-button>
        </template>
    </b-modal>
</template>
<script>
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
export default {
    props: ['agencies'],
    components : { Multiselect },
    data(){
        return {
            currentUrl: window.location.origin,
            user: {
                id: '',
                email: '',
                avatar: '',
                role: null,
                username: '',
                agency: ''
            },
            profile: {
                id:'',
                firstname: '',
                lastname: '',
                middlename: '',
                suffix: '',
                gender: '',
                mobile: '',
            },
            form: {},
            type: '',
            showModal: false,
            showProvince: false,
            showSchool: false,
            editable: false
        }
    },
    watch: {
        'user.agency'(){
            if(this.user.agency){
                this.profile.firstname = this.user.agency.acronym;
                this.profile.lastname = this.user.agency.code;
                this.profile.middlename = 'M';
                this.user.email = this.user.agency.acronym+'@gmail.com';
                this.user.username = this.user.agency.acronym;
                this.profile.gender = 'M';
                this.profile.mobile = '091234567'+this.user.agency.id;
            }
        }
    },
    methods: {
        create() {
            this.form = this.$inertia.form({
                id: this.user.id,
                username: this.user.username,
                firstname: this.profile.firstname,
                lastname: this.profile.lastname,
                middlename: this.profile.middlename,
                suffix: this.profile.suffix,
                email: this.user.email,
                mobile: this.profile.mobile,
                gender: this.profile.gender,
                role: this.user.role,
                agency_id: (this.user.agency) ? this.user.agency.id : '',
                editable: this.editable
            })

            if(!this.editable){
                this.form.post('/staffs/lists',{
                    forceFormData: true,
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    }
                });
            }else{
                this.form.put('/staffs/lists/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    }
                });
            }
        },
        show(){
            this.user = {},
            this.type = 'Create';
            this.editable = false;
            this.showModal = true;
        },
        edit(data){
            this.editable = true;
            this.user = data;
            this.profile = data.profile;
            this.type = 'Update';
            this.showModal = true;
        },
        hide(){
            this.form = {};
            this.user = {};
            this.profile = {};
            this.showModal = false;
            this.editable = false;
        },
        previewImage(e) {
            var preview = document.querySelector(".user-profile-image");
            var file = document.querySelector(".profile-img-file-input").files[0];
            var reader = new FileReader();
            reader.addEventListener("load", function () { preview.src = reader.result; }, false);
            reader.onload = (e) => { this.user.avatar = e.target.result; };
            if (file) { reader.readAsDataURL(file); }
        },
    }
}
</script>
<style>
.multiselect__single {
    font-size: 12px;
}
</style>