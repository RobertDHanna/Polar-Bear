<template>
    <!-- <div>
        <span v-on:click="share($event)" class="share-btn" data-toggle="tooltip" title="Share"><i class="glyphicon glyphicon-share"></i></span>
    </div> -->
    <div class="btn-group">
  <button v-on:click="share($event)" type="button" class="btn btn-default dropdown-toggle share-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="share-btn" data-toggle="tooltip" title="Share"><i class="glyphicon glyphicon-share"></i></span>
  </button>
  <ul class="dropdown-menu">
    <li><input value="nothin"></input></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
  </ul>
</div>
</template>

<style scoped>
.dropdown-menu {
    left: inherit;
    right: 0;
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
  methods: {
      share: function() {
          $("#delete-block-popup").modal('show');
      }
  }
}
</script>
