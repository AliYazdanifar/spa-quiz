<template>
    <Layout>
        <h1 class="text-2xl font-bold mb-4">مدیریت سوالات</h1>

        <Link href="/questions/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">افزودن سوال جدید</Link>

        <table class="w-full bg-white shadow-md rounded mb-4">
            <thead>
            <tr>
                <th class="border-b p-4 text-left">سوال</th>
                <th class="border-b p-4 text-left">گزینه‌ها</th>
                <th class="border-b p-4 text-left">عملیات</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="question in questions" :key="question.id">
                <td class="border-b p-4">{{ question.question_text }}</td>
                <td class="border-b p-4">
                    <ul>
                        <li v-for="choice in question.choices" :key="choice.id">
                            {{ choice.choice_text }} <span v-if="choice.is_correct">(صحیح)</span>
                        </li>
                    </ul>
                </td>
                <td class="border-b p-4">
                    <Link :href="`/questions/${question.id}/edit`" class="text-blue-500">ویرایش</Link> |
                    <form :action="`/questions/${question.id}`" method="POST" class="inline-block">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-red-500">حذف</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </Layout>
</template>

<script>
import Layout from '../../Shared/Layout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        questions: Array
    },
    components: {
        Layout,
        Link
    }
};
</script>
