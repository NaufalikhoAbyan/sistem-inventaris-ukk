<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang-masuk.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Tambah Barang Masuk</p>
    </div>

    <form @submit.prevent="form.post(route('barang-masuk.store'))">
        <div class="card w-full py-4 flex flex-col gap-4">
            <div class="flex flex-col gap-2">
                <p class="opacity-75 flex text-xl font-bold">Tanggal Masuk</p>
                <input type="date" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="tanggal_masuk" v-model="form.tanggal_masuk">
            </div>
            <div class="flex flex-col gap-2">
                <p class="opacity-75 flex text-xl font-bold">Kuantitas</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="kuantitas_masuk" v-model.number="form.kuantitas_masuk">
            </div>
            <div class="flex flex-col gap-2">
                <p class="opacity-75 flex text-xl font-bold">Item Id</p>
                <select class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="barang_id" v-model="form.barang_id">
                    <option value="" disabled selected>Pilih Barang</option>
                    <option v-for="barangItem in props.barang" :key="barangItem.id" :value="barangItem['id']">{{barangItem['merk']}} {{barangItem['seri']}}</option>
                </select>
            </div>
            <button type="submit" class="button-primary w-fit">Tambah</button>
            <div v-if="form.errors">
                <div class="text-admin-danger font-bold" v-for="error in form.errors">
                    {{error}}
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    'barang': Object
})

const form = useForm({
    'tanggal_masuk': new Date().toISOString().substring(0, 10),
    'kuantitas_masuk': 0,
    'barang_id': '',
})
</script>
