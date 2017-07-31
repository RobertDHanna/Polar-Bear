<template>
    <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center;"><h3>{{pollObj.question}}</h3></div>
        <div class="checkbox-wrapper panel-body">
            <div class="checkbox" v-for="item in pollObj.options">
                <label>
                    <input type="checkbox" value="">
                        {{item.text}}   
                    </label>
            </div>
        </div>
    </div>
</template>

<style scoped>
.checkbox-wrapper {
    padding-left: 4%;
    font-size: 16px;
}
</style>

<script>
export default {
    props: ['poll'],
    created: function() {
        console.log( JSON.parse(this.poll) );
    },
    data: function() {
        return {
            pollObj: JSON.parse(this.poll)
        };
    },
}
</script>


