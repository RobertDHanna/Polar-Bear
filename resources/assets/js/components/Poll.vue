<template>
    <form class="poll">
        <label id="poll-question">
            <input maxlength="200" id="poll-question-input" type="text" placeholder="You can type your question here.">
            <span>Question</span>
        </label>

        <div class="row">
            <div class="col-xs-6">
                <select id="dup-check" class="selectpicker">
                    <option value="none">Don't Check Duplicates</option>
                    <option value="cookie">Filter By Cookie</option>
                    <option value="ip">Filter By IP Address</option>
                </select>
            </div>
        </div>
        
        <div class="checkbox-wrapper">
            <div class="checkbox-poll-option checkbox">
                <div class="row"> 
                    <div class="col-xs-10">
                    <label>
                        <input id="p-use-captcha" type="checkbox" value="">
                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                        <div style="margin-left: 45px; color:white;">Spam Protection</div>
                    </label>
                    </div>
                    <div class="col-xs-2">
                        <span style="color:white;" data-toggle="tooltip" title="Users will be required to solve a captcha before they can vote."><i class="glyphicon glyphicon-question-sign"></i></span>
                    </div>
                 </div>
            </div>
            <div class="checkbox-poll-option checkbox">
                <label>
                    <input id="multiple-choice" type="checkbox" value="yes">
                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                    <div style="margin-left: 45px; color:white;">Check All That Apply</div>
                </label>
            </div>
        </div>
        <input style="display:none;" class="side-btn add-option-btn" type="submit" value="Add Option" v-on:click="addOption($event, true)"> 
        <div class="row">
            <div class="col-sm-6">
                <input class="poll-btn create-poll-btn" type="submit" value="Create Poll" v-on:click="createPoll($event)">
            </div>
            <div class="col-sm-6">
                <input style="float:right;" class="side-btn add-option-btn extra-action-btn" type="submit" value="Save Draft" v-on:click="saveDraft($event)"> 
                <input style="float:left;" class="side-btn add-option-btn extra-action-btn" type="submit" value="Add Option" v-on:click="addOption($event, true)">
            </div>
        </div>
        
    </form>
</template>

<style>
.tooltip-inner {
    width: 200px;
}
.poll-btn {
    width: 100% !important;
    margin-top: 11px;
}
.side-btn {
    width: 48%;
    margin-top: 11px;
}
.save-draft-btn {
    margin-right: 21% !important; 
    float: right !important;
    background: white !important;
    color: #636b6f !important;
    font-size: 13px !important;
    padding: 9px 11px !important;
    transition: all 0.2s ease-in-out !important;
}

.save-draft-btn:hover {
    background: #E7E7E7 !important;
}

.add-option-btn {
    /* margin-right:2%;  */
    margin-bottom: 2%; 
}

.remove-option-btn {
    float:right;
    color:white;
    display:none;
    cursor: pointer;
}

.create-poll-btn {
    /* float: right; */
    /* margin-right: 10%; */
    padding: 12px 12px !important; 
}
@media (max-width: 1145px) {
    .create-poll-btn {
        float: none;
        /* margin-top: 2%; */
        transition: all 0.2s ease-in-out;
    }
}

.checkbox-poll-option {
     margin-bottom: 15px; 
     width: 211px;
}

.checkbox-wrapper {
    font-size: 16px;
}

.radio label, .checkbox label {
    padding-left: 0;
    left: -18px;
}

.checkbox-poll-option label:after, 
.radio label:after {
    content: '';
    display: table;
    clear: both;
}

.checkbox-poll-option .cr,
.radio .cr {
    position: relative;
    display: inline-block;
    border-radius: .25em;
    width: 1.3em;
    height: 1.3em;
    float: left;
    margin-right: .5em;
    background: white;
    opacity: 1 !important;
    font: unset;
    color: #636b6f;
}

.radio .cr {
    border-radius: 50%;
}

.checkbox-poll-option .cr .cr-icon,
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

.checkbox-poll-option label input[type="checkbox"],
.radio label input[type="radio"] {
    display: none;
}

.checkbox-poll-option label input[type="checkbox"] + .cr > .cr-icon,
.radio label input[type="radio"] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    /* transition: all .3s ease-in; */
}

.checkbox-poll-option label input[type="checkbox"]:checked + .cr > .cr-icon,
.radio label input[type="radio"]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.checkbox-poll-option label input[type="checkbox"]:disabled + .cr,
.radio label input[type="radio"]:disabled + .cr {
    opacity: .5;
}
</style>



<script>
export default {
    props: ['question', 'options'],
    created: function() {
        this.uid = 1;
        this.canCreatePoll = true;
        this.generateForm();
        $(document).ready(function() {
            $(document).on('click', function(e) {
                var element_class = $(e.target).attr('class');
                if (element_class !== 'poll-option-input' && element_class !== 'remove-option-btn' && element_class !== 'add-option-btn')
                {
                    $('.remove-option-btn').hide();
                }
            });
            $(document).on('focusin', '.poll-option-input', function() {
                $('.remove-option-btn').hide();
                $(this).closest('form').find('#' + $(this).attr('id') + '-remove').show();
            });
            $(document).on('click', '.remove-option-btn', function(e) {
                e.stopPropagation();
                $(this).closest('div').hide('normal', function() {
                    $(this).closest('div').remove();
                });
            });
        });
    },
    methods: {
        generateForm: function() {
            var _this = this;
            $(document).ready(function() {
                var form = _this.getParameterByName('draft',window.location.href);
                if (form !== null)
                {
                    form = JSON.parse(form);
                    $('#poll-question-input').val(form.question);
                    $.each(form.options, function(i, item) {
                        _this.addOption(null, false, item);
                    });
                    $('#p-use-captcha').prop('checked', form.captcha);
                    $('#multiple-choice').prop('checked', form.multiple_choice);
                    $('#dup-check').val(form.dup_check);
                }
                else
                {
                    _this.addOption();
                    _this.addOption();
                }
            });
        },
        addOption: function(e, clicked = false, value = '') {
            if (e !== null && e !== undefined)
            {
                e.preventDefault();
            }
            var uid = this.nextUid();
            if (uid > 10) { return; } // 10 options max.
            var element = $('<div class="poll-option-container"><span id="poll-option-'+uid+'-remove" class="glyphicon glyphicon-remove remove-option-btn"></span> <label class="poll-option"> <input maxlength="200" id="poll-option-'+uid+'" class="poll-option-input" type="text" placeholder="You can put an option here."> <span>Option</span> </label></div>').hide();
            if ($('.poll').find('.poll-option-input').length > 0)
            {
                $('.poll-option-container').last().after(element);
                if (clicked) 
                {
                    $('.poll-option-container').last().find('.poll-option-input').focus();
                }
            }
            else
            {
                $('#poll-question').after(element);
            }
            if (clicked)
            {
                element.show('normal', function() {
                    element.find('.poll-option-input').focus();
                });
            }
            else
            {
                element.show('slow');
            }
            element.find('input').val(value);
            $('[data-toggle="tooltip"]').tooltip();
        },
        removeOption: function(e) {
            e.stopPropagation();
            $(this).remove();
        },
        nextUid: function() {
            return this.uid++;
        },
        createPoll: function(e) {
            e.preventDefault();

            if (!this.canCreatePoll) {
                this.showErrorMessage('Your poll has already been created!');
                return;
            }

            this.hideMessages();
            if ($('#poll-question-input').val().length === 0)
            {
                this.showErrorMessage('Your poll must include a question!');
                return;
            }
            
            var form = this.getForm();

            if (Object.keys(form.options).length < 2)
            {
                this.showErrorMessage('Your poll must include at least <strong>two</strong> options!');
                return;
            }
            this.showLoadingGif();
            var _this = this;
            $.ajax({
                type: 'POST',
                url: '/poll',
                data: form,
                success: function(response) {
                    console.log('success', response);
                    _this.hideLoadingGif(1000);
                    window.location = response.poll.poll_url;
                },
                error: function(error) {
                    console.log('error', error);
                }
            });
        },
        getForm: function(raw = false) {
            var form = {
                'question' : $('#poll-question-input').val(),
                'options' : [],
                'captcha' : $('#p-use-captcha').prop('checked'),
                'multiple_choice': $('#multiple-choice').prop('checked'),
                'dup_check': $('#dup-check').val(),
            };

            $('.poll-option-input').each(function(i, val) {
                if ($(val).val().trim().length > 0 || raw)
                {
                    form.options.push( $(val).val() );
                }
            });
            return form;
        },
        saveDraft: function(e) {
            e.preventDefault();
            var uri = encodeURI(this.addQueryParamToUrl(window.location.href, 'draft', JSON.stringify(this.getForm(true))));
            window.history.pushState("", "Draft", uri);
            this.showInfoMessage('The URL of this page has been updated to include the current poll information. You can use this URL to come back to this page at any time to edit or submit the current poll.');
        },
        getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        },
        addQueryParamToUrl: function(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) 
            {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            }
            else 
            {
                return uri + separator + key + "=" + value;
            }
        },
        showErrorMessage: function(message) {
            this.scrollToTop();
            $('#poll-error-message').find('#poll-error-message-text').html(message);
            $('#poll-error-message').show('normal');
        },
        showInfoMessage: function(message) {
            this.scrollToTop();
            $('#poll-info-message').find('#poll-info-message-text').html(message);
            $('#poll-info-message').show('normal');
        },
        showLoadingGif: function() {
            $('#poll-loading-wedge').css('display', 'block').hide();
            $('#poll-loading-wedge').show('fast');
        },
        hideLoadingGif: function(timeout = 0) {
            setTimeout(function() {$('#poll-loading-wedge').hide('fast');},timeout);
        },
        hideMessages: function() {
            $('#poll-error-message').hide('normal');
            $('#poll-info-message').hide('normal');
        },
        scrollToTop: function() {
            $('html, body').animate({ scrollTop: 0 }, 'fast');
        }
    }
}
</script>


