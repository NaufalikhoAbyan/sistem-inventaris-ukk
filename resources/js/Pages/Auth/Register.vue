<template>
    <div class="bg-primary h-screen flex justify-center items-center">
        <div class="border w-fit p-0 rounded-lg bg-white shadow-md h-3/4 overflow-hidden flex items-center">
            <img src="/images/register-image.jpeg" alt="login image" class="h-full">
            <div class="p-16 text-center">
                <p class="text-2xl">Create an Account!</p>
                <form @submit.prevent="form.post(route('register'))" class="flex flex-col gap-4 mt-8">
                    <input type="text" placeholder="Name" class="text-xl p-2 rounded-lg border border-primary-dark placeholder:text-sm" name="name" v-model="form.name">
                    <input type="text" placeholder="Email Address" class="text-xl p-2 rounded-lg border border-primary-dark placeholder:text-sm" name="email" v-model="form.email">
                    <input type="password" placeholder="Password" class="text-xl p-2 rounded-lg border border-primary-dark placeholder:text-sm" name="password" v-model="form.password">
                    <input type="password" placeholder="Repeat Password" class="text-xl p-2 rounded-lg border border-primary-dark placeholder:text-sm" name="password_confirmation" v-model="form.password_confirmation">
                    <div v-if="form.errors">
                        <div class="text-admin-danger font-bold" v-for="error in form.errors">
                            {{error}}
                        </div>
                    </div>
                    <button type="submit" class="button-primary">Register</button>
                </form>
                <div class="bg-black opacity-15 w-full h-[2px] my-4"></div>
                <Link :href="route('login')" class="text-primary-dark">Already have an account? Login!</Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    'name': null,
    'email': null,
    'password': null,
    'password_confirmation': null
})
</script>
