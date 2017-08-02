<template>
  <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center;"><h3>{{poll_obj.question}}</h3></div>
        <div class="checkbox-wrapper panel-body">
            <div v-for="item in poll_obj.options" v-bind:key="item.id" v-bind:item="item">
                <div class="well">{{item.text}}</div>
                <div class="row">
                    <div class="col-xs-6">
                        {{computePercent(item.vote_num)}}%
                    </div>
                    <div class="col-xs-6">
                        <span class="votes-text">{{item.vote_num}} Votes</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar" v-bind:class="getNextProgressBarColor()" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" v-bind:style="{ width: computePercent(item.vote_num) + '%' }" style="width: 40%">
                        <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>

                <hr />
            </div>
        </div>
    </div>
</template>

<style scoped>
.progress {
    width: 100%;
}

.row {
    margin-bottom: 2%;
}

.votes-text {
    float:right;
}
</style>

<script>
export default {
    props: ['poll'],
    created: function() {
        this.progressColorClasses = ['progress-bar-success', 'progress-bar-info', 'progress-bar-warning', 'progress-bar-danger'];
        this.progressColorClassIndex = 0;
        console.log(JSON.parse(this.poll));
    },
    data: function() {
        return {
            poll_obj: JSON.parse(this.poll)
        };
    },
    methods: {
        computePercent: function(num_votes) {
            return parseInt( (num_votes / this.poll_obj.total_votes) * 100 );
        },
        getNextProgressBarColor: function() {
            console.log(this.progressColorClasses, this.progressColorClassIndex);
            if (this.progressColorClassIndex > this.progressColorClasses.length - 1) {this.progressColorClassIndex = 0;}
            return this.progressColorClasses[ this.progressColorClassIndex++ ];
        }
    }
}
</script>
