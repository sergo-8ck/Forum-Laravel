<template>
  <div :id="'reply-'+id" class="card my-2">
    <div class="card-header">
      <div class="level">
        <h5 class="flex">
          <a :href="'/profiles/'+data.owner.name"
            v-text="data.owner.name">
          </a> said {{data.created_at}}...
        </h5>

        <!--@if (Auth::check())-->
        <!--<div>-->
          <!--<favorite :reply="{{ $reply }}"></favorite>-->
        <!--</div>-->
        <!--@endif-->
      </div>
    </div>

    <div class="card-body">
      <div v-if="editing">
        <div class="form-group">
          <textarea class="form-control" v-model="body"></textarea>
        </div>

        <button class="btn btn-sm btn-primary" @click="update">Сохранить</button>
        <button class="btn btn-sm btn-link" @click="editing = false">Выход</button>
      </div>

      <div v-else v-text="body"></div>
    </div>

    <!--@can ('update', $reply)-->
    <div class="card-footer level">
      <button class="btn btn-sm mr-1" @click="editing = true">Редактировать</button>

      <button class="btn btn-sm btn-danger mr-1" @click="destroy">Удалить</button>
    </div>
    <!--@endcan-->
  </div>
</template>

<script>

    import Favorite from './Favorite.vue';

    export default {
        props: ['data'],

        components: {Favorite},

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                this.$emit('deleted', this.data.id);

                // $(this.$el).fadeOut(300, () => {
                    // flash('Ваш комментарий был удален.');
                // });
            }
        }
    }
</script>