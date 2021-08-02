<template>
    <div>
        <div class="">
            <div class="flex flex-col sm:flex-row justify-center">
                <textarea
                    v-model="current_task"
                    class="min-w-max appearance-none rounded-none relative block w-full px-3 py-2 font-Merienda
                                   border border-gray-300 placeholder-gray-500 text-gray-900 rounded-l-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="title
description">
                </textarea>
                <select
                    v-model="priority"
                    class="py-6 sm:by-0 block border-t border-b border-gray-300 bg-white
                                 shadow-sm focus:outline-none focus:ring-indigo-500">
                    <option class="text-yellow-600" value="low">priority is low</option>
                    <option class="text-blue-600" value="mid">priority is medium</option>
                    <option class="text-red-600" value="high">priority is high</option>
                </select>
                <select
                    v-if="boards.length"
                    v-model="board_id"
                    class="py-6 sm:by-0 block border-t border-b border-l border-gray-300 bg-white
                                 shadow-sm focus:outline-none focus:ring-indigo-500">
                    <option v-for="board in boards" :value="board.id">
                        {{ board.name }}
                    </option>
                </select>
                <button
                    @click="storeTaskRequest()"
                    class="group relative w-20 py-2 px-4 border border-transparent text-sm font-medium
                     rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                      focus:ring-offset-2 focus:ring-indigo-500 font-Righteous uppercase tracking-widestc">
                    New
                </button>
            </div>
            <div class="border-t my-8 py-2">
                <div class="flex flex-col my-4 sm:my-0 sm:flex-row items-center justify-between">
                    <SearchBarComponent endpoint="/task/search" key_path="task" :csrf="csrf"/>
                    <div v-if="board">
                        <input id="share_board_link"
                               :value="`http://127.0.0.1:8000/board/share/${board.share_board_id}`"
                               class="absolute z-0 opacity-0">
                        <button
                            @click="copyShareBoardLink()"
                            class="relative z-10 btn font-Righteous tracking-wide uppercase btn-purple flex items-center gap-4">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                 class="w-4">
                                <path fill="currentColor"
                                      d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"
                                      class=""></path>
                            </svg>
                            Share board
                        </button>
                    </div>
                </div>
                <div>
                    <h3 class="text-purple-900">
                        # Pending Tasks,
                        <a
                            href="?sort=true"
                            class="bg-purple-900 text-white py-1 px-3 rounded-sm hover:text-purple-900 hover:bg-white">
                            sort due priority
                        </a>
                    </h3>
                    <div class="py-6">
                        <div v-for="ct in pending_tasks"
                             class="flex items-center justify-between gap-6 bg-white py-3 px-4 rounded-sm">
                            <div>
                                <input @click="mark_task_as_completed(ct)" type="checkbox" :key="ct.id"
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    :class="`inline-block rounded-full w-4 h-4 ${ct.priority=='high'?'bg-red-600':ct.priority=='mid'?'bg-blue-600':'bg-yellow-600'}`">
                                </span>
                                <span
                                    :class="`uppercase font-Righteous tracking-widest ${ct.priority=='high'?'text-red-600':ct.priority=='mid'?'text-blue-600':'text-yellow-600'}`">
                                    {{ ct.priority }}
                                </span>
                            </div>
                            <div>
                                <a :href="`/task/${ct.id}`" class="text-purple-500">
                                    {{ ct.title }}
                                </a>
                                <br/>
                                <span class="text-gray-400">
                                    {{ ct.description }}
                                </span>
                            </div>
                            <div>
                                <span
                                    class="inline-block bg-red-300 text-black rounded-l-full rounded-r-full px-3 py-1">
                                    pending
                                </span>
                                <span
                                    class="inline-block bg-purple-900 text-white rounded-l-full rounded-r-full px-3 py-1">
                                    {{ ct.board_name }}
                                </span>
                            </div>
                            <div class="text-gray-400">
                                {{ ct.updated_date }}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-green-600">
                        # Completed Tasks,
                        <button
                            href="?sort=true"
                            class="bg-green-600 text-white py-1 px-3 rounded-sm hover:text-green-600 hover:bg-white">
                            sort due priority
                        </button>
                    </h3>
                    <div class="py-6">
                        <div v-for="ct in completed_tasks"
                             class="flex items-center justify-between gap-6 bg-white py-3 px-4 rounded-sm">
                            <div>
                                <input @click="mark_task_as_pending(ct)" type="checkbox" checked :key="ct.id"
                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <span
                                    :class="`inline-block rounded-full w-4 h-4 ${ct.priority=='high'?'bg-red-600':ct.priority=='mid'?'bg-blue-600':'bg-yellow-600'}`">
                                </span>
                                <span
                                    :class="`uppercase font-Righteous tracking-widest ${ct.priority=='high'?'text-red-600':ct.priority=='mid'?'text-blue-600':'text-yellow-600'}`">
                                    {{ ct.priority }}
                                </span>
                            </div>
                            <div>
                                <a :href="`/task/${ct.id}`" class="text-purple-500">
                                    {{ ct.title }}
                                </a>
                                <br/>
                                <span class="text-gray-400">
                                    {{ ct.description }}
                                </span>
                            </div>
                            <div>
                                <span
                                    class="inline-block bg-green-300 text-black rounded-l-full rounded-r-full px-3 py-1">
                                    completed
                                </span>
                                <span
                                    class="inline-block bg-purple-900 text-white rounded-l-full rounded-r-full px-3 py-1">
                                    {{ ct.board_name }}
                                </span>
                            </div>
                            <div class="text-gray-400">
                                {{ ct.updated_date }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="fixed bottom-12 left-0 right-0" v-if="message.length">
            <div class="flex justify-center items-center">
                <div class="bg-nothub-purple rounded-sm px-16 text-white py-1.5 relative shadow-lg">
                    {{ message }}
                    <div class="absolute right-3 top-0 bottom-0 flex items-center">
                        <button @click="message=''">
                            <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                 class="w-2">
                                <path fill="currentColor"
                                      d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"
                                      class=""></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SearchBarComponent from "./SearchBarComponent";

export default {
    name: "TasksComponent",
    components: {
        SearchBarComponent,
    },
    props: {
        tasks: {
            required: true,
            type: Array
        },
        csrf: {
            required: true,
            type: String
        },
        board: {
            required: false,
            default() {
                return {};
            }
        },
        boards: {
            required: false,
            default() {
                return [];
            }
        }
    },
    data() {
        return {
            current_task: '',
            title: '',
            description: '',
            priority: 'mid',
            board_id: '',
            pending_tasks: this.get_pending_tasks(),
            completed_tasks: this.get_completed_tasks(),
            message: ''
        }
    },
    methods: {
        storeTaskRequest() {
            axios.post('/task', {
                _token: this.csrf, title: this.title,
                description: this.description, status: 'pending',
                priority: this.priority, board_id: (this.board_id ? this.board_id : this.board.id)
            })
                .then(resp => this.pending_tasks.unshift(resp.data))
                .catch(err => console.log(err));

            this.current_task = this.title = this.description = "";
            this.priority = "mid";
        },
        mark_task_as_completed(task) {
            axios.put(`/task/${task.id}/completed`, {csrf_token: this.csrf})
                .then(resp => {
                    this.pending_tasks = this.pending_tasks.filter(item => item.id != task.id);
                    this.completed_tasks.unshift(task);
                }).catch(err => console.log(err));
        },
        mark_task_as_pending(task) {
            axios.put(`/task/${task.id}/pending`, {csrf_token: this.csrf})
                .then(resp => {
                    this.pending_tasks.unshift(task);
                    this.completed_tasks = this.completed_tasks.filter(item => item.id != task.id);
                }).catch(err => console.log(err));
        },
        get_pending_tasks() {
            return this.get_tasks_when_status_id('pending')
        },
        get_completed_tasks() {
            return this.get_tasks_when_status_id('completed')
        },
        get_tasks_when_status_id(status) {
            return this.tasks.filter(item => (item.status == status))
        },
        copyShareBoardLink() {
            /* Get the text field */
            var copyText = document.getElementById("share_board_link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            this.message = 'Link copied'
        }
    },
    watch: {
        current_task() {
            if (!this.current_task)
                return;

            let result = (this.current_task.match(/(.+)/gm));

            this.title = result[0];
            this.description = result[1] ?? '';
        }
    }
}
</script>

<style scoped>

</style>
