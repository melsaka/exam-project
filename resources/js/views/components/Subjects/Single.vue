<template>
	<div>
        <div class="row">
            <div class="col-auto">
                <span class="avatar">{{subject.exams_count}}</span>
            </div>
            <div class="col">
                <div class="text-truncate">
                    <router-link :to="{name: 'subjects.show', params: {id: subject.id}}">
                        <strong>{{subject.name}}</strong>
                    </router-link>
                </div>
              <div class="text-muted">{{subject.description}}</div>
            </div>
            <div class="col-auto align-self-center">
                <router-link :to="{name:'subjects.edit', params: {id: subject.id}}" class="btn btn-sm btn-light">Edit</router-link>
                <a @click.prevent="$emit('deleteSubject', subject.id)" class="btn btn-sm btn-danger">Delete</a>
            </div>
        </div>
    </div>	
</template>

<script>
export default {
	props: {subject: Object}
}
</script>