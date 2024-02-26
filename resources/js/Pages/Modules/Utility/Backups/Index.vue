<template lang="">
    <PageHeader title="Backup and Restore" pageTitle="Utility" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="file-manager-content w-100 p-4 pb-0" style="height: calc(100vh - 180px); overflow: auto;" ref="box">
            <b-row class="g-2 mb-2">
                <b-col md="3">
                    <div class="search-box">
                    <input type="text" class="form-control search" placeholder="Search Date"/>
                    <i class="ri-search-line search-icon"></i>
                    </div>
                </b-col>
                <b-col md="6"></b-col>
                <b-col md="1">
                    <b-button variant="light" class="w-100" @click="openCreate()">Clean</b-button>
                </b-col>
                <b-col md="2">
                    <b-button variant="primary" class="w-100" @click="openGenerate()">Generate Backup</b-button>
                </b-col>
                <b-col md="12">
                    <hr class="text-muted mt-2 mb-2"/>
                </b-col>
            </b-row>
            <b-row id="folderlist-data">
                <b-col v-for="(folder, index) of lists" :key="index" cols="12" xxl="2" class=" folder-card" style="cursor: pointer;" @click="downloadFile(folder.name)">
                    <b-card no-body class="bg-light shadow-none" id="folder-1">
                        <b-card-body class="mt-4">
                            <div class="text-center">
                                <div class="mb-2">
                                    <i class="ri-folder-2-fill align-bottom text-warning display-5"></i>
                                </div>
                                <h6 class="fs-12 folder-name">{{ folder.name }}</h6>
                            </div>
                            <div class="hstack mt-4 text-muted">
                                <span class="me-auto fs-11">{{folder.date}}</span>
                                <span class="fs-11"><b>{{ folder.size }}</b></span>
                            </div>
                        </b-card-body>
                    </b-card>
                </b-col>
            </b-row>
        </div>
    </div>
    <View ref="view"/>
</template>
<script>
import View from './Modals/View.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    components: { PageHeader, View },
    data(){
        return { 
            currentUrl: window.location.origin,
            lists: [],
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        fetch(page_url){
            page_url = page_url || '/utility/backups';
            axios.get(page_url,{params : {option: 'lists'}})
            .then(response => {
                this.lists = response.data;      
            })
            .catch(err => console.log(err));
        },
        openGenerate(){
           this.$refs.view.show();
        },
        downloadFile(filePath) {
            window.open(this.currentUrl+'/utility/backups/'+filePath);
        },
    }
}
</script>