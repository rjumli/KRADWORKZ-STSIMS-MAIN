<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Shared/Components/Subcomponents/FormSection.vue';
import InputError from '@/Shared/Components/Subcomponents/InputError.vue';
import InputLabel from '@/Shared/Components/Subcomponents/InputLabel.vue';
import TextInput from '@/Shared/Components/Subcomponents/TextInput.vue';

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
                    <div class="form-floating mt-2">
                        <TextInput
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="form.current_password"
                            type="password"
                            autocomplete="current-password"
                            :class="{ 'is-invalid': form.errors.current_password }"
                        />
                        <InputLabel for="current_password" value="Current Password" />
                        <!-- <InputError :message="form.errors.current_password" class="mt-2" /> -->
                    </div>
                    <hr class="text-muted mb-2"/>
                    <div class="form-floating mt-3">
                        <TextInput
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            autocomplete="new-password"
                            :class="{ 'is-invalid': form.errors.password }"
                        />
                        <InputLabel for="password" value="New Password" />
                        <!-- <InputError :message="form.errors.password" class="mt-2" /> -->
                    </div>

                    <div class="form-floating mt-2">
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            :class="{ 'is-invalid': form.errors.password_confirmation }"
                        />
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <!-- <InputError :message="form.errors.password_confirmation" class="mt-2" /> -->
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </template>

        <template #actions>
            <BButton variant="success w-100" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</BButton>
            <p v-if="form.recentlySuccessful" class="alert alert-success mt-3">Password Updated.</p>
        </template>
    </FormSection>
</template>
