<template>
    <div class="flex flex-col gap-2">
        <Link :href="route('barang-keluar.index')">
            <div class="opacity-25 flex text-2xl gap-2">
                <img src="/images/back_icon.svg" alt="" class="h-8">
                <p>Back</p>
            </div>
        </Link>
        <p class="text-[28px] opacity-60">Tambah Barang Keluar</p>
    </div>

    <form @submit.prevent="form.post(route('barang-keluar.store'))">
        <div class="card w-full py-4 flex flex-col gap-4">
            <div class="form-input">
                <p class="opacity-75 flex text-xl font-bold">Tanggal Keluar</p>
                <input type="date" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="tanggal_keluar" v-model="form.tanggal_keluar">
            </div>
            <div class="form-input">
                <p class="opacity-75 flex text-xl font-bold">Kuantitas</p>
                <input type="text" class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="kuantitas_keluar" v-model.number="form.kuantitas_keluar">
            </div>
            <div class="form-input">
                <p class="opacity-75 flex text-xl font-bold">Item Id</p>
                <select class="text-xl p-2 rounded-lg border border-primary-dark w-full" name="barang_id" v-model="form.barang_id">
                    <option value="" disabled selected>Pilih Barang</option>
                    <option v-for="item in props.barang" :key="item.id" :value="item['id']">{{item['merk']}} {{item['seri']}}</option>
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
import {Link, useForm} from "@inertiajs/vue3";

const props = defineProps({
    'barang': Object
})

const form = useForm({
    'tanggal_keluar': new Date().toISOString().substring(0, 10),
    'kuantitas_keluar': 0,
    'barang_id': '',
})
</script>
