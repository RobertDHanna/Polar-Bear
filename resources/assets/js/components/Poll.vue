<template>
    <form class="poll">
        <label id="poll-question">
            <input id="poll-question-input" type="text" placeholder="You can type your question here.">
            <span>Question</span>
        </label>
        
        <input class="add-option-btn" type="submit" value="Add Option" v-on:click="addOption($event)">
        <input type="submit" value="Create Poll" v-on:click="createPoll($event)">
    </form>
</template>

<style>
.add-option-btn {
    margin-right:2%; 
    margin-bottom: 2%;
}

.remove-option-btn {
    float:right;
    color:white;
    display:none;
}
</style>



<script>
export default {
    props: ['question', 'options'],
    created: function() {
        this.uid = 1;
        this.generateForm();
        $(document).ready(function() {
            $(document).on('click', function(e) {
                var element_class = $(e.target).attr('class');
                if (element_class !== 'poll-option-input' && element_class !== 'remove-option-btn')
                    $('.remove-option-btn').hide();
            });
            $(document).on('focusin', '.poll-option-input', function() {
                $('.remove-option-btn').hide();
                $(this).closest('form').find('#' + $(this).attr('id') + '-remove').show();
            });
            $(document).on('click', '.remove-option-btn', function(e) {
                e.stopPropagation();
                $(this).closest('div').remove();
            });
        });
    },
    methods: {
        generateForm: function() {
            if (typeof this.question === 'string')
            {
                
            }
            var _this = this;
            $(document).ready(function() {
                if ((typeof this.options === 'object' || this.options === 'array') && this.options.length > 0)
                {
                    // Open draft form
                }
                else
                {
                    _this.addOption();
                    _this.addOption();
                }
            });
        },
        addOption: function(e) {
            if (e !== null && e !== undefined)
            {
                e.preventDefault();
            }
            var uid = this.nextUid();
            var input = $.parseHTML('<div class="poll-option-container"><a href="#"><span id="poll-option-'+uid+'-remove" class="glyphicon glyphicon-remove remove-option-btn" data-toggle="tooltip" title="delete"></span></a> <label class="poll-option"> <input id="poll-option-'+uid+'" class="poll-option-input" type="text" placeholder="You can put an option here."> <span>Option</span> </label></div>');
            if ($('.poll').find('.poll-option-input').length > 0)
            {
                $('.poll-option-container').last().after(input);
            }
            else
            {
                $('#poll-question').after(input);
            }
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
            var form = {
                'question' : $('#poll-question-input').val(),
                'options' : {}
            };
            $('.poll-option-input').each(function(i, val) {
                form.options[i] = $(val).val();
            });
           
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/poll',
                data: form,
                success: function(response) {
                    console.log('success', response);
                },
                error: function(error) {
                    console.log('error', error);
                }
            });
        }
    }
}
</script>


