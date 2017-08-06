<template>
    <div class="btn-group dropup" v-bind:style="{ width: width }">
        <button style="width:100%;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle side-btn add-option-btn extra-action-btn" type="submit" value="Results" v-on:click="share($event)"><span class="glyphicon glyphicon-share"></span> <span class="action-button-text">Share</span> </button>
        <ul class="dropdown-menu">
            <li>
                <div class="row" v-if="!is_mobile">
                    <div class="col-xs-9" style="padding-right:0">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">URL: </span>
                            <input id="share-url" type="text" class="form-control" :value="url" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-xs-3" style="padding-left:0;">
                        <button class="btn" style="background:none;" id="copy-to-clipboard" v-on:click="copyToClipboard($event)">Copy</button>
                    </div>
                </div>
                <div v-else>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">URL: </span>
                        <input id="share-url" type="text" class="form-control" :value="url" aria-describedby="basic-addon1">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<style scoped>

.dropdown-menu:before {
  position: absolute;
  bottom: -7px;
  right: 9px;
  display: inline-block;
  border-right: 7px solid transparent;
  border-top: 7px solid #ccc;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.dropdown-menu:after {
  position: absolute;
  bottom: -6px;
  right: 10px;
  display: inline-block;
  border-right: 6px solid transparent;
  border-top: 6px solid #ffffff;
  border-left: 6px solid transparent;
  content: '';
}

#copy-to-clipboard {
    border: none;
}
.dropdown-menu {
    left: inherit;
    right: 0;
    min-width: 315px;
}
.input-group {
    width: 94%;
    padding-left: 6%;
}
.share-btn {
    float: right;
    font-size: 19px;
    color: #636b6f;
    border: none;
    cursor: default !important;
    background: none;
}

.btn-group {
    float: right;
    cursor:pointer;
}
</style>

<script>
export default {
    props: ['width', 'url'],
    created: function () {
        this.is_mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    },
    methods: {
        share: function(e) {
            e.preventDefault();
            $("#delete-block-popup").modal('show');
        },
        copyToClipboard(e) {
            e.preventDefault();
            e.stopPropagation();
            document.querySelector('#share-url').select();
            document.execCommand('copy');}
        }
}
</script>
