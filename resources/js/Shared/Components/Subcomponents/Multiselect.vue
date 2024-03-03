<template>
    <Multiselect class="form-control w-lg" 
    v-model="selectedValues" 
    :options="options" label="name"
    :placeholder="placeholder"
    :searchable="searchable"
    @update:modelValue="emitSelectedValues" 
   :style="'border-color: ' + (message ? '#f06548' : '#ced4da') + ' !important; '"/>
</template>
<script>
import Multiselect from "@vueform/multiselect";
export default {
    components: { Multiselect },
    props: ['options','modelValue','message','placeholder','searchable'],
    data() {
        return {
            selectedValues: this.modelValue
        };
    },
    methods: {
        emitSelectedValues(values) {
            this.selectedValues = values;
            this.$emit('update:modelValue', values); 
        }
    }
}
</script>
<style>
    .multiselect-wrapper {
        background-color: #f5f6f7;
    }
</style>
