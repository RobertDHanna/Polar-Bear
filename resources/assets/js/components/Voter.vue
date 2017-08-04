<template>
    <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center;">
            <share-btn></share-btn>
            <h3>{{poll_obj.question}}</h3>
        </div>
        <div class="checkbox-wrapper panel-body">
            <div class="checkbox" v-for="item in poll_obj.options" v-bind:key="item.id" v-bind:item="item">
                <label>
                    <input type="checkbox" :value="item.id">
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                    <div style="margin-left: 30px;">{{item.text}}</div>
                </label>
            </div>

            <div v-if="poll_obj.captcha" class="row">
                <div class="col-sm-6">
                    <div class="g-recaptcha" data-sitekey="6Lf_iisUAAAAAFxQk7FjMsEjvXiseoEcihztjL-C"></div> 
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-success vote-button" style="float:right;font-size: 22px;margin-top: 11px;background:#22c385;" v-on:click="vote($event)">Vote</button>
                    <button type="button" class="btn btn-danger" style="float:right;font-size: 22px;margin-top: 11px; margin-right: 9px;background: #E94E4E;" v-on:click="results($event)"><span><i class="glyphicon glyphicon-stats"></i></span> Results</button>
                </div>
            </div>
            <div v-else>
                <button type="button" class="btn btn-success vote-button" style="float:right;font-size: 22px;margin-top: 11px;background:#22c385;" v-on:click="vote($event)">Vote</button>
                <button type="button" class="btn btn-danger" style="float:right;font-size: 22px;margin-top: 11px; margin-right: 9px;background:#E94E4E;" v-on:click="results($event)"><span><i class="glyphicon glyphicon-stats"></i></span> Results</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
button {
    border: none;
}
.btn-danger:hover {
    background: #d14646 !important;
}
.vote-button:hover {
    background: #1eaf77 !important;
}
.checkbox-wrapper {
    padding-left: 4%;
    font-size: 16px;
}

.checkbox label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border: 1px solid #a9a9a9;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox .cr .cr-icon,
.radio .cr .cr-icon {
    position: absolute;
    font-size: .8em;
    line-height: 0;
    top: 50%;
    left: 20%;
}

.radio .cr .cr-icon {
    margin-left: 0.04em;
}

.checkbox label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    /* transition: all .3s ease-in; */
}

.checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
</style>

<script>
export default {
    props: ['poll'],
    created: function() {
        var _this = this;
        $(document).ready(function() {
            if (!_this.poll_obj.multiple_choice)
            {
                $('input:checkbox').change(function() {
                    if ($(this).is(':checked')) {
                        $('input:checkbox').prop('checked', false);
                        $(this).prop('checked', true);
                    }
                });
            }
        });
    },
    data: function() {
        return {
            poll_obj: JSON.parse(this.poll)
        };
    },
    methods: {
        vote: function() {
            this.hideMessages();
            if ($(":checkbox:checked").length === 0)
            {
                this.showErrorMessage('You must select an option in order to vote!');
                return;
            }

            var form = {};
            form.poll_id = this.poll_obj.id;
            form.selection = [];
            $.each($('input:checkbox:checked'), function(i, element) {
                form.selection.push( $(element).val() );
            });

            if (this.poll_obj.captcha)
            {
                form.g_recaptcha_response = $('#g-recaptcha-response').val();
            }
            
            this.showLoadingGif();

            var _this = this;
            $.ajax({
                type: 'POST',
                url: '/vote',
                data: form,
                success: function(response) {
                    console.log('success', response);
                    _this.hideLoadingGif(1000);
                    window.location = response.result_url;
                },
                error: function(error) {
                    console.log('error', error);
                    _this.hideLoadingGif();
                    _this.showErrorMessage(error.responseJSON.message);
                }
            });
        },
        results: function() {
            this.hideMessages();
            this.showLoadingGif();
            this.hideLoadingGif(1000);
            window.location = this.poll_obj.poll_url + '/results';
        },
        showErrorMessage: function(message) {
            $('#poll-error-message').find('#poll-error-message-text').html(message);
            $('#poll-error-message').show('normal');
        },
        hideMessages: function() {
            $('#poll-error-message').hide('normal');
            $('#poll-info-message').hide('normal');
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


