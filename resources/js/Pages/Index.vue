<template>
    <div>
        <teleport to="head">
            <title>{{ title('Dashboard') }}</title>
        </teleport>
        <h1 class="mb-8 font-bold text-3xl">Dashboard</h1>
        <p class="mb-8 leading-normal">Hey there! Welcome to KeizerPHP! This tool can be used to manage your Keizer Competition online!</p>
        <div class="mb-8 flex">
           Here some stats will show up
        </div>
    </div>
</template>

<script>
import Layout from '@/Shared/Layout'
export default {
    name: "Index",
    layout: Layout,
}
</script>
