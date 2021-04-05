<template>
<div class="page-header text-white d-print-none">
    <div class="row align-items-center">
        <div class="col">
            <div class="page-pretitle">
                {{ pre }}
            </div>
            <h2 class="page-title">
                {{ title }}
            </h2>
        </div>
        <slot></slot>
    </div>
</div>
</template>

<script>
export default{
	props: ['pre', 'title']
}
</script>