<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Details from "./Details.vue";
import Resume from "./Resume.vue";
import Cancel from "./Cancel.vue";
import Invoices from "./Invoices.vue";

const props = defineProps({
    plan: {
        type: Object,
        required: true,
    },
    upcoming: {
        type: Object,
        required: true,
    },
    subscription: {
        type: Object,
        required: true,
    },
    invoices: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Manage Your Subscription" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Subscription
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <Details
                        :plan="plan"
                        :upcoming="upcoming"
                        :subscription="subscription"
                    />
                </div>

                <template v-if="$page.props.auth.user.subscribed">
                    <div
                        v-if="$page.props.auth.user.subscription_canceled"
                        class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                    >
                        <Resume class="max-w-xl" />
                    </div>

                    <div
                        v-else
                        class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                    >
                        <Cancel class="max-w-xl" />
                    </div>

                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <Invoices class="max-w-xl" :invoices="invoices" />
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
