<template lang="">
    <PageHeader title="System Configuration" pageTitle="Utility" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="file-manager-content w-100 p-4 pb-0" style="height: calc(100vh - 180px); overflow: auto;" ref="box">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card-body border-bottom pb-4">
                                <form class="customform" @submit.prevent="submit">
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-n3">
                                            <InputLabel for="name" value="Name" required="true"/>
                                            <TextInput id="name" v-model="form.name" type="text" class="form-control" autofocus placeholder="Please enter name" autocomplete="name" required :class="{ 'is-invalid': form.errors.name }" />
                                            <InputError :message="form.errors.name" />
                                        </div>
                                        <div class="col-md-6 mb-n3">
                                            <InputLabel for="acronym" value="Acronym" required="true"/>
                                            <TextInput id="acronym" v-model="form.acronym" type="text" class="form-control" autofocus placeholder="Please enter acronym" autocomplete="acronym" required :class="{ 'is-invalid': form.errors.acronym }" />
                                            <InputError :message="form.errors.acronym" />
                                        </div>
                                        <div class="col-md-6 mb-n3">
                                            <InputLabel for="subname" value="Subname" required="true"/>
                                            <TextInput id="subname" v-model="form.subname" type="text" class="form-control" autofocus placeholder="Please enter subname" autocomplete="subname" required :class="{ 'is-invalid': form.errors.subname }" />
                                            <InputError :message="form.errors.subname" />
                                        </div>
                                        <div class="col-md-12">
                                            <InputLabel for="description" value="Description" required="true"/>
                                            <Textarea id="description" v-model="form.description" type="text" class="form-control" autofocus placeholder="Please enter description" autocomplete="description" required :class="{ 'is-invalid': form.errors.description }" />
                                            <InputError :message="form.errors.description" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body border-start ps-4 mb-4">
                        <div v-for="(list,index) in variables" v-bind:key="index">
                            <div class="input-group mb-2">
                                <div class="input-group-text fs-10 text-muted fw-semibold" style="width: 130px;">{{list.name}}</div>
                                <input type="text" class="form-control" :name="list.name" v-model="list.value">
                            </div>
                            <hr v-if="list.line" class="text-muted"/>
                        </div>
                        <BButton @click="update" variant="light" class="w-100" type="submit">Update .env</BButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Update ref="update"/>
</template>
<script>
import { useForm } from '@inertiajs/vue3';
import Textarea from '@/Shared/Components/Subcomponents/Textarea.vue';
import TextInput from '@/Shared/Components/Subcomponents/TextInput.vue';
import InputError from '@/Shared/Components/Subcomponents/InputError.vue';
import InputLabel from '@/Shared/Components/Subcomponents/InputLabel.vue';
import Update from './Modals/Update.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    props: ['variables','configuration'],
    components: { PageHeader, Update, InputError, InputLabel, TextInput, Textarea },
    data(){
        return { 
            currentUrl: window.location.origin,
            form: useForm({
                name: this.configuration.name,
                acronym: this.configuration.acronym,
                subname: this.configuration.subname,
                description: this.configuration.description
            }),
        }
    },
    methods: {
        update(){
            this.$refs.update.show(this.variables);
        }
    }
}
</script>