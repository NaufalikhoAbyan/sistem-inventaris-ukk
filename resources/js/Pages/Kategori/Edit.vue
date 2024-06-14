<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('kategori.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Edit Kategori</p>
    </div>

    <form @submit.prevent="form.put(route('kategori.update', props.kategori.id))">
        <div class="card w-full py-4 flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <p class="opacity-75 flex text-xl font-bold">Deskripsi</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="description" v-model="form.deskripsi">
            </div>
            <div class="flex flex-col gap-2">
                <p class="opacity-75 flex text-xl font-bold">Kategori</p>
                <select class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="category" v-model="form.kategori">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="A">A</option>
                    <option value="M">M</option>
                    <option value="BHP">BHP</option>
                    <option value="BTHP">BTHP</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="button-primary w-fit">Edit</button>
                <button @click="form.reset()" class="button-primary bg-admin-warning w-fit">Reset</button>
            </div>
        </div>
        <div v-if="form.errors">
            <div class="text-admin-danger font-bold" v-for="error in form.errors">
                {{error}}
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    'kategori': Object
})

const form = useForm({
    deskripsi: props.kategori.deskripsi,
    kategori: props.kategori.kategori
})
</script>
