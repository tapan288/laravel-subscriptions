<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import { router } from "@inertiajs/vue3";
</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Cancel</h2>
            <p class="mt-1 text-sm text-gray-600">Cancel your subscription</p>
        </header>
        <div class="mt-6 space-y-6">
            <form @submit.prevent="router.post(route('subscription.cancel'))">
                <DangerButton> Cancel subscription </DangerButton>
            </form>
        </div>
    </section>
</template>
