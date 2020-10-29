<template>
  <div>
    <div class="form-group">
      <router-link to="{name: 'index'}" class="btn btn-default">Назад</router-link>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">Добавить элемент</div>
      <div class="panel-body">
        <form v-on:submit="saveForm()">
          <div class="row">
            <div class="col-xs-12 form-group">
              <label class="control-label">Название</label>
              <input type="text" v-model="item.name" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 form-group">
              <label class="control-label">Алиас</label>
              <input type="text" v-model="item.alias" class="form-control"></input>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 form-group">
              <label class="control-label">Родительский элемент</label>
              <select v-model="item.parent_id" class="form-control">
                <option v-for="option in options" v-bind:value="option.id">
                  {{ option.name }}
                </option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group">
              <button class="btn btn-success">Добавить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      item: {
        name: '',
        alias: '',
        parent_id: '',
      },
      options: [],
    }
  },

  mounted() {
    this.getOptions();
  },

  methods: {
    getOptions() {
      let app = this;

      axios.get('/api/index/')
          .then(function (response) {
            app.options = response.data;
          })
          .catch(function (response) {
            alert('Невозможно список меню');
          });
    },

    saveForm() {
      event.preventDefault();

      var app     = this;
      var newItem = app.item;

      axios.post('/apis', newItem)
          .then(function (response) {
            if (true === response.data.result) {
              app.$router.push({path: '/'});
            }
            else {
              alert(response.data.message);
            }

          })
          .catch(function (response) {
            alert('Не удалось сохранить элемент');
          });
    }
  }
}
</script>
