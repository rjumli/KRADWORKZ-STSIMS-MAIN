<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import FormSection from '@/Shared/Components/Subcomponents/FormSection.vue';
import Multiselect from '@/Shared/Components/Subcomponents/Multiselect.vue';
import InputError from '@/Shared/Components/Subcomponents/InputError.vue';
import InputLabel from '@/Shared/Components/Subcomponents/InputLabel.vue';
import TextInput from '@/Shared/Components/Subcomponents/TextInput.vue';

const props = defineProps({
    user: Object,
    profile: Object
});

const form = useForm({
    _method: 'PUT',
    username: props.user.username,
    email: props.user.email,
    firstname: props.profile.firstname,
    middlename: props.profile.middlename,
    lastname: props.profile.lastname,
    suffix: props.profile.suffix,
    gender: props.profile.gender,
    mobile: props.profile.mobile,
});

const verificationLinkSent = ref(null);

const updateProfileInformation = () => {
    form.post('/user/profile-information', {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => '',
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation" title="Profile Information" description="Update your account's profile information and email address.">

        <template #form>    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                       <input ref="input" class="form-control text-muted" v-model="form.username" @input="$emit('update:modelValue', $event.target.value)" style="min-height: 38.4px !important;" readonly>
                        <InputLabel for="username" value="Username" />
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="mb-3" v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                        <InputLabel for="email" value="Email" />
                        <div class="input-group">
                            <input type="text" v-model="form.email" class="form-control" aria-label="Email" style="min-height: 38.4px !important;">
                            <Link href="/email/verification-notification" method="post" as="button" @click.prevent="sendEmailVerification" class="btn btn-warning w-xl" type="button" style="height: 38px !important;" :disabled="form.processing">Verify Email</Link>
                        </div>
                    </div>
                    <div class="form-floating mb-3" v-else>
                        <TextInput id="email" v-model="form.email" type="email" required autocomplete="username" :class="{ 'is-invalid': form.errors.email }" />
                        <InputLabel for="email" value="Email" />
                        <!-- <InputError :message="form.errors.email" class="mt-2" /> -->
                    </div>
                        <!-- <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form.email" type="email" required autocomplete="username" :class="{ 'is-invalid': form.errors.email }" />
                        <InputError :message="form.errors.email" class="mt-2" />

                        <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                            <p class="text-sm mt-2 text-muted">
                                Your email address is unverified.

                                <Link href="/email/verification-notification" method="post" as="button" class="btn btn-sm btn-warning" @click.prevent="sendEmailVerification">
                                Click here to re-send the verification email.
                                </Link>
                            </p>

                            <div v-show="verificationLinkSent" class="alert alert-success text-success">
                                A new verification link has been sent to your email address.
                            </div>
                        </div> -->
                </div>
                <div class="col-md-12">
                    <hr class="text-muted mt-0 mb-0"/>
                </div>
                <div class="col-md-3 mt-2">
                     <div class="form-floating mt-2">
                        <TextInput id="firstname" v-model="form.firstname" type="text" autocomplete="firstname" :class="{ 'is-invalid': form.errors.firstname }" />
                        <InputLabel for="firstname" value="Firstname" />
                        <!-- <InputError :message="form.errors.firstname" class="mt-2" /> -->
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-floating mt-2">
                        <TextInput id="middlename" v-model="form.middlename" type="text" required autocomplete="middlename" :class="{ 'is-invalid': form.errors.middlename }" />
                        <InputLabel for="middlename" value="Middlename" />
                        <!-- <InputError :message="form.errors.middlename" class="mt-2" /> -->
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-floating mt-2">
                        <TextInput id="lastname" v-model="form.lastname" type="text" required autocomplete="lastname" :class="{ 'is-invalid': form.errors.lastname }" />
                        <InputLabel for="lastname" value="Lastname" />
                        <!-- <InputError :message="form.errors.lastname" class="mt-2" /> -->
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-floating mt-2">
                        <TextInput id="suffix" v-model="form.suffix" type="text" autocomplete="suffix" :class="{ 'is-invalid': form.errors.suffix }" />
                        <InputLabel for="suffix" value="Suffix" />
                        <!-- <InputError :message="form.errors.suffix" class="mt-2" /> -->
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating mt-2">
                        <TextInput id="mobile" v-model="form.mobile" type="text" required autocomplete="suffix" :class="{ 'is-invalid': form.errors.mobile }" />
                        <InputLabel for="mobile" value="Mobile" />
                        <!-- <InputError :message="form.errors.mobile" class="mt-2" /> -->
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="form-floating mt-2">
                        <!-- <Multiselect :options="['Male','Female']" v-model="form.gender" :message="form.errors.gender" placeholder="Select Gender"/> -->
                         <select v-model="form.gender" class="form-select" id="floatingSelect">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <InputLabel for="gender" value="Gender" />
                        <!-- <InputError :message="form.errors.gender" class="mt-2" /> -->
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <div class="d-flex justify-content-end" style="bottom: 0;">
            <BButton variant="primary w-lg float-end" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</BButton>
            </div>
            
            <p v-if="form.recentlySuccessful" class="alert alert-info mt-3">Profile Saved.</p>
        </template>
    </FormSection>
</template>