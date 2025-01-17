<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { router } from "@inertiajs/vue3";
</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Resume</h2>
            <p class="mt-1 text-sm text-gray-600">Resume your subscription</p>
        </header>
        <div class="mt-6 space-y-6">
            <form @submit.prevent="router.post(route('subscription.resume'))">
                <PrimaryButton> Resume subscription </PrimaryButton>
            </form>
        </div>
    </section>
</template>
