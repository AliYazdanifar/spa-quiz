<template>
    <Layout>
        <h1 class="text-2xl font-bold mb-4">ایجاد سوال جدید</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="question_text" class="block text-gray-700">متن سوال</label>
                <input v-model="form.question_text" type="text" id="question_text" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">گزینه‌ها</label>
                <div v-for="(choice, index) in form.choices" :key="index" class="flex items-center mb-2">
                    <input v-model="choice.choice_text" type="text" class="w-full border rounded px-4 py-2 mr-2">
                    <input v-model="choice.is_correct" type="checkbox" class="mr-2"> صحیح
                    <button type="button" @click="removeChoice(index)" class="text-red-500">حذف</button>
                </div>
                <button type="button" @click="addChoice" class="text-blue-500">افزودن گزینه</button>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">ایجاد سوال</button>
        </form>
    </Layout>
</template>

<script>
import Layout from '../../Shared/Layout.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Layout
    },
    setup() {
        const form = useForm({
            question_text: '',
            choices: [{ choice_text: '', is_correct: false }]
        });

        function addChoice() {
            form.choices.push({ choice_text: '', is_correct: false });
        }

        function removeChoice(index) {
            form.choices.splice(index, 1);
        }

        function submit() {
            form.post('/questions');
        }

        return {
            form,
            addChoice,
            removeChoice,
            submit
        };
    }
};
</script>
