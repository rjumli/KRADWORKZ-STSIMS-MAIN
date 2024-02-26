<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Shared/Components/Subcomponents/FormSection.vue';
import InputError from '@/Shared/Components/Subcomponents/InputError.vue';
import InputLabel from '@/Shared/Components/Subcomponents/InputLabel.vue';
import TextInput from '@/Shared/Components/Subcomponents/TextInput.vue';
import Password from '../Modals/Password.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put('/user/password', {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <FormSection @submitted="updatePassword" title="Password & Security" description="Ensure your account is using a long, random password to stay secure.">
        <template #form>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-1 fs-14 text-primary">Login & Recovery</h5>
                    <p class="text-muted fs-12">Manage your passwords, login preferences and recovery methods.</p>
                    <b-list-group>
                        <BListGroupItem tag="button" class="list-group-item-action"><i class="ri-lock-password-fill me-2"></i>Change Password</BListGroupItem>
                        <BListGroupItem tag="button" class="list-group-item-action"><i class="ri-shield-keyhole-fill me-2"></i>Two-factor Aunthentication</BListGroupItem>
                        <BListGroupItem tag="button" class="list-group-item-action"><i class="ri-window-fill me-2"></i>Browser Sessions</BListGroupItem>
                    </b-list-group>
                </div>
                 <div class="col-md-6">
                    <h5 class="mb-1 fs-14 text-primary">Security Checks</h5>
                    <p class="text-muted fs-12">Review security issues by running checks across apps, devices and emails sent.</p>
                    <b-list-group>
                        <BListGroupItem tag="button" class="list-group-item-action"><i class="ri-folder-shield-2-fill me-2"></i>Recovery Codes</BListGroupItem>
                        <BListGroupItem tag="button" class="list-group-item-action"><i class=" ri-alarm-warning-fill me-2"></i>Login Alerts</BListGroupItem>
                        <BListGroupItem tag="button" class="list-group-item-action"><i class="ri-error-warning-fill me-2"></i>Security Checkup</BListGroupItem>
                    </b-list-group>
                </div>
                <div class="col-md-12">
                    <!-- <hr class="text-muted mt-4"/> -->
                    <div class="mt-4 mb-3 border-bottom border-top pt-3 pb-2">
                        <div class="float-end">
                            <a class="link-primary" href="javascript:void(0);">All Logout</a>
                        </div>
                        <h5 class="card-title fs-13 text-primary">Login History</h5>
                    </div>
                </div>
            </div>
        </template>

        <!-- <template #actions>
            <BButton variant="success w-100" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</BButton>
            <p v-if="form.recentlySuccessful" class="alert alert-success mt-3">Password Updated.</p>
        </template> -->
    </FormSection>
    <Password ref="password"/>
</template>
