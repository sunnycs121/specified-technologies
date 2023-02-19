<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { nextTick, ref } from 'vue';

const creatingTaskList = ref(false);
const taskListName = ref(false);

const createTaskList = () => {
    creatingTaskList.value = true;
    nextTick(() => taskListName.value.focus());
};
const form = useForm({
    name: ''
});

const createNewTaskList = () => {
    form.post(route('tasklist.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => taskListName.value.focus(),
        onFinish: () => form.reset(),
    });
};

function test(id) {
    console.log(id);
    form.delete(route('tasklist.destroy', id));
}

const closeModal = () => {
    creatingTaskList.value = false;

    form.reset();
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Task Lists</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- You're logged in -->
                        <!-- <button type="button" class="btn" @click="createTaskList()">VISIT OUR WEBSITE</button> -->
                        <PrimaryButton @click="createTaskList">Create New Task List</PrimaryButton>
                        <Modal :show="creatingTaskList" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Enter the Name of New Task List
                                </h2>

                                <form @submit.prevent="submit">
                                    <div class="mt-6">
                                        <TextInput
                                            id="taskListName"
                                            ref="taskListName"
                                            type="text"
                                            v-model="form.name"
                                            placeholder="Task List Name"
                                            class="mt-1 block w-3/4"
                                        />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                                        <PrimaryButton 
                                            class="ml-4"
                                            :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing"
                                            @click="createNewTaskList"> Create 
                                        </PrimaryButton>

                                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Task List Created.</p>
                                        </Transition>
                                    </div>
                                </form>
                            </div>
                        </Modal>
                        <table class="w-full text-left text-gray-500">
                            <thead>
                                <tr>
                                    <th>Task List Names</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="list in taskLists">
                                    <td><a href="" @click.prevent="updateTaskList(list)">{{ list.name }}</a></td>
                                    <td>
                                        <font-awesome-icon alt="View" icon="fa-regular fa-eye" />&nbsp;
                                        <font-awesome-icon @click="test(list.id)" icon="fa-regular fa-trash-can" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {

    props: {
        taskLists: Object
    },
    methods: {
        /* createTaskList() {

        }, */
        updateTaskList(list) {
            let url = '/tasklists/' + list.id;
            list._method = 'PUT';
            this.$inertia.post(url, list, {
                onError: () => {
                    console.log('came back with failure');
                },
                onSuccess: () => {
                    console.log('came back with success');
                }
            });
        },
        deleteTaskList(list) {
            let url = '/tasklists/' + list.id;
            list._method = 'DELETE';
            this.$inertia.post(url, list, {
                onError: () => {
                    console.log('came back with failure');
                },
                onSuccess: () => {
                    console.log('came back with success');
                }
            });
        }
    }
}
</script>