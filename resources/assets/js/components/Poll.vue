<template>
  <form class="poll">
        <label>
            <input id="fname" type="text" placeholder="You can type your question here.">
            <span>Question</span>
        </label>
        <span style="float:right;color:white;display:none;" class="glyphicon glyphicon-remove my-span"></span>
        <label>
            <input class="poll-option-input" type="text" placeholder="You can put an option here.">
            <span>Option</span>
        </label>

        <span style="float:right;color:white;display:none;" class="glyphicon glyphicon-remove"></span>
        <label>
            <input class="poll-option-input" type="text" placeholder="You can put an option here.">
            <span>Option</span>
        </label>
        <!-- <span style="color:white" class="glyphicon glyphicon-plus"></span> -->
        <input style="margin-right:2%; margin-bottom: 2%;" type="submit" value="Add Option" v-on:click="addOption($event)">
        <input type="submit" value="Create Poll">
    </form>
</template>

<script>
export default {
    created: function() {
        $(document).ready(function() {
            $(document).on('focusin', '.poll-option-input', function() {
                $(this).closest('form').find('.my-span').show();
            });
            $(document).on('focusout', '.poll-option-input', function() {
                $(this).closest('form').find('.my-span').hide();
            });
        });
    },
    methods: {
        addOption: function(e) {
            e.preventDefault();
            var input = $.parseHTML('<label> <input class="poll-option-input" type="text" placeholder="You can put an option here."> <span>Option</span> </label>');
            $('.poll-option-input').last().after(input);
        },
        removeOption: function() {
            $(this).remove();
        }
    }
}
</script>


