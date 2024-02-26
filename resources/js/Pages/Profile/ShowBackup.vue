<script setup>
import { Head } from "@inertiajs/vue3"
import Layout from "@/Shared/Layouts/Main.vue";
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>
<script>
export default {
    layout: null
}
</script>
<template>
    <Layout>
        <Head title="Profile" />
        <PageHeader title="Profile Information" pageTitle="User" />

        <div>
            <BRow class="justify-content-center">
                <BCol lg="6">
                    <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                        <UpdateProfileInformationForm :user="$page.props.auth.user" />
                    </div>

                    <div v-if="$page.props.jetstream.canUpdatePassword">
                        <UpdatePasswordForm />
                    </div>

                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                        <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" />
                    </div>

                    <LogoutOtherBrowserSessionsForm :sessions="sessions" />

                    <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <DeleteUserForm />
                    </template>
                </BCol>
            </BRow>
        </div>
    </Layout>
</template>
