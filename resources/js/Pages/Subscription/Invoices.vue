<script setup>
defineProps({
    invoices: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Invoices</h2>
            <p class="mt-1 text-sm text-gray-600">These are your invoices</p>
        </header>
        <div class="mt-6 space-y-6">
            <ul>
                <li v-for="invoice in invoices" :key="invoice.id">
                    <strong>{{ invoice.date }}</strong
                    >. {{ invoice.total }}.
                    <a
                        :href="
                            route('invoice.download', {
                                invoice: invoice.id,
                            })
                        "
                        class="text-indigo-500"
                        >Download</a
                    >
                </li>
            </ul>
        </div>
    </section>
</template>
