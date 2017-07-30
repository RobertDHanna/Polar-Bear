<template>
    <form class="poll">
        <label id="poll-question">
            <input type="text" placeholder="You can type your question here.">
            <span>Question</span>
        </label>
        
        <input class="add-option-btn" type="submit" value="Add Option" v-on:click="addOption($event)">
        <input type="submit" value="Create Poll">
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
            var input = $.parseHTML('<div class="poll-option-container"><a href="#"><span id="poll-option-'+uid+'-remove" class="glyphicon glyphicon-remove remove-option-btn"></span></a> <label class="poll-option"> <input id="poll-option-'+uid+'" class="poll-option-input" type="text" placeholder="You can put an option here."> <span>Option</span> </label></div>');
            if ($('.poll').find('.poll-option-input').length > 0)
            {
                $('.poll-option-container').last().after(input);
            }
            else
            {
                $('#poll-question').after(input);
            }
        },
        removeOption: function(e) {
            e.stopPropagation();
            $(this).remove();
        },
        nextUid: function() {
            return this.uid++;
        }
    }
}
</script>


