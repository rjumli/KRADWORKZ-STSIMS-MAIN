<template>
    <b-row>
        <b-col lg="4" md="6" v-for="(item, index) of statistics" :key="index">
            <b-card no-body class="bg-light shadow-none border">
                <b-card-body>
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-white rounded-circle fs-3" :class="item.color">
                                <i :class="`bx ${item.icon} align-middle`"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                {{ item.name }}
                            </p>
                            <h4 class="mb-0">
                                <span class="counter-value">
                                {{ item.total }}
                                </span>
                            </h4>
                        </div>
                    </div>
                </b-card-body>
            </b-card>
        </b-col>
    </b-row>
</template>
<script>
export default {
    props:['statistics'],
}
</script>