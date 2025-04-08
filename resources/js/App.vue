<!-- src/App.vue -->
<template>
    <div class="min-h-screen flex flex-col">
        <header
            class="w-screen left-0 right-0 bg-gray-800 text-white p-4 text-center"
        >
            <h1>Blog Posts</h1>
            <nav class="mt-2">
                <router-link
                    to="/"
                    class="text-white mx-2 no-underline hover:underline router-link-active:font-bold router-link-active:underline"
                >
                    Home
                </router-link>
            </nav>
        </header>

        <main class="flex-1 p-5 w-full box-border">
            <router-view></router-view>
        </main>

        <footer
            class="w-screen left-0 right-0 bg-gray-800 text-white text-center p-4 mt-auto"
        >
            <p>
                &copy; {{ new Date().getFullYear() }}
                <a
                    href="https://anichur.com"
                    target="_blank"
                    class="text-green-500"
                    >Anichur Rahaman</a
                >
            </p>
        </footer>
    </div>
</template>

<script>
export default {
    name: "App",
};
</script>
