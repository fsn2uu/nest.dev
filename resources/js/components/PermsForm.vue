<template>
    <div class="container">
        <div class="form-group">
            <label>Permission Type</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="permission_type" id="basic" value="basic" checked v-model="permissionType">
                <label class="form-check-label" for="basic">
                    Basic Permission
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="permission_type" id="crud" value="crud" v-model="permissionType">
                <label class="form-check-label" for="crud">
                    CRUD Permission
                </label>
            </div>
        </div>

        <div class="form-group" v-if="permissionType == 'basic'">
            <label for="display_name">display_name</label>
            <input type="text" name="display_name" id="display_name" class="form-control" value="" />
        </div>

        <div class="form-group" v-if="permissionType == 'basic'">
            <label for="name">Slug</label>
            <input type="text" name="name" id="name" class="form-control" value="" />
        </div>

        <div class="form-group" v-if="permissionType == 'basic'">
            <label for="description">description</label>
            <input type="text" name="description" id="description" class="form-control" value="" />
        </div>

        <div class="form-group" v-if="permissionType == 'crud'">
            <label for="resource">resource</label>
            <input type="text" name="resource" id="resource" class="form-control" value="" v-model="resource" />
        </div>

        <input type="hidden" name="crud_selected" :value="crudSelected">

        <div class="row" v-if="permissionType == 'crud'">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="create" id="create" v-model="crudSelected" checked>
                        <label class="form-check-label" for="create">
                            Create
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="read" id="read" v-model="crudSelected" checked>
                        <label class="form-check-label" for="read">
                            read
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="update" id="update" v-model="crudSelected" checked>
                        <label class="form-check-label" for="update">
                            update
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="delete" id="delete" v-model="crudSelected" checked>
                        <label class="form-check-label" for="delete">
                            delete
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                permissionType: 'basic',
                resource: '',
                crudSelected: ['create', 'read', 'update', 'delete']
            }
        }
    }
</script>
