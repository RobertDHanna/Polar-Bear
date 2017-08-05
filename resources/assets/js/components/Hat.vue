<template>
    <div class="wordwrap">
        <div id="poll-error-message" class="alert alert-danger" role="alert" style="display:none;font-size: 16px;">
            <span id="poll-error-message-text"></span>
        </div>
        <div id="poll-info-message" class="alert alert-info" style="display:none;font-size: 16px;">
            <span id="poll-info-message-text"></span>
        </div>
        <img id="poll-loading-wedge" style="display:none;margin: auto;width: 25%;" :src="loading_gif_url" />
    </div>
</template>

<script>
export default {
  props: ['loading_gif_url']
}
</script>
