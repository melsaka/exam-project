<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-lg avatar-rounded">{{exam.questions_count}}</span>
                </div>
                <div class="col">
                    <h4 class="card-title m-0">
                        <router-link :to="{name: 'exams.show', params: {id: exam.id}}">
                            <strong>{{exam.name}}</strong>
                        </router-link>
                    </h4>
                    <div class="text-muted">
                        {{exam.description}}
                    </div>
                </div>
                <div class="col-auto">
                    <router-link :to="{name: 'exams.take', params: {id: exam.id}}" class="btn">
                        Take Exam
                    </router-link>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <a href="#" class="card-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="19" r="1"></circle><circle cx="12" cy="5" r="1"></circle></svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0 m-0">
                            <router-link :to="{name:'exams.edit', params: {id: exam.id}}" class="dropdown-item btn btn-light">Edit</router-link>
                            <a @click.prevent="$emit('deleteExam', exam.id)" class="dropdown-item btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
	props: {exam: Object},
}
</script>