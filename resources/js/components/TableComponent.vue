<template>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">URL</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in this.data" >
        <th>
          <input :value="item" type="checkbox" v-model="checkedItems" v-on:change="selectRow(item)"></input>
        </th>
        <th scope="row">{{item.id}}</th>
        <td>{{fileUrl(item.url)}}</td>
        <td><a :href="item.url">Download Here</a></td>
      </tr>
    </tbody>
  </table>
</template>

<script>    
    import { serverBus } from '../app';

    export default {
        props: {
          data: Array
        },
        data: () => {
          return {
            checkedItems: []
          }
        },
        mounted() {
            console.log('Component mounted.');
        },
        created() {
          serverBus.$on('itemUploaded', (itemUploaded) => {
              
          });
        },
        methods: {
          /*
          * Arrow function binds `this` to the parent context, in order to avoid that.
          * Is neccesary to use vanillajs function declaration
          * https://github.com/vuejs-templates/browserify-simple/issues/6#issuecomment-214003282
          */
          selectRow: function(item) {
            serverBus.$emit('activeItem', this.checkedItems);
          },
          fileUrl: (url) => {
            return url.replace('/file','/download');
          }
        },
        
        
        
    }
</script>
