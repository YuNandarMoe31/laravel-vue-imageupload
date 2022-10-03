<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    files: Array,
});

const form = useForm({
    title: "",
    file: null,
});

const submit = () => {
    form.post(route("file.upload.store"));
};
</script>

<template>
    <Head title="Dashboard" />

    <template>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Image Upload
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form name="createForm" @submit.prevent="submit">
                        <div className="flex flex-col">
                            <div className="mb-4">
                                <label for="title" value="Title">Title</label>
                                <input
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                    autofocus
                                />

                                <span
                                    className="text-red-600"
                                    v-if="form.errors.title"
                                >
                                    {{ form.errors.title }}
                                </span>
                            </div>

                            <div className="mb-4">
                                <label for="file" value="File">File</label>

                                <input
                                    id="file"
                                    type="file"
                                    class="mt-1 block w-full"
                                    @input="form.file = $event.target.files[0]"
                                    autofocus
                                />

                                <span
                                    className="text-red-600"
                                    v-if="form.errors.file"
                                >
                                    {{ form.errors.file }}
                                </span>
                            </div>
                        </div>

                        <div
                            v-if="form.progress"
                            className="w-full bg-gray-200 rounded-full dark:bg-gray-700"
                        >
                            <div
                                className="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                :width="form.progress.percentage"
                            >
                                {{ form.progress.percentage }}%
                            </div>
                        </div>

                        <div className="mt-4">
                            <button
                                type="submit"
                                className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                            >
                                Save
                            </button>
                        </div>
                    </form>

                    <h1 class="m-5">File Upload Lists</h1>
                    <table className="table-fixed w-full">
                        <thead>
                            <tr className="bg-gray-100">
                                <th className="px-4 py-2 w-20">No.</th>
                                <th className="px-4 py-2">Title</th>
                                <th className="px-4 py-2">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="file in files" :key="file.id">
                                <td className="border px-4 py-2">
                                    {{ file.id }}
                                </td>
                                <td className="border px-4 py-2">
                                    {{ file.title }}
                                </td>
                                <td className="border px-4 py-2">
                                    <img :src="file.image" width="200" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
