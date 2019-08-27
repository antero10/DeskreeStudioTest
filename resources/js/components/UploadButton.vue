<template>
  <div>
    <a class="btn btn-primary float-right" v-bind:href="downloadURL" v-if="activeItem" >Download Files</a>
    <label class="btn btn-primary float-right" v-if="!activeItem" >
        Browse
        <input type="file" name="file" onchange="form.submit()" hidden > 
    </label>
  </div>
</template>
<script>
import { serverBus } from '../app';
export default {
    data: () => {
      return {
        activeItem: false,
        itemsSelected: []
      }
    },
    mounted() {
        console.log('Component mounted.');
    },
    created() {
      const vm = this;
      serverBus.$on('activeItem', (itemsSelected) => {
        vm.itemsSelected = itemsSelected;
        vm.activeItem = itemsSelected.length > 0 ? true : false;
      });
    },
    computed: {
      downloadURL() {
        const URL = '/download?urls=';
        let images = '';
        this.itemsSelected.forEach((item, key, arr) => {
          images += item.url + (Object.is(arr.length - 1, key) ? '' : ',');
        });
        return URL + images;
      }
    },
};
</script>
