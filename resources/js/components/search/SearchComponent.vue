<template>
    <MountingPortal
        mountTo="#search-compo">
        <template v-if="showInput">
            <input aria-label="Search" class="form-control form-control-dark w-100" placeholder="Search" type="text" name="keywords"
                   v-on:blur="toggleInput">
        </template>
        <template v-else>
            <svg class="mx-3" fill="none" height="20" stroke="currentColor" stroke-linecap="round"
                 stroke-linejoin="round"
                 stroke-width="2" v-on:click="toggleInput" viewBox="0 0 24 24" width="20"
                 xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.5" cy="10.5" r="7.5"></circle>
                <line x1="21" x2="15.8" y1="21" y2="15.8"></line>
            </svg>
        </template>

    </MountingPortal>
</template>

<script>
    export default {
        name: "SearchComponent",
        data() {
            return {
                showInput: false
            }
        },
        methods: {
            toggleInput() {
                this.showInput = !this.showInput
            }
        }
    }
</script>

<style scoped>

</style>
