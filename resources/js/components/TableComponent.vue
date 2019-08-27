<template>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">URL</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in this.data" >
        <th>
          <input :value="item" type="checkbox" v-model="checkedItems" v-on:change="selectRow(item)"></input>
        </th>
        <td scope="row">{{item.id}}</td>
        <td> {{item.url}} </td>
        <td><a v-bind:href="fileUrl(item.url)">Download Here</a></td>
        <td>
          <form method="POST" action="/delete">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <button name="file" v-bind:value="item.url" class="btn btn-danger"> Delete </button>
          </form>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>    
    import { serverBus } from '../app';

    export default {
        props: {
          data: Array,
          csrf: String,
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
            return url.replace('files/','download/');
          }
        },
        
        
        
    }
</script>
