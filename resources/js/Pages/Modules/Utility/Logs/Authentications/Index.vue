<template lang="">
    <PageHeader title="Authentication Logs" pageTitle="Utility" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="file-manager-sidebar">
            <Sidebar />
        </div>
        <div class="file-manager-content w-100 p-4 pb-0" style="height: calc(100vh - 180px); overflow: auto;" ref="box">
            <Count :statistics="statistics" ref="count"/>
            <hr class="text-muted mt-n2"/>
            <Lists ref="lists"/>
        </div>
    </div>
</template>
<script>
import Lists from './Components/Lists.vue';
import Count from './Components/Count.vue';
import Sidebar from './Components/Sidebar.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
export default {
    props: ['statistics'],
    components: { PageHeader, Sidebar, Lists, Count }
}
</script>