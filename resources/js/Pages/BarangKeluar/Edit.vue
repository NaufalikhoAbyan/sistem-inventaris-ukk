<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang-keluar.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Edit Barang Keluar</p>
    </div>

    <form @submit.prevent="form.put(route('barang-keluar.update', props.barang_keluar.id))">
        <div class="py-4 flex flex-col gap-4">
            <div>
                <p class="opacity-75 flex text-xl font-bold">Tanggal Keluar</p>
                <input type="date" class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="tanggal_keluar" v-model="form.tanggal_keluar">
            </div>
            <div>
                <p class="opacity-75 flex text-xl font-bold">Kuantitas</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="kuantitas_keluar" v-model.number="form.kuantitas_keluar">
            </div>
            <div>
                <p class="opacity-75 flex text-xl font-bold">Item Id</p>
                <select class="text-xl p-2 rounded-lg border border-primary-dark w-1/4" name="barang_id" v-model="form.barang_id" disabled>
                    <option value="" disabled selected>Pilih Barang</option>
                    <option v-for="barangItem in props.barang" :key="barangItem.id" :value="barangItem['id']">{{barangItem['merk']}} {{barangItem['seri']}}</option>
                </select>
            </div>
            <button type="submit" class="button-primary w-fit">Edit</button>
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
    'barang_keluar': Object,
    'barang': Object
})

const form = useForm({
    'tanggal_keluar': props.barang_keluar.tanggal_keluar,
    'kuantitas_keluar': props.barang_keluar.kuantitas_keluar,
    'barang_id': props.barang_keluar.barang_id,
})
</script>
