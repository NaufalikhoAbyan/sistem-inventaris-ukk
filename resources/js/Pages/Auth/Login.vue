<template>
    <div class="bg-primary h-screen flex justify-center items-center">
        <div class="border w-fit p-0 rounded-lg bg-white shadow-md h-3/4 overflow-hidden flex items-center">
            <img src="/images/login-image.jpeg" alt="login image" class="h-full">
            <div class="p-16 text-center">
                <p class="text-2xl">Welcome Back!</p>
                <form @submit.prevent="form.post(route('authenticate'))" class="flex flex-col gap-4 mt-8">
                    <input type="text" placeholder="Enter email address..." class="text-xl p-2 rounded-lg border border-primary-dark placeholder:text-sm" name="email" v-model="form.email">
                    <input type="password" placeholder="password" class="text-xl p-2 rounded-lg border border-primary-dark placeholder:text-sm" name="password" v-model="form.password">
                    <div class="flex gap-2">
                        <input type="checkbox" name="remember" v-model="form.remember">
                        <p>Remember me</p>
                    </div>
                    <div v-if="form.errors">
                        <div class="text-admin-danger font-bold" v-for="error in form.errors">
                            {{error}}
                        </div>
                    </div>
                    <button type="submit" class="button-primary">Login</button>
                </form>
                <div class="bg-black opacity-15 w-full h-[2px] my-4"></div>
                <Link :href="route('register')" class="text-primary-dark">Create an Account!</Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    'email': null,
    'password': null,
    'remember': false,
})
</script>
