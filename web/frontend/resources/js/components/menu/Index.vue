<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'create'}" class="btn btn-success">Добавить элемент</router-link>
        </div>

        <div class="panel panel-default">
            <div>
                <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Название</th>
                          <th>Алиас</th>
                          <th width="150">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item, index in items">
                        <td>{{ item.id }}</td>
                        <td>
                            <a href="#">
                                {{ item.name }}
                            </a>
                        </td>
                        <td>{{ item.alias }}</td>
                        <td>
                            <a href="#" class="btn btn-danger" v-on:click="deleteEntry(item.id, index)">
                                Удалить
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            items: [],
            item: {
                id: '',
                name: '',
                alias: '',
            }
        }
    },
    mounted() {
        this.getList();
    },
    methods: {
        getList() {
            let app = this;

            axios.get('/api/index/')
                .then(function (response) {
                    app.items = response.data;
                })
                .catch(function (response) {
                    alert('Невозможно получить меню');
                });
        },

        deleteEntry(id, index) {
            if (true === confirm("Вы действительно хотите удалить этот элемент?")) {
                var app = this;
                axios.delete('/apis/' + id)
                    .then(function () {
                        app.items.splice(index, 1);
                    })
                    .catch(function () {
                        alert("Невозможно удалить элемент");
                    });
            }
        }
    }
}
</script>
