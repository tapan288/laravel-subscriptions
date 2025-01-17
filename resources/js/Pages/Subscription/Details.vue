<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryLink from "@/Components/PrimaryLink.vue";

defineProps({
    plan: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Subscription Details
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                These are the details of your subscription
            </p>
        </header>

        <div class="mt-6 space-y-6">
            <ul>
                <li><strong>Plan</strong>: {{ plan.title }}</li>
                <li><strong>Currency</strong>: {{ plan.currency }}</li>
            </ul>
            <a
                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900"
                v-if="$page.props.auth.user.subscribed"
                :href="route('subscription.portal')"
            >
                Manage Your Subscription
            </a>

            <PrimaryLink
                v-if="!$page.props.auth.user.subscribed"
                :href="route('plans')"
            >
                Choose a Plan
            </PrimaryLink>
        </div>
    </section>
</template>
