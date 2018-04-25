<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true" ref="vueModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@{{ permission.display_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-check form-check-flat">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" v-model="editPermission">
                            Cập nhật quyền
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Tên (Slug): @{{ permission.name }}</label>
                    <input type="text" class="form-control" name="name" id="name" v-model="permission.name" v-if="editPermission">
                </div>
                <div class="form-group">
                    <label for="display_name">Tên hiển thị: @{{ permission.display_name }}</label>
                    <input type="text" class="form-control" name="display_name" id="display_name" v-model="permission.display_name" v-if="editPermission">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả: @{{ permission.description }}</label>
                    <input type="text" class="form-control" name="description" id="description" v-model="permission.description" v-if="editPermission">
                </div>
                <div class="form-group" v-if="!editPermission">
                    <label for="">Ngày tạo: @{{ permission.created_at }}</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" @click.one="updatePermission" v-if="editPermission">Cập nhật</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>