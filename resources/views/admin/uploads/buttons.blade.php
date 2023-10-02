<div class="actions btn-group">
    <a href="{{ route('admin.userEditForm', ['id' => $page->id]) }}"><span class="glyphicon edit_del glyphicon-edit"></span></a>
    <a class="clickDeleteFunction" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.deleteUser', ['id' => $page->id]) }}"><span class="glyphicon edit_del glyphicon-trash"></span></a>
</div>