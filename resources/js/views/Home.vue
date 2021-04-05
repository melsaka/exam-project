<template>
<div class="container-xl ">
    <page-header pre="Home" title="Overview"></page-header>

    <div class="row">
    	<div class="col-12">
    		<div class="card">
    			<div class="card-header">
    				Latest Exams
    			</div>
    			<div class="card-body">
    				<div class="card" v-if="exams.any()">
		                <div class="card-body">
		                    <div class="divide-y-4">
		                        <exam-component v-for="exam in exams.all()" :key="exam.id" :exam="exam" />
		                    </div>
		                </div>
		            </div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</template>

<script>
import ExamComponent from '@/views/components/Exams/Single';
import PageHeader from '@/views/components/PageHeader';
import Collection from '@/helpers/Collection';
import Api from '@/helpers/Api';

export default {
	data() {
		return {
			exams: new Collection
		}
	},
	created() {
        Api.get('/api/exams?sort=-id&count=questions')
            .then(response => this.exams.set(response.data));
	},
	components: {
		PageHeader,
		ExamComponent
	}
}
</script>