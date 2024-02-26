<script setup>
import { Head, useForm } from "@inertiajs/vue3"
import Layout from "@/Shared/Layouts/Main.vue";
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import Security from './Pages/Security.vue';
import Authentication from './Pages/Authentication.vue';
import Activity from './Pages/Activity.vue';
import Overview from './Pages/Overview.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
    logins: Object
});
</script>
<script>
export default {
    layout: null,
    data() {
        return {
            activeTab: 1, 
            form: useForm({
                _method: 'PUT',
                photo: null,
            }),
        };
    },
    methods: {
        show(tab){
            this.activeTab = tab;
        },
        previewImage(e) {
            var fileInput = document.querySelector(".profile-img-file-input");
            var preview = document.querySelector(".user-profile-image");
            var file = fileInput.files[0];
            this.form.photo = file;
            var reader = new FileReader();

            reader.addEventListener("load", () => { 
                preview.src = reader.result;
                this.form.post('/user/profile-information', {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true,
                    onSuccess: () => clearPhotoFileInput(),
                });
            }, false);

            if (file) { 
                reader.readAsDataURL(file); 
            }
        },
    }
}
</script>
<template>
    <Layout>
        <Head title="Profile" />
        <PageHeader title="Profile Information" pageTitle="User" />
        <div class="row">
            <div class="col-md-3">
                <BCard no-body class="">
                    <BCardBody class="p-3" style="height: calc(100vh - 220px); overflow: auto;">
                        <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                            <!-- <img src="@assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image" /> -->
                            <img v-if="$page.props.jetstream.managesProfilePhotos" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <input id="profile-img-file-input" type="file" class="profile-img-file-input" @change="previewImage"/>
                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                <i class="ri-camera-fill"></i>
                                </span>
                            </label>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{ $page.props.user.data.name }}</h5>
                        <p class="text-muted mb-0">Administrator</p>
                        </div>
                        <hr class="text-muted">
                        <b-list-group class="list-group-fill-success mt-4">
                            <BListGroupItem :active="activeTab === 1" href="#" class="list-group-item-action" @click="show(1)">
                                <i class="ri-apps-2-fill align-middle me-2"></i>Overview
                            </BListGroupItem>
                            <BListGroupItem :active="activeTab === 2" href="#" class="list-group-item-action" @click="show(2)">
                                <i class="ri-profile-fill align-middle me-2"></i>Personal Information
                            </BListGroupItem>
                            <BListGroupItem :active="activeTab === 3" href="#" class="list-group-item-action" @click="show(3)">
                                <i class="ri-shield-check-line align-middle me-2"></i>Password & Security
                            </BListGroupItem>
                            <BListGroupItem :active="activeTab === 4" href="#" class="list-group-item-action" @click="show(4)">
                                <i class="ri-shield-keyhole-fill align-middle me-2"></i>Authentication Logs
                            </BListGroupItem>
                            <BListGroupItem :active="activeTab === 5" href="#" class="list-group-item-action" @click="show(5)">
                                <i class="ri-history-line align-middle me-2"></i>Activity Logs
                            </BListGroupItem>
                        </b-list-group>
                    </BCardBody>
                </BCard>

<!--                 
                <BCard no-body class="mt-1">
                    <BCardBody class="mb-n3">
                        <p class="text-muted fs-10">Last Login : {{$page.props.login_at}} ({{$page.props.ip_address}})</p>
                    </BCardBody>
                </BCard> -->
                
            </div>

            <div class="col-md-9" style="margin-top: 6px;">
                <Overview v-if="activeTab === 1"/>
                <UpdateProfileInformationForm v-if="activeTab === 2" :user="$page.props.auth.user" :profile="$page.props.user.data"/>
                <Security v-if="activeTab === 3" :requires-confirmation="confirmsTwoFactorAuthentication" :sessions="sessions" :logins="logins"/>
                <Authentication v-if="activeTab === 4"/>
                <Activity v-if="activeTab === 5"/>
                <!-- <TwoFactorAuthenticationForm v-if="activeTab === 3" :requires-confirmation="confirmsTwoFactorAuthentication" /> -->
                <!-- <LogoutOtherBrowserSessionsForm v-if="activeTab === 4" :sessions="sessions" /> -->
            </div>
        </div>
    </Layout>
</template>