<template>
  <div class="panel panel-default wordwrap">
        <div class="panel-heading" style="text-align:center;"><h4 style="text-align:center;">Results</h4><h2>{{poll_obj.question}}</h2></div>
        <div class="checkbox-wrapper panel-body">
            <div v-for="item in poll_obj.options" v-bind:key="item.id" v-bind:item="item">
                <div style="font-size: 20px;">{{item.text}}</div>
                <div class="row">
                    <div class="col-xs-6">
                        {{computePercent(item.vote_num)}}%
                    </div>
                    <div class="col-xs-6">
                        <span class="votes-text" v-if="item.vote_num !== 1">{{item.vote_num}} Votes</span>
                        <span class="votes-text" v-if="item.vote_num === 1">{{item.vote_num}} Vote</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar" v-bind:class="getNextProgressBarColor()" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" v-bind:style="{ width: computePercent(item.vote_num) + '%', 'display': 'none' }" style="width: 40%">
                    </div>
                </div>

                <hr />
            </div>
            <form style="margin-bottom:0;margin-top: 10px;">
            <div class="row">
                <div class="col-sm-6">
                    <button style="float:right;" class="poll-btn create-poll-btn" type="submit" value="Vote" v-on:click="vote($event)"> Vote </button>
                </div>
                <div class="col-sm-6">
                    <share-btn width="100%" :url="poll_obj.poll_url"></share-btn>
                    <!-- <button style="width:100%;" class="side-btn add-option-btn extra-action-btn" type="submit" value="Results" v-on:click="results($event)"><span class="glyphicon glyphicon-share"></span> <span class="action-button-text">Share</span> </button> -->
                </div>
            </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
button {
    border: none;
}

.vote-button:hover {
    background: #1eaf77 !important;
}
.progress {
    width: 100%;
}

.row {
    margin-bottom: 2%;
    font-size: 18px;
}

.votes-text {
    float:right;
}

hr {
    border-top: 1px solid #cccccc;
}
</style>

<script>
export default {
    props: ['poll'],
    created: function() {
        this.progressColorClasses = ['progress-bar-success', 'progress-bar-info', 'progress-bar-warning', 'progress-bar-danger'];
        this.progressColorClassIndex = 0;
        $(document).ready(function() {
            $('.progress-bar').show('slow');
        });
    },
    data: function() {
        return {
            poll_obj: JSON.parse(this.poll)
        };
    },
    methods: {
        computePercent: function(num_votes) {
            return num_votes === 0 ? 0 : parseFloat( (num_votes / this.poll_obj.total_votes) * 100 ).toFixed(2);
        },
        getNextProgressBarColor: function() {
            if (this.progressColorClassIndex > this.progressColorClasses.length - 1) {this.progressColorClassIndex = 0;}
            return this.progressColorClasses[ this.progressColorClassIndex++ ];
        },
        vote: function(e) {
            e.preventDefault();
            this.showLoadingGif();
            this.hideLoadingGif(1000);
            window.location = this.poll_obj.poll_url;
        },
        showLoadingGif: function() {
            $('#poll-loading-wedge').css('display', 'block').hide();
            $('#poll-loading-wedge').show('fast');
        },
        hideLoadingGif: function(timeout = 0) {
            setTimeout(function() {$('#poll-loading-wedge').hide('fast');},timeout);
        },
    }
}
</script>
