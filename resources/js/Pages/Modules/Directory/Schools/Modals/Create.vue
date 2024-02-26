<template>
    <b-modal v-model="showModal" size="lg" header-class="p-3 bg-light" :title="(!editable) ? 'Create School' : 'Edit School'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
        <form class="customform">
            <BRow>
                <BCol lg="12">
                    <div>
                        <h6 class="mb-1">General Information</h6>
                        <p class="text-muted fs-11 mt-n1">A structured program of study offered by an educational institution.</p>
                    </div>
                    <div>
                        <BRow class="g-3">
                            <BCol lg="12"><hr class="text-muted mt-n1 mb-n4"/></BCol>
                            <BCol lg="12" class="mt-1 mb-n1">
                                <InputLabel for="campus" value="School" />
                                <TextInput id="campus" v-model="form.campus" type="text" class="form-control" autofocus placeholder="Please enter campus" autocomplete="campus" required :class="{ 'is-invalid': form.errors.campus }" @input="handleInput('campus')" :light="true"/>
                                <InputError :message="form.errors.campus" />
                            </BCol>
                            <BCol lg="12"><hr class="text-muted mt-n1 mb-n4"/></BCol>
                            <BCol lg="8" class="mt-1 mb-n1">
                                <InputLabel for="campus" value="Campus" />
                                <TextInput id="campus" v-model="form.campus" type="text" class="form-control" autofocus placeholder="Please enter campus" autocomplete="campus" required :class="{ 'is-invalid': form.errors.campus }" @input="handleInput('campus')" :light="true"/>
                                <InputError :message="form.errors.campus" />
                            </BCol>
                            <BCol lg="4" class="mt-1 mb-n1">
                                <InputLabel for="address" value="Address" />
                                <TextInput id="address" v-model="form.address" type="text" class="form-control" autofocus placeholder="Please enter address" autocomplete="address" required :class="{ 'is-invalid': form.errors.address }" @input="handleInput('address')" :light="true"/>
                                <InputError :message="form.errors.address" />
                            </BCol>
                            <BCol lg="4" class="mt-1">
                                <InputLabel for="region" value="Region" />
                                <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/>
                                <InputError :message="form.errors.abbreviation" />
                            </BCol>
                            <BCol lg="4" class="mt-1">
                                <InputLabel for="province" value="Province" />
                                <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/>
                                <InputError :message="form.errors.others" />
                            </BCol>
                            <BCol lg="4" class="mt-1">
                                <InputLabel for="municipality" value="Municipality" />
                                <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/>
                                <InputError :message="form.errors.others" />
                            </BCol>
                             <BCol lg="4" class="mt-1">
                                <InputLabel for="municipality" value="Term Type" />
                                <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/>
                                <InputError :message="form.errors.others" />
                            </BCol>
                             <BCol lg="4" class="mt-1">
                                <InputLabel for="municipality" value="Grading Type" />
                                <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/>
                                <InputError :message="form.errors.others" />
                            </BCol>
                             <BCol lg="4" class="mt-1">
                                <InputLabel for="municipality" value="Assigned Region" />
                                <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/>
                                <InputError :message="form.errors.others" />
                            </BCol>
                            <BCol lg="12"><hr class="text-muted mt-n1 mb-n3"/></BCol>
                            <BCol lg="8"  style="margin-top: 13px; margin-bottom: -12px;" class="fs-12">Is the campus name the only affiliated with the school?</BCol>
                            <BCol lg="4"  style="margin-top: 13px; margin-bottom: -12px;">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" :value="true" v-model="form.has_child">
                                            <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="customRadio2" class="custom-control-input me-2" :value="false" v-model="form.has_child">
                                            <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </BCol>
                            <BCol lg="12"><hr class="text-muted mt-n1 mb-n3"/></BCol>
                            <BCol lg="8"  style="margin-top: 13px; margin-bottom: -12px;" class="fs-12">Does your menu have a child menu?</BCol>
                            <BCol lg="4"  style="margin-top: 13px; margin-bottom: -12px;">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="customRadio1" class="custom-control-input me-2" :value="true" v-model="form.has_child">
                                            <label class="custom-control-label fw-normal fs-12" for="customRadio1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="customRadio2" class="custom-control-input me-2" :value="false" v-model="form.has_child">
                                            <label class="custom-control-label fw-normal fs-12" for="customRadio2">No</label>
                                        </div>
                                    </div>
                                </div>
                            </BCol>
                            <BCol lg="12"><hr class="text-muted mt-n1 mb-n3"/></BCol>
                        </BRow>
                    </div>    
                </BCol>
            </BRow>
        </form>
          <template v-slot:footer>
            <b-button @click="hide()" variant="light" block>Cancel</b-button>
            <b-button @click="submit('ok')" variant="primary" :disabled="form.processing" block>Submit</b-button>
        </template>
    </b-modal>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import Multiselect from '@/Shared/Components/Subcomponents/Multiselect.vue';
import InputError from '@/Shared/Components/Subcomponents/InputError.vue';
import InputLabel from '@/Shared/Components/Subcomponents/InputLabel.vue';
import TextInput from '@/Shared/Components/Subcomponents/TextInput.vue';
export default {
    components: { InputError, InputLabel, TextInput, Multiselect },
    data(){
        return {
            currentUrl: window.location.origin,
            form: useForm({
                id: null,
                campus: null,
                address: null,
                region: null,
                province: null,
                municipality: null,
                assigned: null,
                is_main: null,
                is_alone: null,
                school_id: null
            }),
            showModal: false,
            editable: false
        }
    },
    methods: { 
        show(){
            this.showModal = true;
        },
        edit(data){
            this.form.id = data.id
            this.form.name = data.name;
            this.form.shortcut = data.shortcut;
            this.form.abbreviation = data.abbreviation;
            this.form.others = data.others;
            this.editable = true;
            this.showModal = true;
        },
        submit(){
            if(this.editable){
                this.form.put('/directory/courses/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    }
                });
            }else{
                this.form.post('/directory/courses',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    },
                });
            }
        },
        handleInput(field) {
            this.form.errors[field] = false;
        },
        hide(){
            this.form.reset();
            this.form.clearErrors();
            this.editable = false;
            this.showModal = false;
        }
    }
}
</script>