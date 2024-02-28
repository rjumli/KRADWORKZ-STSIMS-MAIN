<template>
    <b-modal v-model="showModal" header-class="p-3 bg-light" :title="(!editable) ? 'Create School' : 'Edit School'" class="v-modal-custom" modal-class="zoomIn" centered no-close-on-backdrop>
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
                            <BCol lg="12" class="mt-1 mb-0">
                                <Multiselect class="form-control" @search-change="checkSearchStr"
                                    placeholder="Select School" label="name" trackBy="name"
                                    v-model="school" :close-on-select="true" 
                                    :searchable="true" :options="schools"/>
                                <InputError :message="form.errors.campus" />
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
import _ from 'lodash';
import { useForm } from '@inertiajs/vue3';
import Multiselect from "@vueform/multiselect";
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
                region_code: null,
                province_code: null,
                municipality_code: null,
                assigned_region: null,
                is_main: null,
                is_alone: null,
                school_id: null
            }),
            schools: [],
            courses: [],
            showModal: false,
            editable: false
        }
    },
    methods: { 
        show(){
            this.showModal = true;
        },
        submit(){
            if(this.editable){
                this.form.put('/directory/schools/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    }
                });
            }else{
                this.form.post('/directory/schools',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.hide();
                    },
                });
            }
        },
        checkSearchStr: _.debounce(function(string) {
            this.fetchSchool(string);
        }, 300),
        fetchSchool(value) {
            axios.get(this.currentUrl + '/directory/schools', {
                params : {
                    keyword: value,
                    option: 'dropdowns'
                }
            })
            .then(response => {
                this.schools = response.data;
            })
            .catch(err => console.log(err));
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
<style>
.multiselect-search {
  background: #f5f6f7 !important;
}
</style>